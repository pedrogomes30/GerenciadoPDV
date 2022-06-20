<?php

class Price extends TRecord
{
    const TABLENAME  = 'price';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_list_price;
    private $fk_product;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('sell_price');
        parent::addAttribute('cust_price');
        parent::addAttribute('product');
        parent::addAttribute('list_price');
            
    }

    /**
     * Method set_price_list
     * Sample of usage: $var->price_list = $object;
     * @param $object Instance of PriceList
     */
    public function set_fk_list_price(PriceList $object)
    {
        $this->fk_list_price = $object;
        $this->list_price = $object->id;
    }

    /**
     * Method get_fk_list_price
     * Sample of usage: $var->fk_list_price->attribute;
     * @returns PriceList instance
     */
    public function get_fk_list_price()
    {
    
        // loads the associated object
        if (empty($this->fk_list_price))
            $this->fk_list_price = new PriceList($this->list_price);
    
        // returns the associated object
        return $this->fk_list_price;
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

