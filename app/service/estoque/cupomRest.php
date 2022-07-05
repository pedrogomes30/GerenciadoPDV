<?php

class cupomRest extends AdiantiRecordService
{
    const DATABASE      = 'pos_product';
    const ACTIVE_RECORD = 'Cupom';
    const ATTRIBUTES    = ['acumulate','all_products','code','description','id','percent','quantity','valor','with_client'];
    
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
                return "Indisponivel";
                break;
            case 'GET':
                return self::getCupom($param);//permite obter o array de venda do respectivo PDV.
                break;
            case 'DELETE':
                return "Indisponivel";
                break;
            default:
                return "Indisponivel";
        }
    }
    
    public function getCupom($param){
        try{
            TTransaction::open(static::DATABASE);
            $cupom              = Cupom::where('code','=',$param['code'])->first();
            if(isset($cupom)){
                $cupomArray                 = array();
                $cupomArray['id']           = $cupom->id;
                $cupomArray['with_client']  = $cupom->with_client;
                $cupomArray['code']         = $cupom->code;
                $cupomArray['description']  = $cupom->description;
                $cupomArray['value']        = $cupom->value;
                $cupomArray['all_products'] = $cupom->all_products;
                $cupomArray['acumulate']    = $cupom->acumulate;
                $cupomArray['percent']      = $cupom->percent;
                $cupomArray['quantity']     = $cupom->quantity;
                $cupomProductsArray         = array();
                if(!$cupom->all_products){
                    $cupomsProducts         = CupomProducts::where('cupom','=',$cupom->id)->load();
                    foreach($cupomsProducts as $cupomProduct){
                        $cupomProductsArray[] = $cupomProduct->product;  
                    }
                    $cupomArray['products'] = $cupomsProducts;
                }
                $result = array();
                $result['error']          = false;
                $result['data']           = $cupomArray;
                return $result;
            }else{
                throw new Exception('Cupom inválido');
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
}
