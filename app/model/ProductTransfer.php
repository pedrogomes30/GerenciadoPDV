<?php

class ProductTransfer extends TRecord
{
    const TABLENAME  = 'product_transfer';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_deposit_origin;
    private $fk_product;
    private $fk_deposit_destiny;
    private $fk_product_storage_origin;
    private $fk_product_storage_destiny;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('quantity');
        parent::addAttribute('transfer_type');
        parent::addAttribute('protocol');
        parent::addAttribute('user');
        parent::addAttribute('deposit_origin');
        parent::addAttribute('product_storage_origin');
        parent::addAttribute('deposit_destiny');
        parent::addAttribute('product_storage_destiny');
        parent::addAttribute('product');
            
    }

    /**
     * Method set_deposit
     * Sample of usage: $var->deposit = $object;
     * @param $object Instance of Deposit
     */
    public function set_fk_deposit_origin(Deposit $object)
    {
        $this->fk_deposit_origin = $object;
        $this->deposit_origin = $object->id;
    }

    /**
     * Method get_fk_deposit_origin
     * Sample of usage: $var->fk_deposit_origin->attribute;
     * @returns Deposit instance
     */
    public function get_fk_deposit_origin()
    {
    
        // loads the associated object
        if (empty($this->fk_deposit_origin))
            $this->fk_deposit_origin = new Deposit($this->deposit_origin);
    
        // returns the associated object
        return $this->fk_deposit_origin;
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
     * Method set_deposit
     * Sample of usage: $var->deposit = $object;
     * @param $object Instance of Deposit
     */
    public function set_fk_deposit_destiny(Deposit $object)
    {
        $this->fk_deposit_destiny = $object;
        $this->deposit_destiny = $object->id;
    }

    /**
     * Method get_fk_deposit_destiny
     * Sample of usage: $var->fk_deposit_destiny->attribute;
     * @returns Deposit instance
     */
    public function get_fk_deposit_destiny()
    {
    
        // loads the associated object
        if (empty($this->fk_deposit_destiny))
            $this->fk_deposit_destiny = new Deposit($this->deposit_destiny);
    
        // returns the associated object
        return $this->fk_deposit_destiny;
    }
    /**
     * Method set_product_storage
     * Sample of usage: $var->product_storage = $object;
     * @param $object Instance of ProductStorage
     */
    public function set_fk_product_storage_origin(ProductStorage $object)
    {
        $this->fk_product_storage_origin = $object;
        $this->product_storage_origin = $object->id;
    }

    /**
     * Method get_fk_product_storage_origin
     * Sample of usage: $var->fk_product_storage_origin->attribute;
     * @returns ProductStorage instance
     */
    public function get_fk_product_storage_origin()
    {
    
        // loads the associated object
        if (empty($this->fk_product_storage_origin))
            $this->fk_product_storage_origin = new ProductStorage($this->product_storage_origin);
    
        // returns the associated object
        return $this->fk_product_storage_origin;
    }
    /**
     * Method set_product_storage
     * Sample of usage: $var->product_storage = $object;
     * @param $object Instance of ProductStorage
     */
    public function set_fk_product_storage_destiny(ProductStorage $object)
    {
        $this->fk_product_storage_destiny = $object;
        $this->product_storage_destiny = $object->id;
    }

    /**
     * Method get_fk_product_storage_destiny
     * Sample of usage: $var->fk_product_storage_destiny->attribute;
     * @returns ProductStorage instance
     */
    public function get_fk_product_storage_destiny()
    {
    
        // loads the associated object
        if (empty($this->fk_product_storage_destiny))
            $this->fk_product_storage_destiny = new ProductStorage($this->product_storage_destiny);
    
        // returns the associated object
        return $this->fk_product_storage_destiny;
    }

    
}

