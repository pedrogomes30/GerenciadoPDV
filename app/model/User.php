<?php

class User extends TRecord
{
    const TABLENAME  = 'user';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_system_user;
    private $fk_profession;
    private $fk_origin_store;
    private $fk_current_store;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('obs');
        parent::addAttribute('profile_img');
        parent::addAttribute('origin_store');
        parent::addAttribute('current_store');
        parent::addAttribute('profession');
        parent::addAttribute('system_user');
    
    }

    /**
     * Method set_system_users
     * Sample of usage: $var->system_users = $object;
     * @param $object Instance of SystemUsers
     */
    public function set_fk_system_user(SystemUsers $object)
    {
        $this->fk_system_user = $object;
        $this->system_user = $object->id;
    }

    /**
     * Method get_fk_system_user
     * Sample of usage: $var->fk_system_user->attribute;
     * @returns SystemUsers instance
     */
    public function get_fk_system_user()
    {
        TTransaction::open('permission');
        // loads the associated object
        if (empty($this->fk_system_user))
            $this->fk_system_user = new SystemUsers($this->system_user);
        TTransaction::close();
        // returns the associated object
        return $this->fk_system_user;
    }
    /**
     * Method set_profession
     * Sample of usage: $var->profession = $object;
     * @param $object Instance of Profession
     */
    public function set_fk_profession(Profession $object)
    {
        $this->fk_profession = $object;
        $this->profession = $object->id;
    }

    /**
     * Method get_fk_profession
     * Sample of usage: $var->fk_profession->attribute;
     * @returns Profession instance
     */
    public function get_fk_profession()
    {
    
        // loads the associated object
        if (empty($this->fk_profession))
            $this->fk_profession = new Profession($this->profession);
    
        // returns the associated object
        return $this->fk_profession;
    }
    /**
     * Method set_store
     * Sample of usage: $var->store = $object;
     * @param $object Instance of Store
     */
    public function set_fk_origin_store(Store $object)
    {
        $this->fk_origin_store = $object;
        $this->origin_store = $object->id;
    }

    /**
     * Method get_fk_origin_store
     * Sample of usage: $var->fk_origin_store->attribute;
     * @returns Store instance
     */
    public function get_fk_origin_store()
    {
    
        // loads the associated object
        if (empty($this->fk_origin_store))
            $this->fk_origin_store = new Store($this->origin_store);
    
        // returns the associated object
        return $this->fk_origin_store;
    }
    /**
     * Method set_store
     * Sample of usage: $var->store = $object;
     * @param $object Instance of Store
     */
    public function set_fk_current_store(Store $object)
    {
        $this->fk_current_store = $object;
        $this->current_store = $object->id;
    }

    /**
     * Method get_fk_current_store
     * Sample of usage: $var->fk_current_store->attribute;
     * @returns Store instance
     */
    public function get_fk_current_store()
    {
    
        // loads the associated object
        if (empty($this->fk_current_store))
            $this->fk_current_store = new Store($this->current_store);
    
        // returns the associated object
        return $this->fk_current_store;
    }

    /**
     * Method getCashiers
     */
    public function getCashiers()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('user_authenticated', '=', $this->id));
        return Cashier::getObjects( $criteria );
    }
    /**
     * Method getSales
     */
    public function getSalesByFkEmployeeCashiers()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('employee_cashier', '=', $this->id));
        return Sale::getObjects( $criteria );
    }
    /**
     * Method getSales
     */
    public function getSalesByFkCustomers()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('customer', '=', $this->id));
        return Sale::getObjects( $criteria );
    }
    /**
     * Method getSales
     */
    public function getSalesByFkSalesmans()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('salesman', '=', $this->id));
        return Sale::getObjects( $criteria );
    }
    /**
     * Method getCustomers
     */
    public function getCustomers()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('system_user', '=', $this->id));
        return Customer::getObjects( $criteria );
    }
    /**
     * Method getCashierLogs
     */
    public function getCashierLogs()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('user', '=', $this->id));
        return CashierLog::getObjects( $criteria );
    }
    /**
     * Method getClosures
     */
    public function getClosures()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('user', '=', $this->id));
        return Closure::getObjects( $criteria );
    }
    /**
     * Method getWithdrawals
     */
    public function getWithdrawals()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('user', '=', $this->id));
        return Withdrawal::getObjects( $criteria );
    }
    /**
     * Method getUserStoreTransfers
     */
    public function getUserStoreTransfers()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('user', '=', $this->id));
        return UserStoreTransfer::getObjects( $criteria );
    }

    public function set_cashier_fk_user_authenticated_to_string($cashier_fk_user_authenticated_to_string)
    {
        if(is_array($cashier_fk_user_authenticated_to_string))
        {
            $values = User::where('id', 'in', $cashier_fk_user_authenticated_to_string)->getIndexedArray('id', 'id');
            $this->cashier_fk_user_authenticated_to_string = implode(', ', $values);
        }
        else
        {
            $this->cashier_fk_user_authenticated_to_string = $cashier_fk_user_authenticated_to_string;
        }

        $this->vdata['cashier_fk_user_authenticated_to_string'] = $this->cashier_fk_user_authenticated_to_string;
    }

    public function get_cashier_fk_user_authenticated_to_string()
    {
        if(!empty($this->cashier_fk_user_authenticated_to_string))
        {
            return $this->cashier_fk_user_authenticated_to_string;
        }
    
        $values = Cashier::where('user_authenticated', '=', $this->id)->getIndexedArray('user_authenticated','{fk_user_authenticated->id}');
        return implode(', ', $values);
    }

    public function set_cashier_fk_store_to_string($cashier_fk_store_to_string)
    {
        if(is_array($cashier_fk_store_to_string))
        {
            $values = Store::where('id', 'in', $cashier_fk_store_to_string)->getIndexedArray('fantasy_name', 'fantasy_name');
            $this->cashier_fk_store_to_string = implode(', ', $values);
        }
        else
        {
            $this->cashier_fk_store_to_string = $cashier_fk_store_to_string;
        }

        $this->vdata['cashier_fk_store_to_string'] = $this->cashier_fk_store_to_string;
    }

    public function get_cashier_fk_store_to_string()
    {
        if(!empty($this->cashier_fk_store_to_string))
        {
            return $this->cashier_fk_store_to_string;
        }
    
        $values = Cashier::where('user_authenticated', '=', $this->id)->getIndexedArray('store','{fk_store->fantasy_name}');
        return implode(', ', $values);
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
    
        $values = Sale::where('salesman', '=', $this->id)->getIndexedArray('status','{fk_status->id}');
        return implode(', ', $values);
    }

    public function set_customer_fk_store_partiner_to_string($customer_fk_store_partiner_to_string)
    {
        if(is_array($customer_fk_store_partiner_to_string))
        {
            $values = StorePartiner::where('id', 'in', $customer_fk_store_partiner_to_string)->getIndexedArray('name', 'name');
            $this->customer_fk_store_partiner_to_string = implode(', ', $values);
        }
        else
        {
            $this->customer_fk_store_partiner_to_string = $customer_fk_store_partiner_to_string;
        }

        $this->vdata['customer_fk_store_partiner_to_string'] = $this->customer_fk_store_partiner_to_string;
    }

    public function get_customer_fk_store_partiner_to_string()
    {
        if(!empty($this->customer_fk_store_partiner_to_string))
        {
            return $this->customer_fk_store_partiner_to_string;
        }
    
        $values = Customer::where('system_user', '=', $this->id)->getIndexedArray('store_partiner','{fk_store_partiner->name}');
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
    
        $values = CashierLog::where('user', '=', $this->id)->getIndexedArray('user','{fk_user->id}');
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
    
        $values = CashierLog::where('user', '=', $this->id)->getIndexedArray('cashier_id','{cashier->id}');
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
    
        $values = Withdrawal::where('user', '=', $this->id)->getIndexedArray('closure','{fk_closure->id}');
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
    
        $values = Withdrawal::where('user', '=', $this->id)->getIndexedArray('withdrawal_account','{fk_withdrawal_account->id}');
        return implode(', ', $values);
    }

    public function set_user_store_transfer_fk_user_to_string($user_store_transfer_fk_user_to_string)
    {
        if(is_array($user_store_transfer_fk_user_to_string))
        {
            $values = User::where('id', 'in', $user_store_transfer_fk_user_to_string)->getIndexedArray('id', 'id');
            $this->user_store_transfer_fk_user_to_string = implode(', ', $values);
        }
        else
        {
            $this->user_store_transfer_fk_user_to_string = $user_store_transfer_fk_user_to_string;
        }

        $this->vdata['user_store_transfer_fk_user_to_string'] = $this->user_store_transfer_fk_user_to_string;
    }

    public function get_user_store_transfer_fk_user_to_string()
    {
        if(!empty($this->user_store_transfer_fk_user_to_string))
        {
            return $this->user_store_transfer_fk_user_to_string;
        }
    
        $values = UserStoreTransfer::where('user', '=', $this->id)->getIndexedArray('user','{fk_user->id}');
        return implode(', ', $values);
    }

    public function set_user_store_transfer_fk_store_origin_to_string($user_store_transfer_fk_store_origin_to_string)
    {
        if(is_array($user_store_transfer_fk_store_origin_to_string))
        {
            $values = Store::where('id', 'in', $user_store_transfer_fk_store_origin_to_string)->getIndexedArray('fantasy_name', 'fantasy_name');
            $this->user_store_transfer_fk_store_origin_to_string = implode(', ', $values);
        }
        else
        {
            $this->user_store_transfer_fk_store_origin_to_string = $user_store_transfer_fk_store_origin_to_string;
        }

        $this->vdata['user_store_transfer_fk_store_origin_to_string'] = $this->user_store_transfer_fk_store_origin_to_string;
    }

    public function get_user_store_transfer_fk_store_origin_to_string()
    {
        if(!empty($this->user_store_transfer_fk_store_origin_to_string))
        {
            return $this->user_store_transfer_fk_store_origin_to_string;
        }
    
        $values = UserStoreTransfer::where('user', '=', $this->id)->getIndexedArray('store_origin','{fk_store_origin->fantasy_name}');
        return implode(', ', $values);
    }

    public function set_user_store_transfer_fk_store_destiny_to_string($user_store_transfer_fk_store_destiny_to_string)
    {
        if(is_array($user_store_transfer_fk_store_destiny_to_string))
        {
            $values = Store::where('id', 'in', $user_store_transfer_fk_store_destiny_to_string)->getIndexedArray('fantasy_name', 'fantasy_name');
            $this->user_store_transfer_fk_store_destiny_to_string = implode(', ', $values);
        }
        else
        {
            $this->user_store_transfer_fk_store_destiny_to_string = $user_store_transfer_fk_store_destiny_to_string;
        }

        $this->vdata['user_store_transfer_fk_store_destiny_to_string'] = $this->user_store_transfer_fk_store_destiny_to_string;
    }

    public function get_user_store_transfer_fk_store_destiny_to_string()
    {
        if(!empty($this->user_store_transfer_fk_store_destiny_to_string))
        {
            return $this->user_store_transfer_fk_store_destiny_to_string;
        }
    
        $values = UserStoreTransfer::where('user', '=', $this->id)->getIndexedArray('store_destiny','{fk_store_destiny->fantasy_name}');
        return implode(', ', $values);
    }

}

