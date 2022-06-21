<?php

class PaymentMethodStore extends TRecord
{
    const TABLENAME  = 'payment_method_store';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_method;
    private $fk_store;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('method');
        parent::addAttribute('store');
            
    }

    /**
     * Method set_payment_method
     * Sample of usage: $var->payment_method = $object;
     * @param $object Instance of PaymentMethod
     */
    public function set_fk_method(PaymentMethod $object)
    {
        $this->fk_method = $object;
        $this->method = $object->id;
    }

    /**
     * Method get_fk_method
     * Sample of usage: $var->fk_method->attribute;
     * @returns PaymentMethod instance
     */
    public function get_fk_method()
    {
    
        // loads the associated object
        if (empty($this->fk_method))
            $this->fk_method = new PaymentMethod($this->method);
    
        // returns the associated object
        return $this->fk_method;
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

    
}

