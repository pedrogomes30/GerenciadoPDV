<?php

class closure extends AdiantiRecordService
{
    const DATABASE      = 'pos_withdrawal_closure';
    const ACTIVE_RECORD = 'Closure';
    const ATTRIBUTES    = ['cashier','closure_type','dt_close','dt_open','id','store','user','value_total'];
    
    public function handle($param)
    {
            $method = strtoupper($_SERVER['REQUEST_METHOD']);
            unset($param['class']);
            unset($param['method']);
            //seletor de redirecionamento de função
            switch($method)
        {
            case 'POST':
                return self::newClosure($param);
                break;
            case 'PUT':
                return "indisponível";
                break;
            case 'GET':
                return "indisponível";
                break;
            default:
                return "indisponível";
        }
    }
    /*
    Array expected:
    {
        "user":1,
        "store":1,
        "cashier":1,
        "closure_type":false,
        "dt_open":"2022-06-29",
        "dt_closure":"2022-06-29",
        "value_total":4.00,
        "closure_payment_method":[
            {
                "payment_method":1,
                "value": 2.00
            },
            {
                "payment_method":2,
                "value": 2.00
            }
        ],
        "withdrawal":[
            {
                "user":1,
                "store":1,
                "cashier":1,
                "withdrawal_account":1,
                "dt_wathdrawal": 2022-06-29,
                "value":1.00,
                "obs":"retirada para compra de clipe de papel"
            }
        ]
    }
    */
    public function newClosure($param){
        try{
            TTransaction::open(static::DATABASE);
            if(isset($param['closure_payment_method']) && $param['closure_payment_method'] != "") 
                throw new Exception('no closure payments');
            if(isset($param['withdrawal']) && $param['withdrawal'] != "") 
                throw new Exception('no closure withdrawal');
            $closurePaymentMethods  = $param['closure_payment_method'];
            $withdrawals            = $param['withdrawal'];
            $closure                    = Closure::where('number','=',$param['number'])->first();
            if(!$closure){
                $closure                = new Closure();
                $closure->number        = $param['number'];
                $closure->dt_closure    = $param['dt_closure'];
                $closure->closure_type  = $param['closure_type'];
                $closure->dt_open       = $param['dt_open'];
                $closure->value_total   = $param['value_total'];
                $closure->user          = $param['user'];
                $closure->cashier       = $param['cashier'];
                $closure->store         = $param['store'];
                $closure->store();
                foreach($closurePaymentMethods as $closurePaymentMethodArray){
                    $closurePaymentMethod                   = new ClosurePaymentMethod();
                    $closurePaymentMethod->payment_method   = $closurePaymentMethodArray['payment_method'];
                    $closurePaymentMethod->value            = $closurePaymentMethodArray['value'];
                    $closurePaymentMethod->closure          = $closure->id;
                    $closurePaymentMethod->store();
                }
                foreach($withdrawals as $withdrawalArray){
                    $withdrawal                             = new Withdrawal();
                    $withdrawal->user                       = $withdrawalArray['user'];
                    $withdrawal->store                      = $withdrawalArray['store'];
                    $withdrawal->cashier                    = $withdrawalArray['cashier'];
                    $withdrawal->closure                    = $closure->id;
                    $withdrawal->withdrawal_account         = $withdrawalArray['withdrawal_account'];
                    $withdrawal->dt_withdrawal              = $withdrawalArray['dt_withdrawal'];
                    $withdrawal->value                      = $withdrawalArray['value'];
                    $withdrawal->obs                        = $withdrawalArray['obs'];
                    $withdrawal->store();
                }
            }
            TTransaction::close();
            $param['id']              = $closure->id;
            $result = array();
            $result['error']          = false;
            $result['data']           = $param;
            return $result;
        }catch(Exception $e){
            $error = array();
            $error['error']             = true;
            $error['data']              = $e->getmessage();
            TTransaction::rollback();
            return $error;
        }
    }
}
