<?php

class Deposit extends TRecord
{
    const TABLENAME  = 'deposit';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_store;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('name');
        parent::addAttribute('store');
            
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
     * Method getProductStorages
     */
    public function getProductStorages()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('deposit', '=', $this->id));
        return ProductStorage::getObjects( $criteria );
    }
    /**
     * Method getProductTransfers
     */
    public function getProductTransfersByFkDepositOrigins()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('deposit_origin', '=', $this->id));
        return ProductTransfer::getObjects( $criteria );
    }
    /**
     * Method getProductTransfers
     */
    public function getProductTransfersByFkDepositDestinys()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('deposit_destiny', '=', $this->id));
        return ProductTransfer::getObjects( $criteria );
    }
    /**
     * Method getSaleItems
     */
    public function getSaleItems()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('deposit', '=', $this->id));
        return SaleItem::getObjects( $criteria );
    }

    public function set_product_storage_fk_deposit_to_string($product_storage_fk_deposit_to_string)
    {
        if(is_array($product_storage_fk_deposit_to_string))
        {
            $values = Deposit::where('id', 'in', $product_storage_fk_deposit_to_string)->getIndexedArray('name', 'name');
            $this->product_storage_fk_deposit_to_string = implode(', ', $values);
        }
        else
        {
            $this->product_storage_fk_deposit_to_string = $product_storage_fk_deposit_to_string;
        }

        $this->vdata['product_storage_fk_deposit_to_string'] = $this->product_storage_fk_deposit_to_string;
    }

    public function get_product_storage_fk_deposit_to_string()
    {
        if(!empty($this->product_storage_fk_deposit_to_string))
        {
            return $this->product_storage_fk_deposit_to_string;
        }
    
        $values = ProductStorage::where('deposit', '=', $this->id)->getIndexedArray('deposit','{fk_deposit->name}');
        return implode(', ', $values);
    }

    public function set_product_storage_fk_product_to_string($product_storage_fk_product_to_string)
    {
        if(is_array($product_storage_fk_product_to_string))
        {
            $values = Product::where('id', 'in', $product_storage_fk_product_to_string)->getIndexedArray('description', 'description');
            $this->product_storage_fk_product_to_string = implode(', ', $values);
        }
        else
        {
            $this->product_storage_fk_product_to_string = $product_storage_fk_product_to_string;
        }

        $this->vdata['product_storage_fk_product_to_string'] = $this->product_storage_fk_product_to_string;
    }

    public function get_product_storage_fk_product_to_string()
    {
        if(!empty($this->product_storage_fk_product_to_string))
        {
            return $this->product_storage_fk_product_to_string;
        }
    
        $values = ProductStorage::where('deposit', '=', $this->id)->getIndexedArray('product','{fk_product->description}');
        return implode(', ', $values);
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
    
        $values = ProductTransfer::where('deposit_destiny', '=', $this->id)->getIndexedArray('deposit_origin','{fk_deposit_origin->name}');
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
    
        $values = ProductTransfer::where('deposit_destiny', '=', $this->id)->getIndexedArray('product_storage_origin','{fk_product_storage_origin->id}');
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
    
        $values = ProductTransfer::where('deposit_destiny', '=', $this->id)->getIndexedArray('deposit_destiny','{fk_deposit_destiny->name}');
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
    
        $values = ProductTransfer::where('deposit_destiny', '=', $this->id)->getIndexedArray('product_storage_destiny','{fk_product_storage_destiny->id}');
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
    
        $values = ProductTransfer::where('deposit_destiny', '=', $this->id)->getIndexedArray('product','{fk_product->description}');
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
    
        $values = SaleItem::where('deposit', '=', $this->id)->getIndexedArray('sale','{fk_sale->id}');
        return implode(', ', $values);
    }

    
}

