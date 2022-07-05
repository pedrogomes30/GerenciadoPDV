<?php

class SaleRest extends AdiantiRecordService
{
    const DATABASE      = 'pos_sale';
    const ACTIVE_RECORD = 'Sale';
    
   public function handle($param)
    {
            $method = strtoupper($_SERVER['REQUEST_METHOD']);
            unset($param['class']);
            unset($param['method']);
            //seletor de redirecionamento de função
            switch($method)
        {
            case 'POST':
                return self::saveSale($param);//permite salvar/emitir uma venda a partir do numero da venda.
                break;
            case 'PUT':
                return "Indisponivel";
                break;
            case 'GET':
                return self::getSale($param);//permite obter o array de venda do respectivo PDV.
                break;
            case 'DELETE':
                return self::cancelSale($param);//permite obter o array de venda do respectivo PDV.
                break;
            default:
                return "Indisponivel";
        }
    }
    
    
    //functions
    public function saveSale($param)
    {
        try{
            TTransaction::open(static::DATABASE);
            
            if( !isset($param['payments']) ||  $param['payments'] == "" || count($param['payments'])== 0 || !isset($param['payments'][0]['value']) ){
                throw new Exception('invalid payments!');
            }
            if( !isset($param['items']) ||  $param['items'] == "" || count($param['items']) == 0 || !isset($param['items'][0]['value']) ){
                throw new Exception('invalid items!');
            }
            $sale                       = Sale::where('number','=',$param['number'])->first();
            $settings                   = array();
            if(!$sale){
                $sale                   = new Sale();
                $sale->number           = $param['number'];
                $sale->products_value   = $param['products_value'];
                $sale->payments_value   = $param['payments_value'];
                $sale->discont_value    = isset($param['discont_value']) ? $param['discont_value'] : null;
                $sale->total_value      = $param['total_value'];
                $sale->employee_sale    = $param['employee_sale'];
                $sale->sale_date        = $param['sale_date'];
                $sale->invoiced         = 0;
                $sale->invoice_ambient  = 0;
                $sale->obs              = isset($param['obs']) ? $param['obs'] : null;
                $sale->invoice_number   = null;
                $sale->invoice_serie    = null;
                $sale->invoice_coupon   = null;
                $sale->invoice_xml      = null;
                $payments               = $param['payments'];
                $sale->payment_method   = 1;//isset($payments[1]) ? 6 : $param['payments'][0]['payment_method_id'];
                $sale->store            = $param['store'];
                $sale->employee_cashier = $param['employee_cashier'];
                $sale->cashier          = $param['cashier'];
                $sale->customer         = $param['customer'];
                $sale->salesman         = $param['salesman'];
                $sale->status           = 3;
                $sale->store();
                $paymentsArray          = array();
                $itemsArray             = array();
                $settings['invoice']    = isset($param['invoice']) ?$param['invoice'] : false ; 
                foreach($payments as $payment){
                    $payment_                   = new SalePayment();
                    $payment_->value            = $payment['value'];
                    $payment_->sale_date        = $sale->sale_date;
                    $payment_->store            = $sale->store;
                    $payment_->sale             = $sale->id;
                    $payment_->payment_method   = $payment['payment_method_id'];//$payment['payment_method_id'];
                    $payment_->store();
                    $sale->payments_value       += $payment_->value;
                    $paymentsArray[]            = $payment_;
                }
                //itens
                $items                          = $param['items'];
                TTransaction::open('pos_product');
                $deposit                        = Deposit::where('store','=',$sale->store)->first();
                TTransaction::close();
                foreach($items as $item){
                    $item_                      = new SaleItem();
                    $item_->discont_value       = isset($item['discont_value'])?$item['discont_value'] : null;
                    $item_->quantity            = $item['quantity'];
                    $item_->unitary_value       = $item['value'];
                    $item_->total_value         = $item['quantity'] * $item['value'];
                    $item_->sale_date           = $sale->sale_date;
                    $item_->store               = $sale->store;
                    $item_->sale                = $sale->id;
                    $item_->product             = $item['product_id'];
                    //storage
                    $productStorage             = self::storageContable($deposit,$item_);
                    $item_->deposit             = $productStorage->deposit;
                    $item_->product_storage     = $productStorage->id;
                    $item_->store();
                    $sale->products_value       += $item_->total_value;
                    //cupom
                    if(isset($item['cupom']) && $item['cupom'] != ""){
                        $cupoms                 = $item['cupom'];
                        foreach($cupoms as $cupom){
                            $itemCupom              = new ItemCupom();
                            $itemCupom->value       = $cupom['value'];
                            $itemCupom->cupom       = $cupom['cupom'];
                            $itemCupom->sale_item   = $cupom['sale_item'];
                            $itemCupom->store();
                        }
                    }
                    $itemsArray[]               = $item_;
                }
                $settings['payments']           = $paymentsArray;
                $settings['items']              = $itemsArray;
                
            }
            TTransaction::close();
            $sale                               = nfceEmissor::isInvoice($sale,$settings); 
            $return                             = array();
            $param['id']                        = isset($sale->id) ? $sale->id : 'ERROR';
            $param['sale_invoice_cupon']        = isset($sale->sale_invoice_cupon) ? $sale->sale_invoice_cupon : null;
            $result                   = array();
            $result['error']          = false;
            $result['data']           = $param;
            return $result;
        }catch(Exception $e){
            $error = array();
            $error['error']                     = true;
            $error['data']                      = $e->getmessage();
            TTransaction::rollback();
            return $error;
        } 
    }
    
    
    
