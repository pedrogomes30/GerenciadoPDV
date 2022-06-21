<?php

class firstConfig extends AdiantiRecordService
{
    const DATABASE      = 'pos_system';
    const ACTIVE_RECORD = 'Store';
    
   public function handle($param)
    {
            $method = strtoupper($_SERVER['REQUEST_METHOD']);
            unset($param['class']);
            unset($param['method']);
            //seletor de redirecionamento de função
            switch($method)
        {
            case 'POST':
                return "indisponível";
                break;
            case 'PUT':
                return "indisponível";
                break;
            case 'GET':
                return self::getFirstConfigs($param);
                break;
            default:
                return "indisponível";
        }
    }
    
    /*
    Methodo responsável por enviar os dados essenciais sobre o PDV, sem a necessidade de gerar novos requests.
    */
    public function getFirstConfigs($param){
        try{
            $userId                 = TSession::getValue('userid');
            $userName               = TSession::getValue('username');
            TTransaction::open(static::DATABASE);
            $return                 = array();
            $user                   = User::where('system_user','=',$userId)->first();
            $profession             = new Profession($user->profession);
            $store                  = new Store($user->current_store);
            $cashiers               = Cashier::where('store','=',$store->id)->load();
            $paymentMethodStore     = PaymentMethodStore::where('store','=',$store->id)->load();
            $storeGroup             = new StoreGroup($store->store_group);
            
            if(!isset($user) || !isset($profession) || !isset($store) || !isset($user) || !isset($cashiers) || !isset($paymentMethodStore) || !isset($storeGroup)){
                throw new Exception ('erro na falta de registro de objetos!');
            }
            $return['user_id']      = $user->id;
            $return['user_name']    = $userName;
            $return['img']          = $user->profile_img;
            $return['profession']   = $profession->description;
            $return['is_manager']   = $profession->is_manager;
            $return['cashier_id']   = null;
            $return['cashier_name'] = null;
            $storeArray                         = array();
            $storeArray['store_id']             = $store->id;
            $storeArray['store_name']           = $store->fantasy_name;
            $storeArray['store_abbreviation']   = $store->abbreviation;
            $storeArray['store_group_id']       = $storeGroup->id;
            $storeArray['store_group_name']     = $storeGroup->name;
            $storeArray['store_group_theme']    = $storeGroup->default_theme;
            //cashiers
            $cashiersArray          = array();
            foreach($cashiers as $cashier){
                $cashierArray                   = array();
                $cashierArray['cashier_id']     = $cashier->id;
                $cashierArray['cashier_name']   = $cashier->name;
                $cashierArray['cashier_store']  = $cashier->store;
                $cashiersArray[]                = $cashierArray;
            }
            $storeArray['store_cashiers']       = $cashiersArray; 
            $return['store']        = $storeArray;
            $methodsArray           = array();
            //payment_methods calc
            foreach($paymentMethodStore as $methodStore){
                $method                             = new PaymentMethod($methodStore->method);
                $methodArray                        = array();
                $methodArray['method_id']           = $method->id;
                $methodArray['method_description']  = $method->method;
                $methodArray['method_alias']        = $method->alias;
                $methodArray['method_issue']        = $method->issue;
                $methodsArray[]                     = $methodArray;
            }
            $return['payment_methods'] = $methodsArray;
            
            TTransaction::close();
            return $return;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
   
}
