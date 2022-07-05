<?php

class nfceEmissor
{
    
    
    public static function isInvoice($sale,$settings)
    {
        if($sale->invoiced && $sale->status != 2){
            echo 'barrou ponto 1';
            return $sale;
        }
        $return                     = null;
        $sale_month                 = date('m',strtotime($sale->sale_date));
        $sale_year                  = date('y',strtotime($sale->sale_date));
        $now_month                  = date('m');
        $now_year                   = date('y');
        $validity                   = $sale_month == $now_month && $sale_year == $now_year ? true : false;
        
        if(!$validity) throw new exception("invalid sale date");
        $sale->number               = eNotasApi::invoiceAmbient() ? $sale->number : $sale->number.'H'; //you can test same production sale, add "h" to the end.
        if($sale->customer !== null){
            TTransaction::open('pos_customer');
            $customer                 = new Customer($sale->id);
            $settings['customer']     = $customer;
            TTransaction::close();
        }
        if(!isset($settings['store'])){
            TTransaction::open('pos_system');
            $settings['store']      = new Store($sale->store);
            TTransaction::close();
        }
        //validated
        if($settings['store']->invoice_type || $sale->payment_method !== 5 || $settings['invoice']) {
            //more infos
            TTransaction::open('pos_sale');
            if(!isset($settings['payments'])){
                $payments               = SalePayment::where('sale','=',$sale->id)->load();
                $settings['payments']   = $payments;
            }
            if(!isset($settings['items'])){
                $items                  = SaleItem::where('sale','=',$sale->id)->load();
                $settings['items']      = $items;
            }
            TTransaction::close();
            return self::newNfce($sale,$settings);
        }
        
    }
    
    public static function newNfce($sale,$settings)
    {
        $itemsArray                         = array();
        $paymentsArray                      = array();
        $nfceArray                          = array();
        $toRemove                           = array(".","/","-"," ");
        $nfceSettings                       = eNotasApi::getNfceConfig();
        $store                              = $settings['store'];
        // PRODUCTS
        TTransaction::open('pos_product');
        foreach($settings['items'] as $item){
            $product                        = new Product($item->product);
            $itemArray                      = array();
            $cfop                           = 
            $itemArray['cfop']              = strval($product->cfop);
            $itemArray['codigo']            = $product->id;
            $itemArray['descricao']         = $product->description;
            $itemArray['ncm']               = str_replace($toRemove,"",$product->ncm);
            $itemArray['cest']              = str_replace($toRemove,"",$product->cest);
            $itemArray['quantidade']        = $item->quantity;
            $itemArray['unidadeMedida']     = $product->unity;
            $itemArray['valorUnitario']     = $item->unitary_value;
            $itemArray['descontos']         = $item->discont_value;
            //TAX
            $tax                            = array();
            $taxPercent                     = array();
            $simplificated                  = array();
            $icms                           = array();
            $simplificated['percentual']    = intval(18); //% tax
            $icms['situacaoTributaria']     = strval($product->tribute_situation);
            $icms['origem']                 = strval($product->origin);
            $taxPercent['simplificado']     = $simplificated;
            $taxPercent['fonte']            = 'IBPT';
            $tax['percentualAproximadoTributos'] = $taxPercent;
            $tax['icms']                    = $icms;
            $itemArray['impostos']          = $tax;
            //
            $itemsArray[]                   = $itemArray;
        }
        TTransaction::close();
        //payments
        foreach($settings['payments'] as $payment){
            $paymentArray                   = array();
            $cardCredentioner               = array();
            switch($payment->payment_method){
                //ENOTAS PAYMENT ID TYPE
                case 1://pix
                    $paymentArray['tipo']                     = 'PagamentoInstantaneoPix';
                    $paymentArray['valor']                    = doubleval($payment->value);
                    break;
                case 2:
                case 3://credit card and date_credit card
                    $cardCredentioner['tipoIntegracaoPagamento'] = 'NaoIntegradoAoSistemaDeGestao';
                    $paymentArray['tipo']                     = 'CartaoDeCredito';
                    $paymentArray['valor']                    = doubleval($payment->value); 
                    $paymentArray['credenciadoraCartao']      = $cardCredentioner;
                    break;
                case 4://debit Card
                    $cardCredentioner['tipoIntegracaoPagamento'] = 'NaoIntegradoAoSistemaDeGestao';
                    $paymentArray['tipo']                     = 'CartaoDeDebito';
                    $paymentArray['valor']                    = doubleval($payment->value); 
                    $paymentArray['credenciadoraCartao']      = $cardCredentioner;
                    break;
                case 5://store credit and money
                case 6:
                    $paymentArray['tipo']                     = 'Dinheiro';
                    $paymentArray['valor']                    = doubleval($payment->value);
                    break;
                case 8://wallet digital
                    $paymentArray['tipo']                     = 'TransferenciaBancariaCarteiraDigital';
                    $paymentArray['valor']                    = doubleval($payment->value);
                    break;
                case 9://cashback
                    $paymentArray['tipo']                     = 'ProgramaFidelidadeCashbackCarteiraVirtual';
                    $paymentArray['valor']                    = doubleval($payment->value);
                    break;
                default:
                    throw new Exception('invalid payment method!: '.$payment);
                    break;
            }
            $paymentsArray[]                = $paymentArray;
        }
        $customerArray                      = array();
        $nfceArray                          = 
            [
                  'id' => $sale->number,
                  'ambienteEmissao' => $nfceSettings['ambiente_emissao'],
                  'naturezaOperacao'=> 'Venda',
                  'enviarPorEmail'=> false,
                  'pedido' => array(
            	  'presencaConsumidor' => $nfceSettings['presenca_consumidor'],
            	  'pagamento' => array(
            		'tipo' => 'PagamentoAVista',
            		'formas' => $paymentsArray
                        )
                    ),
                 'itens' => $itemsArray,
            	 'informacoesAdicionais' => $nfceSettings['informacoes_adicionais']." numero da venda: ".$sale->number,
            ];
        /* -- SENDBOX DOES'T WORK, TEST IN SERVER
        $result = eNotasApi::sendNfce($store->invoice_provider_id,$nfceArray);
        var_dump($result);
        return $result;
        */
        var_dump($nfceArray);
        return $sale;
        if(isset($settings['customer'])){
            $customer                       = $settings['customer'];
            $customerArray['tipoPessoa']    = $customer->document_type;
            $customerArray['nome']          = $customer->name;
            $customerArray['email']         = $customer->email;
            $customerArray['cpfCnpj']       = $customer->document;
            $customerArray['city']          = $customer->city;
            $customerArray['uf']            = $customer->uf;
            $customerArray['cep']           = $customer->postal_code;
            $nfceArray['cliente']           = $customerArray;
            $nfceArray['enviarPorEmail']    = true;
        }
    }
}