    public function getSale($param)
    {
        /* -- expect this Json and always will return sales form token user,
            {
               "sale_id":"",
               "sale_number":"",
               "date_start": "2022-06-28 00:00",
               "date_end": "2022-06-29 23:59",
               "user_id":"",
               "store_id":"",
            }
        */ 
        try{
            //set search type, by id, by number, by period with user and store, by period.
            //type 1 - by sale_id
            $sale                       = null;
            TTransaction::open(static::DATABASE);
            if(isset($param['sale_id']) && $param['sale_id'] !== ""){
                $sale                   = Sale::where('id','=',$param['sale_id'])->first();
                if(!$sale) throw new exception("Sale id not found!");
                $return =  self::getSalesArrayWithItemsPayments($sale);
                $result                   = array();
                $result['error']          = false;
                $result['data']           = $return;
                return $result;
                }
            //type 2 - by sale_number
            if(isset($param['sale_number']) && $param['sale_number'] !== ""){
                $sale                   = Sale::where('number','=',$param['sale_number'])->first();
                if(!$sale) throw new exception("Sale number not found!");
                $return =  self::getSalesArrayWithItemsPayments($sale);
                $result                   = array();
                $result['error']          = false;
                $result['data']           = $return;
                return $result;
            }
            //type 3 - by period with user and store
            if(isset($param['user_id']) && $param['user_id'] !== ""){
                if(isset($param['store_id']) || $param['store_id'] !== ""){
                       $start           = !isset($param['date_start']) || $param['date_start'] == "" || $param['date_start'] == null ? date("Y-m-d 00:00",strtotime('-7 days')) : $param['date_start'];
                       $end             = !isset($param['date_end']) || $param['date_end'] == "" || $param['date_end'] == null ? date("Y-m-d 23:59") : $param['date_end'];
                       $sales           = Sale::where('employee_cashier','=',$param['user_id'])
                                              ->where('store','=',$param['store_id'])
                                              ->where('sale_date','>=',$start)
                                              ->where('sale_date','<=',$end)
                                              ->load();
                       if(!$sales) throw new exception("Sale not found");
                       $salesArray = array();
                       foreach($sales as $sale){
                         $saleArray = self::getSalesArrayWithItemsPayments($sale);
                         $salesArray[] = $saleArray;
                       }
                    $result                   = array();
                    $result['error']          = false;
                    $result['data']           = $salesArray;
                    return $result;
                    }
                throw new exception("no Store id");
            }else{
                //type 4 - by period used for admin only
                $tokenUser      = TSession::getValue('userid');
                if($tokenUser != 1) throw new exception ("You are not a admin!");
                if(!isset($param['date_start']) || $param['date_start'] == "" || $param['date_start'] == null) throw new exception("no date start set");
                if(!isset($param['date_end']) || $param['date_end'] == "" || $param['date_end'] == null) throw new exception("no date end set");
                $sales          = Sale::where('sale_date','>=',$param['date_start'])
                                      ->where('sale_date','<=',$param['date_end'])
                                      ->load();
                if(!$sales) throw new exception("Sale not found");
                $salesArray = array();
                foreach($sales as $sale){
                    $saleArray = self::getSalesArrayWithItemsPayments($sale);
                    $salesArray[] = $saleArray;
                }
                $result                   = array();
                $result['error']          = false;
                $result['data']           = $salesArray;
                return $result; 
            }
            TTransaction::close();
        }catch(Exception $e){
            $error = array();
            $error['error']             = true;
            $error['data']              = $e->getmessage();
            TTransaction::rollback();
            return $error;
        } 
    }
    
    
    
