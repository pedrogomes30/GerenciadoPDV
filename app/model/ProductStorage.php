<?php

class ProductStorage extends TRecord
{
    const TABLENAME  = 'product_storage';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_deposit;
    private $fk_product;
    private $fk_store;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('quantity');
        parent::addAttribute('min_storage');
        parent::addAttribute('max_storage');
        parent::addAttribute('deposit');
        parent::addAttribute('product');
        parent::addAttribute('store');
            
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
    
        // loads the associated object
        if (empty($this->fk_deposit))
            $this->fk_deposit = new Deposit($this->deposit);
    
        // returns the associated object
        return $this->fk_deposit;
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
     * Method getProductTransfers
     */
    public function getProductTransfersByFkProductStorageOrigins()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('product_storage_origin', '=', $this->id));
        return ProductTransfer::getObjects( $criteria );
    }
    /**
     * Method getSaleItems
     */
    public function getSaleItems()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('product_storage', '=', $this->id));
        return SaleItem::getObjects( $criteria );
    }
    /**
     * Method getProductTransfers
     */
    public function getProductTransfersByFkProductStorageDestinys()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('product_storage_destiny', '=', $this->id));
        return ProductTransfer::getObjects( $criteria );
    }

    public function set_product_transfer_fk_deposit_origin_to_string($product_transfer_fk_deposit_origin_to_string)
    {
        if(is_array($product_transfer_fk_deposit_origin_to_string))
        {
            $values = Deposit::where('id', 'in', $product_transfer_fk_deposit_origin_to_string)->getIndexedArray('name', 'name');
            $this->product_transfer_fk_deposit_origin_to_string = implode(', ', $values);
        }
        else
        {
            $this->product_transfer_fk_deposit_origin_to_string = $product_transfer_fk_deposit_origin_to_string;
        }

        $this->vdata['product_transfer_fk_deposit_origin_to_string'] = $this->product_transfer_fk_deposit_origin_to_string;
    }

    public function get_product_transfer_fk_deposit_origin_to_string()
    {
        if(!empty($this->product_transfer_fk_deposit_origin_to_string))
        {
            return $this->product_transfer_fk_deposit_origin_to_string;
        }
    
        $values = ProductTransfer::where('product_storage_destiny', '=', $this->id)->getIndexedArray('deposit_origin','{fk_deposit_origin->name}');
        return implode(', ', $values);
    }

    public function set_product_transfer_fk_product_storage_origin_to_string($product_transfer_fk_product_storage_origin_to_string)
    {
        if(is_array($product_transfer_fk_product_storage_origin_to_string))
        {
            $values = ProductStorage::where('id', 'in', $product_transfer_fk_product_storage_origin_to_string)->getIndexedArray('id', 'id');
            $this->product_transfer_fk_product_storage_origin_to_string = implode(', ', $values);
        }
        else
        {
            $this->product_transfer_fk_product_storage_origin_to_string = $product_transfer_fk_product_storage_origin_to_string;
        }

        $this->vdata['product_transfer_fk_product_storage_origin_to_string'] = $this->product_transfer_fk_product_storage_origin_to_string;
    }

    public function get_product_transfer_fk_product_storage_origin_to_string()
    {
        if(!empty($this->product_transfer_fk_product_storage_origin_to_string))
        {
            return $this->product_transfer_fk_product_storage_origin_to_string;
        }
    
        $values = ProductTransfer::where('product_storage_destiny', '=', $this->id)->getIndexedArray('product_storage_origin','{fk_product_storage_origin->id}');
        return implode(', ', $values);
    }

    public function set_product_transfer_fk_deposit_destiny_to_string($product_transfer_fk_deposit_destiny_to_string)
    {
        if(is_array($product_transfer_fk_deposit_destiny_to_string))
        {
            $values = Deposit::where('id', 'in', $product_transfer_fk_deposit_destiny_to_string)->getIndexedArray('name', 'name');
            $this->product_transfer_fk_deposit_destiny_to_string = implode(', ', $values);
        }
        else
        {
            $this->product_transfer_fk_deposit_destiny_to_string = $product_transfer_fk_deposit_destiny_to_string;
        }

        $this->vdata['product_transfer_fk_deposit_destiny_to_string'] = $this->product_transfer_fk_deposit_destiny_to_string;
    }

    public function get_product_transfer_fk_deposit_destiny_to_string()
    {
        if(!empty($this->product_transfer_fk_deposit_destiny_to_string))
        {
            return $this->product_transfer_fk_deposit_destiny_to_string;
        }
    
        $values = ProductTransfer::where('product_storage_destiny', '=', $this->id)->getIndexedArray('deposit_destiny','{fk_deposit_destiny->name}');
        return implode(', ', $values);
    }

    public function set_product_transfer_fk_product_storage_destiny_to_string($product_transfer_fk_product_storage_destiny_to_string)
    {
        if(is_array($product_transfer_fk_product_storage_destiny_to_string))
        {
            $values = ProductStorage::where('id', 'in', $product_transfer_fk_product_storage_destiny_to_string)->getIndexedArray('id', 'id');
            $this->product_transfer_fk_product_storage_destiny_to_string = implode(', ', $values);
        }
        else
        {
            $this->product_transfer_fk_product_storage_destiny_to_string = $product_transfer_fk_product_storage_destiny_to_string;
        }

        $this->vdata['product_transfer_fk_product_storage_destiny_to_string'] = $this->product_transfer_fk_product_storage_destiny_to_string;
    }

    public function get_product_transfer_fk_product_storage_destiny_to_string()
    {
        if(!empty($this->product_transfer_fk_product_storage_destiny_to_string))
        {
            return $this->product_transfer_fk_product_storage_destiny_to_string;
        }
    
        $values = ProductTransfer::where('product_storage_destiny', '=', $this->id)->getIndexedArray('product_storage_destiny','{fk_product_storage_destiny->id}');
        return implode(', ', $values);
    }

    public function set_product_transfer_fk_product_to_string($product_transfer_fk_product_to_string)
    {
        if(is_array($product_transfer_fk_product_to_string))
        {
            $values = Product::where('id', 'in', $product_transfer_fk_product_to_string)->getIndexedArray('description', 'description');
            $this->product_transfer_fk_product_to_string = implode(', ', $values);
        }
        else
        {
            $this->product_transfer_fk_product_to_string = $product_transfer_fk_product_to_string;
        }

        $this->vdata['product_transfer_fk_product_to_string'] = $this->product_transfer_fk_product_to_string;
    }

    public function get_product_transfer_fk_product_to_string()
    {
        if(!empty($this->product_transfer_fk_product_to_string))
        {
            return $this->product_transfer_fk_product_to_string;
        }
    
        $values = ProductTransfer::where('product_storage_destiny', '=', $this->id)->getIndexedArray('product','{fk_product->description}');
        return implode(', ', $values);
    }

    public function set_sale_item_fk_sale_to_string($sale_item_fk_sale_to_string)
    {
        if(is_array($sale_item_fk_sale_to_string))
        {
            $values = Sale::where('id', 'in', $sale_item_fk_sale_to_string)->getIndexedArray('id', 'id');
            $this->sale_item_fk_sale_to_string = implode(', ', $values);
        }
        else
        {
            $this->sale_item_fk_sale_to_string = $sale_item_fk_sale_to_string;
        }

        $this->vdata['sale_item_fk_sale_to_string'] = $this->sale_item_fk_sale_to_string;
    }

    public function get_sale_item_fk_sale_to_string()
    {
        if(!empty($this->sale_item_fk_sale_to_string))
        {
            return $this->sale_item_fk_sale_to_string;
        }
    
        $values = SaleItem::where('product_storage', '=', $this->id)->getIndexedArray('sale','{fk_sale->id}');
        return implode(', ', $values);
    }

    
}

