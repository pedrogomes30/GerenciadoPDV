<?php

class SaleItem extends TRecord
{
    const TABLENAME  = 'sale_item';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_product;
    private $fk_sale;
    private $fk_store;
    private $fk_deposit;
    private $fk_product_storage;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('discont_value');
        parent::addAttribute('quantity');
        parent::addAttribute('unitary_value');
        parent::addAttribute('total_value');
        parent::addAttribute('sale_date');
        parent::addAttribute('sale');
        parent::addAttribute('store');
        parent::addAttribute('deposit');
        parent::addAttribute('product_storage');
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
        TTransaction::open('pos_product');
        // loads the associated object
        if (empty($this->fk_product))
            $this->fk_product = new Product($this->product);
        TTransaction::close();
        // returns the associated object
        return $this->fk_product;
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
        TTransaction::open('pos_system');
        // loads the associated object
        if (empty($this->fk_store))
            $this->fk_store = new Store($this->store);
        TTransaction::close();
        // returns the associated object
        return $this->fk_store;
    }
    /**
     * Method set_deposit
     * Sample of usage: $var->deposit = $object;
     * @param $object Instance of Deposit
     */
    public function set_fk_deposit(Deposit $object)
    {
        $this->fk_deposit = $object;
        $this->deposit = $object->id;
    }

    /**
     * Method get_fk_deposit
     * Sample of usage: $var->fk_deposit->attribute;
     * @returns Deposit instance
     */
    public function get_fk_deposit()
    {
        TTransaction::open('pos_product');
        // loads the associated object
        if (empty($this->fk_deposit))
            $this->fk_deposit = new Deposit($this->deposit);
        TTransaction::close();
        // returns the associated object
        return $this->fk_deposit;
    }
    /**
     * Method set_product_storage
     * Sample of usage: $var->product_storage = $object;
     * @param $object Instance of ProductStorage
     */
    public function set_fk_product_storage(ProductStorage $object)
    {
        $this->fk_product_storage = $object;
        $this->product_storage = $object->id;
    }

    /**
     * Method get_fk_product_storage
     * Sample of usage: $var->fk_product_storage->attribute;
     * @returns ProductStorage instance
     */
    public function get_fk_product_storage()
    {
        TTransaction::open('pos_product');
        // loads the associated object
        if (empty($this->fk_product_storage))
            $this->fk_product_storage = new ProductStorage($this->product_storage);
        TTransaction::close();
        // returns the associated object
        return $this->fk_product_storage;
    }

    /**
     * Method getItemCupoms
     */
    public function getItemCupoms()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('sale_item', '=', $this->id));
        return ItemCupom::getObjects( $criteria );
    }

    public function set_item_cupom_fk_sale_item_to_string($item_cupom_fk_sale_item_to_string)
    {
        if(is_array($item_cupom_fk_sale_item_to_string))
        {
            $values = SaleItem::where('id', 'in', $item_cupom_fk_sale_item_to_string)->getIndexedArray('id', 'id');
            $this->item_cupom_fk_sale_item_to_string = implode(', ', $values);
        }
        else
        {
            $this->item_cupom_fk_sale_item_to_string = $item_cupom_fk_sale_item_to_string;
        }

        $this->vdata['item_cupom_fk_sale_item_to_string'] = $this->item_cupom_fk_sale_item_to_string;
    }

    public function get_item_cupom_fk_sale_item_to_string()
    {
        if(!empty($this->item_cupom_fk_sale_item_to_string))
        {
            return $this->item_cupom_fk_sale_item_to_string;
        }
    
        $values = ItemCupom::where('sale_item', '=', $this->id)->getIndexedArray('sale_item','{fk_sale_item->id}');
        return implode(', ', $values);
    }

}

