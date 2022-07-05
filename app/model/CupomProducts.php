<?php

class CupomProducts extends TRecord
{
    const TABLENAME  = 'cupom_products';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_product;
    private $fk_cupom;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('product');
        parent::addAttribute('cupom');
        parent::addAttribute('active');
            
    }

    /**
     * Method set_product
     * Sample of usage: $var->product = $object;
     * @param $object Instance of Product
     */
    public function set_fk_product(Product $object)
    {
        $this->fk_product = $object;
        $this->product = $object->id;
    }

    /**
     * Method get_fk_product
     * Sample of usage: $var->fk_product->attribute;
     * @returns Product instance
     */
    public function get_fk_product()
    {
    
        // loads the associated object
        if (empty($this->fk_product))
            $this->fk_product = new Product($this->product);
    
        // returns the associated object
        return $this->fk_product;
    }
    /**
     * Method set_cupom
     * Sample of usage: $var->cupom = $object;
     * @param $object Instance of Cupom
     */
    public function set_fk_cupom(Cupom $object)
    {
        $this->fk_cupom = $object;
        $this->cupom = $object->id;
    }

    /**
     * Method get_fk_cupom
     * Sample of usage: $var->fk_cupom->attribute;
     * @returns Cupom instance
     */
    public function get_fk_cupom()
    {
    
        // loads the associated object
        if (empty($this->fk_cupom))
            $this->fk_cupom = new Cupom($this->cupom);
    
        // returns the associated object
        return $this->fk_cupom;
    }

    
}

