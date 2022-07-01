<?php

class CashierLog extends TRecord
{
    const TABLENAME  = 'cashier_log';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $cashier;
    private $fk_user;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('dt_login');
        parent::addAttribute('dt_logout');
        parent::addAttribute('user');
        parent::addAttribute('cashier_id');
            
    }

    /**
     * Method set_cashier
     * Sample of usage: $var->cashier = $object;
     * @param $object Instance of Cashier
     */
    public function set_cashier(Cashier $object)
    {
        $this->cashier = $object;
        $this->cashier_id = $object->id;
    }

    /**
     * Method get_cashier
     * Sample of usage: $var->cashier->attribute;
     * @returns Cashier instance
     */
    public function get_cashier()
    {
    
        // loads the associated object
        if (empty($this->cashier))
            $this->cashier = new Cashier($this->cashier_id);
    
        // returns the associated object
        return $this->cashier;
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
    
        // loads the associated object
        if (empty($this->fk_user))
            $this->fk_user = new User($this->user);
    
        // returns the associated object
        return $this->fk_user;
    }

    
}

