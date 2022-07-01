<?php

class Price extends TRecord
{
    const TABLENAME  = 'price';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_price_list;
    private $fk_product;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('sell_price');
        parent::addAttribute('cost_price');
        parent::addAttribute('product');
        parent::addAttribute('price_list');
            
    }

    /**
     * Method set_price_list
     * Sample of usage: $var->price_list = $object;
     * @param $object Instance of PriceList
     */
    public function set_fk_price_list(PriceList $object)
    {
        $this->fk_price_list = $object;
        $this->price_list = $object->id;
    }

    /**
     * Method get_fk_price_list
     * Sample of usage: $var->fk_price_list->attribute;
     * @returns PriceList instance
     */
    public function get_fk_price_list()
    {
    
        // loads the associated object
        if (empty($this->fk_price_list))
            $this->fk_price_list = new PriceList($this->price_list);
    
        // returns the associated object
        return $this->fk_price_list;
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

