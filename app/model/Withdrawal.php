<?php

class Withdrawal extends TRecord
{
    const TABLENAME  = 'withdrawal';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_user;
    private $fk_store;
    private $fk_cashier;
    private $fk_closure;
    private $fk_withdrawal_account;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('user');
        parent::addAttribute('store');
        parent::addAttribute('cashier');
        parent::addAttribute('closure');
        parent::addAttribute('withdrawal_account');
        parent::addAttribute('dt_withdrawal');
        parent::addAttribute('value');
        parent::addAttribute('obs');
            
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
     * Method set_closure
     * Sample of usage: $var->closure = $object;
     * @param $object Instance of Closure
     */
    public function set_fk_closure(Closure $object)
    {
        $this->fk_closure = $object;
        $this->closure = $object->id;
    }

    /**
     * Method get_fk_closure
     * Sample of usage: $var->fk_closure->attribute;
     * @returns Closure instance
     */
    public function get_fk_closure()
    {
    
        // loads the associated object
        if (empty($this->fk_closure))
            $this->fk_closure = new Closure($this->closure);
    
        // returns the associated object
        return $this->fk_closure;
    }
    /**
     * Method set_withdrawal_account
     * Sample of usage: $var->withdrawal_account = $object;
     * @param $object Instance of WithdrawalAccount
     */
    public function set_fk_withdrawal_account(WithdrawalAccount $object)
    {
        $this->fk_withdrawal_account = $object;
        $this->withdrawal_account = $object->id;
    }

    /**
     * Method get_fk_withdrawal_account
     * Sample of usage: $var->fk_withdrawal_account->attribute;
     * @returns WithdrawalAccount instance
     */
    public function get_fk_withdrawal_account()
    {
    
        // loads the associated object
        if (empty($this->fk_withdrawal_account))
            $this->fk_withdrawal_account = new WithdrawalAccount($this->withdrawal_account);
    
        // returns the associated object
        return $this->fk_withdrawal_account;
    }

    
}

