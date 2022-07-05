<?php

class Closure extends TRecord
{
    const TABLENAME  = 'closure';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_user;
    private $fk_store;
    private $fk_cashier;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('dt_close');
        parent::addAttribute('number');
        parent::addAttribute('closure_type');
        parent::addAttribute('dt_open');
        parent::addAttribute('value_total');
        parent::addAttribute('user');
        parent::addAttribute('cashier');
        parent::addAttribute('store');
            
    }

    /**
     * Method set_user
     * Sample of usage: $var->user = $object;
     * @param $object Instance of User
     */
    public function set_fk_user(User $object)
    {
        $this->fk_user = $object;
        $this->user = $object->id;
    }

    /**
     * Method get_fk_user
     * Sample of usage: $var->fk_user->attribute;
     * @returns User instance
     */
    public function get_fk_user()
    {
        TTransaction::open('pos_system');
        // loads the associated object
        if (empty($this->fk_user))
            $this->fk_user = new User($this->user);
        TTransaction::close();
        // returns the associated object
        return $this->fk_user;
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
        TTransaction::open('pos_system');
        // loads the associated object
        if (empty($this->fk_store))
            $this->fk_store = new Store($this->store);
        TTransaction::close();
        // returns the associated object
        return $this->fk_store;
    }
    /**
     * Method set_cashier
     * Sample of usage: $var->cashier = $object;
     * @param $object Instance of Cashier
     */
    public function set_fk_cashier(Cashier $object)
    {
        $this->fk_cashier = $object;
        $this->cashier = $object->id;
    }

    /**
     * Method get_fk_cashier
     * Sample of usage: $var->fk_cashier->attribute;
     * @returns Cashier instance
     */
    public function get_fk_cashier()
    {
        TTransaction::open('pos_system');
        // loads the associated object
        if (empty($this->fk_cashier))
            $this->fk_cashier = new Cashier($this->cashier);
        TTransaction::close();
        // returns the associated object
        return $this->fk_cashier;
    }

    /**
     * Method getClosurePaymentMethodss
     */
    public function getClosurePaymentMethodss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('closure', '=', $this->id));
        return ClosurePaymentMethods::getObjects( $criteria );
    }
    /**
     * Method getWithdrawals
     */
    public function getWithdrawals()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('closure', '=', $this->id));
        return Withdrawal::getObjects( $criteria );
    }
    /**
     * Method getAdjustClosures
     */
    public function getAdjustClosures()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('closure', '=', $this->id));
        return AdjustClosure::getObjects( $criteria );
    }

    public function set_closure_payment_methods_fk_closure_to_string($closure_payment_methods_fk_closure_to_string)
    {
        if(is_array($closure_payment_methods_fk_closure_to_string))
        {
            $values = Closure::where('id', 'in', $closure_payment_methods_fk_closure_to_string)->getIndexedArray('id', 'id');
            $this->closure_payment_methods_fk_closure_to_string = implode(', ', $values);
        }
        else
        {
            $this->closure_payment_methods_fk_closure_to_string = $closure_payment_methods_fk_closure_to_string;
        }

        $this->vdata['closure_payment_methods_fk_closure_to_string'] = $this->closure_payment_methods_fk_closure_to_string;
    }

    public function get_closure_payment_methods_fk_closure_to_string()
    {
        if(!empty($this->closure_payment_methods_fk_closure_to_string))
        {
            return $this->closure_payment_methods_fk_closure_to_string;
        }
    
        $values = ClosurePaymentMethods::where('closure', '=', $this->id)->getIndexedArray('closure','{fk_closure->id}');
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
    
        $values = Withdrawal::where('closure', '=', $this->id)->getIndexedArray('closure','{fk_closure->id}');
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
    
        $values = Withdrawal::where('closure', '=', $this->id)->getIndexedArray('withdrawal_account','{fk_withdrawal_account->id}');
        return implode(', ', $values);
    }

    public function set_adjust_closure_fk_closure_to_string($adjust_closure_fk_closure_to_string)
    {
        if(is_array($adjust_closure_fk_closure_to_string))
        {
            $values = Closure::where('id', 'in', $adjust_closure_fk_closure_to_string)->getIndexedArray('id', 'id');
            $this->adjust_closure_fk_closure_to_string = implode(', ', $values);
        }
        else
        {
            $this->adjust_closure_fk_closure_to_string = $adjust_closure_fk_closure_to_string;
        }

        $this->vdata['adjust_closure_fk_closure_to_string'] = $this->adjust_closure_fk_closure_to_string;
    }

    public function get_adjust_closure_fk_closure_to_string()
    {
        if(!empty($this->adjust_closure_fk_closure_to_string))
        {
            return $this->adjust_closure_fk_closure_to_string;
        }
    
        $values = AdjustClosure::where('closure', '=', $this->id)->getIndexedArray('closure','{fk_closure->id}');
        return implode(', ', $values);
    }

    public function set_adjust_closure_fk_cashier_method_to_string($adjust_closure_fk_cashier_method_to_string)
    {
        if(is_array($adjust_closure_fk_cashier_method_to_string))
        {
            $values = ClosurePaymentMethods::where('id', 'in', $adjust_closure_fk_cashier_method_to_string)->getIndexedArray('id', 'id');
            $this->adjust_closure_fk_cashier_method_to_string = implode(', ', $values);
        }
        else
        {
            $this->adjust_closure_fk_cashier_method_to_string = $adjust_closure_fk_cashier_method_to_string;
        }

        $this->vdata['adjust_closure_fk_cashier_method_to_string'] = $this->adjust_closure_fk_cashier_method_to_string;
    }

    public function get_adjust_closure_fk_cashier_method_to_string()
    {
        if(!empty($this->adjust_closure_fk_cashier_method_to_string))
        {
            return $this->adjust_closure_fk_cashier_method_to_string;
        }
    
        $values = AdjustClosure::where('closure', '=', $this->id)->getIndexedArray('cashier_method','{fk_cashier_method->id}');
        return implode(', ', $values);
    }

    
}