    public function cancelSale($param)
    {
        try{
            //do not exist delete a sale, but you can cancel, a sale cancel can be in 25mim after sale create.
        }catch(Exception $e){
            $error = array();
            $error['error']             = true;
            $error['data']              = $e->getmessage();
            TTransaction::rollback();
            return $error;
        } 
    }
    
    //HELPER FUNCTIONS
    
    /*
    this functtion convert a sale object into sale array with yout payment and sale items
    call it with on ttransaction open
    */
    public function getSalesArrayWithItemsPayments($sale){
        $saleArray                      = array();
        $items                          = SaleItem::where('sale','=',$sale->id)->load();
        $payments                       = SalePayment::where('sale','=',$sale->id)->load();
        $saleArray['id']                = $sale->id;
        $saleArray['number']            = $sale->number;
        $saleArray['products_value']    = $sale->products_value;
        $saleArray['payments_value']    = $sale->payments_value;
        $saleArray['discont_value']     = $sale->discont_value;
        $saleArray['total_value']       = $sale->total_value;
        $saleArray['employee_sale']     = $sale->employee_sale; 
        $saleArray['sale_date']         = $sale->sale_date;
        $saleArray['obs']               = $sale->obs;
        $saleArray['invoice_coupon']    = $sale->invoice_coupon;
        $saleArray['payment_method']    = $sale->fk_payment_method->alias;
        $saleArray['store']             = $sale->fk_store->fantasy_name;
        $saleArray['employee_cashier']  = $sale->fk_employee_cashier->fk_system_user->name;
        $saleArray['cashier']           = $sale->fk_cashier->name;
        $saleArray['customer']          = $sale->fk_customer->name;
        $saleArray['salesman']          = $sale->fk_salesman->name;
        $saleArray['status']            = $sale->fk_status->description;
        //$items
        $itemsArray                     = array();
        foreach($items as $item){
            $itemArray = array();
            $itemArray['sku']           = $item->fk_product->sku;
            $itemArray['discont_value'] = $item->discont_value;
            $itemArray['quantity']      = $item->quantity;
            $itemArray['unitary_value'] = $item->unitary_value;
            $itemArray['total_value']   = $item->total_value;
            $itemsArray[]               = $itemArray;
        }
        $saleArray['items']             = $itemsArray;
        //payments
        $paymentsArray                  = array();
        foreach($payments as $payment){
            $paymentArray               = array();
            $paymentArray['value']      = $payment->value;
            $paymentArray['payment_method']= $payment->fk_payment_method->alias;
            $paymentsArray[]            = $paymentArray;
        }
        $saleArray['payments']          = $paymentsArray;
        return $saleArray;
    }
    
    public function storageContable($deposit,$item){
        TTransaction::open('pos_product');
        $storage        = ProductStorage::where('deposit','=',$deposit->id)
                                        ->where('product','=',$item->product)
                                        ->first();
        if($storage){
            $storage->quantity      -= $item->quantity;
            $storage->store();
        }else{
            $storage                = new ProductStorage();
            $storage->quantity      = $item->quantity*-1;
            $storage->min_storage   = 0;
            $storage->max_storage   = 0;
            $storage->deposit       = $deposit->id;
            $storage->product       = $item->product;
            $storage->store         = $deposit->store;
            $storage->store();
        }
        TTransaction::close();
        return $storage;
    }
}
