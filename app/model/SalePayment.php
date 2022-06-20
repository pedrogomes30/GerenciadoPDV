<?php

class SalePayment extends TRecord
{
    const TABLENAME  = 'sale_payment';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_sale;
    private $fk_payment_method;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('value');
        parent::addAttribute('sale_date');
        parent::addAttribute('store');
        parent::addAttribute('sale');
        parent::addAttribute('payment_method');
            
    }

    /**
     * Method set_sale
     * Sample of usage: $var->sale = $object;
     * @param $object Instance of Sale
     */
    public function set_fk_sale(Sale $object)
    {
        $this->fk_sale = $object;
        $this->sale = $object->id;
    }

    /**
     * Method get_fk_sale
     * Sample of usage: $var->fk_sale->attribute;
     * @returns Sale instance
     */
    public function get_fk_sale()
    {
    
        // loads the associated object
        if (empty($this->fk_sale))
            $this->fk_sale = new Sale($this->sale);
    
        // returns the associated object
        return $this->fk_sale;
    }
    /**
     * Method set_payment_method
     * Sample of usage: $var->payment_method = $object;
     * @param $object Instance of PaymentMethod
     */
    public function set_fk_payment_method(PaymentMethod $object)
    {
        $this->fk_payment_method = $object;
        $this->payment_method = $object->id;
    }

    /**
     * Method get_fk_payment_method
     * Sample of usage: $var->fk_payment_method->attribute;
     * @returns PaymentMethod instance
     */
    public function get_fk_payment_method()
    {
        TTransaction::open('pos_system');
        // loads the associated object
        if (empty($this->fk_payment_method))
            $this->fk_payment_method = new PaymentMethod($this->payment_method);
        TTransaction::close();
        // returns the associated object
        return $this->fk_payment_method;
    }

    
}

