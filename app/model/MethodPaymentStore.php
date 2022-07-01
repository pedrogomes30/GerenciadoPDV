<?php

class MethodPaymentStore extends TRecord
{
    const TABLENAME  = 'method_payment_store';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $method;
    private $store;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('method_id');
        parent::addAttribute('store_id');
            
    }

    /**
     * Method set_payment_method
     * Sample of usage: $var->payment_method = $object;
     * @param $object Instance of PaymentMethod
     */
    public function set_method(PaymentMethod $object)
    {
        $this->method = $object;
        $this->method_id = $object->id;
    }

    /**
     * Method get_method
     * Sample of usage: $var->method->attribute;
     * @returns PaymentMethod instance
     */
    public function get_method()
    {
    
        // loads the associated object
        if (empty($this->method))
            $this->method = new PaymentMethod($this->method_id);
    
        // returns the associated object
        return $this->method;
    }
    /**
     * Method set_store
     * Sample of usage: $var->store = $object;
     * @param $object Instance of Store
     */
    public function set_store(Store $object)
    {
        $this->store = $object;
        $this->store_id = $object->id;
    }

    /**
     * Method get_store
     * Sample of usage: $var->store->attribute;
     * @returns Store instance
     */
    public function get_store()
    {
    
        // loads the associated object
        if (empty($this->store))
            $this->store = new Store($this->store_id);
    
        // returns the associated object
        return $this->store;
    }

    
}

