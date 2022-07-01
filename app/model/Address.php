<?php

class Address extends TRecord
{
    const TABLENAME  = 'address';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_customer;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('postalCode');
        parent::addAttribute('customer');
            
    }

    /**
     * Method set_customer
     * Sample of usage: $var->customer = $object;
     * @param $object Instance of Customer
     */
    public function set_fk_customer(Customer $object)
    {
        $this->fk_customer = $object;
        $this->customer = $object->id;
    }

    /**
     * Method get_fk_customer
     * Sample of usage: $var->fk_customer->attribute;
     * @returns Customer instance
     */
    public function get_fk_customer()
    {
    
        // loads the associated object
        if (empty($this->fk_customer))
            $this->fk_customer = new Customer($this->customer);
    
        // returns the associated object
        return $this->fk_customer;
    }

    
}

