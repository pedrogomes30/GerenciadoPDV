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
                return "Indisponivel";
                break;
            case 'PUT':
                return self::saveSale($param);//permite salvar/emitir uma venda a partir do numero da venda.
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
                    $itemsArray[]               = $item_;
                }
                $settings['payments']           = $paymentsArray;
                $settings['items']              = $itemsArray;
                
            }
            TTransaction::close();
            $sale                               = nfceEmissor::isInvoice($sale,$settings); 
            $return                             = array();
            $return['sale_id']                  = isset($sale->id) ? $sale->id : 'ERROR';
            $return['sale_invoice_cupon']       = isset($sale->sale_invoice_cupon) ? $sale->sale_invoice_cupon : null;
            return $return;
            
        }catch(Exception $e){
            $error = array();
            $error['store']             = isset($param['store']) ? $param['store'] : null;
            $error['employee_cashier']  = isset($param['employee_cashier']) ? $param['employee_cashier'] : null ;
            $error['cashier']           = isset($param['cashier']) ? $param['cashier'] : null;
            $error['class']             = 'saleRest';
            $error['method']            = 'saveSale';
            $error['error']             = $e->getmessage();
            TTransaction::rollback();
            return $error;
        } 
    }
    
    
    
    public function getSale($param)
    {
        /* -- expect this Json and always will return sales form token user,
            {
               id:
                [
                    0000,
                ],
               number:
                [
                    00000ABC,
                ],
               date_start: 2022-06-28 09:05,
               date_end: 2022-06-28 09:05,
            }
        */ 
        
        try{
            
        }catch(Exception $e){
            $error = array();
            $error['store']             = isset($param['store']) ? $param['store'] : null;
            $error['employee_cashier']  = isset($param['employee_cashier']) ? $param['employee_cashier'] : null ;
            $error['cashier']           = isset($param['cashier']) ? $param['cashier'] : null;
            $error['class']             = 'saleRest';
            $error['method']            = 'getSale';
            $error['error']             = $e->getmessage();
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
            $error['store']             = isset($param['store']) ? $param['store'] : null;
            $error['employee_cashier']  = isset($param['employee_cashier']) ? $param['employee_cashier'] : null ;
            $error['cashier']           = isset($param['cashier']) ? $param['cashier'] : null;
            $error['class']             = 'saleRest';
            $error['method']            = 'deleteSale';
            $error['error']             = $e->getmessage();
            TTransaction::rollback();
            return $error;
        } 
    }
    
    //HELPER FUNCTIONS
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
