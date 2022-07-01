<?php

class AdjustClosure extends TRecord
{
    const TABLENAME  = 'adjust_closure';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_closure;
    private $fk_cashier_method;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('justify');
        parent::addAttribute('adjust_value');
        parent::addAttribute('closure');
        parent::addAttribute('cashier_method');
            
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
     * Method set_closure_payment_methods
     * Sample of usage: $var->closure_payment_methods = $object;
     * @param $object Instance of ClosurePaymentMethods
     */
    public function set_fk_cashier_method(ClosurePaymentMethods $object)
    {
        $this->fk_cashier_method = $object;
        $this->cashier_method = $object->id;
    }

    /**
     * Method get_fk_cashier_method
     * Sample of usage: $var->fk_cashier_method->attribute;
     * @returns ClosurePaymentMethods instance
     */
    public function get_fk_cashier_method()
    {
    
        // loads the associated object
        if (empty($this->fk_cashier_method))
            $this->fk_cashier_method = new ClosurePaymentMethods($this->cashier_method);
    
        // returns the associated object
        return $this->fk_cashier_method;
    }

    
}

