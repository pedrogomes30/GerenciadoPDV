<?php

class Cashier extends TRecord
{
    const TABLENAME  = 'cashier';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_store;
    private $fk_user_authenticated;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('name');
        parent::addAttribute('cashier_type');
        parent::addAttribute('user_authenticated');
        parent::addAttribute('store');
            
    }

    /**
     * Method set_store
     * Sample of usage: $var->store = $object;
     * @param $object Instance of Store
     */
    public function set_fk_store(Store $object)
    {
        $this->fk_store = $object;
        $this->store = $object->id;
    }

    /**
     * Method get_fk_store
     * Sample of usage: $var->fk_store->attribute;
     * @returns Store instance
     */
    public function get_fk_store()
    {
    
        // loads the associated object
        if (empty($this->fk_store))
            $this->fk_store = new Store($this->store);
    
        // returns the associated object
        return $this->fk_store;
    }
    /**
     * Method set_user
     * Sample of usage: $var->user = $object;
     * @param $object Instance of User
     */
    public function set_fk_user_authenticated(User $object)
    {
        $this->fk_user_authenticated = $object;
        $this->user_authenticated = $object->id;
    }

    /**
     * Method get_fk_user_authenticated
     * Sample of usage: $var->fk_user_authenticated->attribute;
     * @returns User instance
     */
    public function get_fk_user_authenticated()
    {
    
        // loads the associated object
        if (empty($this->fk_user_authenticated))
            $this->fk_user_authenticated = new User($this->user_authenticated);
    
        // returns the associated object
        return $this->fk_user_authenticated;
    }

    /**
     * Method getSales
     */
    public function getSales()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('cashier', '=', $this->id));
        return Sale::getObjects( $criteria );
    }
    /**
     * Method getCashierLogs
     */
    public function getCashierLogs()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('cashier_id', '=', $this->id));
        return CashierLog::getObjects( $criteria );
    }
    /**
     * Method getClosures
     */
    public function getClosures()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('cashier', '=', $this->id));
        return Closure::getObjects( $criteria );
    }
    /**
     * Method getWithdrawals
     */
    public function getWithdrawals()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('cashier', '=', $this->id));
        return Withdrawal::getObjects( $criteria );
    }

    public function set_sale_fk_status_to_string($sale_fk_status_to_string)
    {
        if(is_array($sale_fk_status_to_string))
        {
            $values = Status::where('id', 'in', $sale_fk_status_to_string)->getIndexedArray('id', 'id');
            $this->sale_fk_status_to_string = implode(', ', $values);
        }
        else
        {
            $this->sale_fk_status_to_string = $sale_fk_status_to_string;
        }

        $this->vdata['sale_fk_status_to_string'] = $this->sale_fk_status_to_string;
    }

    public function get_sale_fk_status_to_string()
    {
        if(!empty($this->sale_fk_status_to_string))
        {
            return $this->sale_fk_status_to_string;
        }
    
        $values = Sale::where('cashier', '=', $this->id)->getIndexedArray('status','{fk_status->id}');
        return implode(', ', $values);
    }

    public function set_cashier_log_fk_user_to_string($cashier_log_fk_user_to_string)
    {
        if(is_array($cashier_log_fk_user_to_string))
        {
            $values = User::where('id', 'in', $cashier_log_fk_user_to_string)->getIndexedArray('id', 'id');
            $this->cashier_log_fk_user_to_string = implode(', ', $values);
        }
        else
        {
            $this->cashier_log_fk_user_to_string = $cashier_log_fk_user_to_string;
        }

        $this->vdata['cashier_log_fk_user_to_string'] = $this->cashier_log_fk_user_to_string;
    }

    public function get_cashier_log_fk_user_to_string()
    {
        if(!empty($this->cashier_log_fk_user_to_string))
        {
            return $this->cashier_log_fk_user_to_string;
        }
    
        $values = CashierLog::where('cashier_id', '=', $this->id)->getIndexedArray('user','{fk_user->id}');
        return implode(', ', $values);
    }

    public function set_cashier_log_cashier_to_string($cashier_log_cashier_to_string)
    {
        if(is_array($cashier_log_cashier_to_string))
        {
            $values = Cashier::where('id', 'in', $cashier_log_cashier_to_string)->getIndexedArray('id', 'id');
            $this->cashier_log_cashier_to_string = implode(', ', $values);
        }
        else
        {
            $this->cashier_log_cashier_to_string = $cashier_log_cashier_to_string;
        }

        $this->vdata['cashier_log_cashier_to_string'] = $this->cashier_log_cashier_to_string;
    }

    public function get_cashier_log_cashier_to_string()
    {
        if(!empty($this->cashier_log_cashier_to_string))
        {
            return $this->cashier_log_cashier_to_string;
        }
    
        $values = CashierLog::where('cashier_id', '=', $this->id)->getIndexedArray('cashier_id','{cashier->id}');
        return implode(', ', $values);
    }

    public function set_withdrawal_fk_closure_to_string($withdrawal_fk_closure_to_string)
    {
        if(is_array($withdrawal_fk_closure_to_string))
        {
            $values = Closure::where('id', 'in', $withdrawal_fk_closure_to_string)->getIndexedArray('id', 'id');
            $this->withdrawal_fk_closure_to_string = implode(', ', $values);
        }
        else
        {
            $this->withdrawal_fk_closure_to_string = $withdrawal_fk_closure_to_string;
        }

        $this->vdata['withdrawal_fk_closure_to_string'] = $this->withdrawal_fk_closure_to_string;
    }

    public function get_withdrawal_fk_closure_to_string()
    {
        if(!empty($this->withdrawal_fk_closure_to_string))
        {
            return $this->withdrawal_fk_closure_to_string;
        }
    
        $values = Withdrawal::where('cashier', '=', $this->id)->getIndexedArray('closure','{fk_closure->id}');
        return implode(', ', $values);
    }

    public function set_withdrawal_fk_withdrawal_account_to_string($withdrawal_fk_withdrawal_account_to_string)
    {
        if(is_array($withdrawal_fk_withdrawal_account_to_string))
        {
            $values = WithdrawalAccount::where('id', 'in', $withdrawal_fk_withdrawal_account_to_string)->getIndexedArray('id', 'id');
            $this->withdrawal_fk_withdrawal_account_to_string = implode(', ', $values);
        }
        else
        {
            $this->withdrawal_fk_withdrawal_account_to_string = $withdrawal_fk_withdrawal_account_to_string;
        }

        $this->vdata['withdrawal_fk_withdrawal_account_to_string'] = $this->withdrawal_fk_withdrawal_account_to_string;
    }

    public function get_withdrawal_fk_withdrawal_account_to_string()
    {
        if(!empty($this->withdrawal_fk_withdrawal_account_to_string))
        {
            return $this->withdrawal_fk_withdrawal_account_to_string;
        }
    
        $values = Withdrawal::where('cashier', '=', $this->id)->getIndexedArray('withdrawal_account','{fk_withdrawal_account->id}');
        return implode(', ', $values);
    }

    
}

