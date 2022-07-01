<?php

class ProductValidateDate extends TRecord
{
    const TABLENAME  = 'product_validate_date';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_product;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('lote');
        parent::addAttribute('dt_validate');
        parent::addAttribute('product');
            
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

    
}

