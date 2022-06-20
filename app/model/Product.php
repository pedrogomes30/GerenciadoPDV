<?php

class Product extends TRecord
{
    const TABLENAME  = 'product';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_category;
    private $fk_brand;
    private $fk_provider;
    private $fk_cest_ncm;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('description');
        parent::addAttribute('sku');
        parent::addAttribute('unity');
        parent::addAttribute('type');
        parent::addAttribute('status');
        parent::addAttribute('description_variation');
        parent::addAttribute('reference');
        parent::addAttribute('barcode');
        parent::addAttribute('family_id');
        parent::addAttribute('obs');
        parent::addAttribute('website');
        parent::addAttribute('origin');
        parent::addAttribute('tribute_situation');
        parent::addAttribute('cest');
        parent::addAttribute('ncm');
        parent::addAttribute('is_variation');
        parent::addAttribute('cest_ncm');
        parent::addAttribute('provider');
        parent::addAttribute('brand');
        parent::addAttribute('category');
            
    }

    /**
     * Method set_category
     * Sample of usage: $var->category = $object;
     * @param $object Instance of Category
     */
    public function set_fk_category(Category $object)
    {
        $this->fk_category = $object;
        $this->category = $object->id;
    }

    /**
     * Method get_fk_category
     * Sample of usage: $var->fk_category->attribute;
     * @returns Category instance
     */
    public function get_fk_category()
    {
    
        // loads the associated object
        if (empty($this->fk_category))
            $this->fk_category = new Category($this->category);
    
        // returns the associated object
        return $this->fk_category;
    }
    /**
     * Method set_brand
     * Sample of usage: $var->brand = $object;
     * @param $object Instance of Brand
     */
    public function set_fk_brand(Brand $object)
    {
        $this->fk_brand = $object;
        $this->brand = $object->id;
    }

    /**
     * Method get_fk_brand
     * Sample of usage: $var->fk_brand->attribute;
     * @returns Brand instance
     */
    public function get_fk_brand()
    {
    
        // loads the associated object
        if (empty($this->fk_brand))
            $this->fk_brand = new Brand($this->brand);
    
        // returns the associated object
        return $this->fk_brand;
    }
    /**
     * Method set_provider
     * Sample of usage: $var->provider = $object;
     * @param $object Instance of Provider
     */
    public function set_fk_provider(Provider $object)
    {
        $this->fk_provider = $object;
        $this->provider = $object->id;
    }

    /**
     * Method get_fk_provider
     * Sample of usage: $var->fk_provider->attribute;
     * @returns Provider instance
     */
    public function get_fk_provider()
    {
    
        // loads the associated object
        if (empty($this->fk_provider))
            $this->fk_provider = new Provider($this->provider);
    
        // returns the associated object
        return $this->fk_provider;
    }
    /**
     * Method set_cest_ncm
     * Sample of usage: $var->cest_ncm = $object;
     * @param $object Instance of CestNcm
     */
    public function set_fk_cest_ncm(CestNcm $object)
    {
        $this->fk_cest_ncm = $object;
        $this->cest_ncm = $object->id;
    }

    /**
     * Method get_fk_cest_ncm
     * Sample of usage: $var->fk_cest_ncm->attribute;
     * @returns CestNcm instance
     */
    public function get_fk_cest_ncm()
    {
    
        // loads the associated object
        if (empty($this->fk_cest_ncm))
            $this->fk_cest_ncm = new CestNcm($this->cest_ncm);
    
        // returns the associated object
        return $this->fk_cest_ncm;
    }

    /**
     * Method getProductStorages
     */
    public function getProductStorages()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('product', '=', $this->id));
        return ProductStorage::getObjects( $criteria );
    }
    /**
     * Method getProductTransfers
     */
    public function getProductTransfers()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('product', '=', $this->id));
        return ProductTransfer::getObjects( $criteria );
    }
    /**
     * Method getPrices
     */
    public function getPrices()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('product', '=', $this->id));
        return Price::getObjects( $criteria );
    }
    /**
     * Method getSaleItems
     */
    public function getSaleItems()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('product', '=', $this->id));
        return SaleItem::getObjects( $criteria );
    }
    /**
     * Method getProductValidateDates
     */
    public function getProductValidateDates()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('product', '=', $this->id));
        return ProductValidateDate::getObjects( $criteria );
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
    
        $values = ProductStorage::where('product', '=', $this->id)->getIndexedArray('deposit','{fk_deposit->name}');
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
    
        $values = ProductStorage::where('product', '=', $this->id)->getIndexedArray('product','{fk_product->description}');
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
    
        $values = ProductTransfer::where('product', '=', $this->id)->getIndexedArray('deposit_origin','{fk_deposit_origin->name}');
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
    
        $values = ProductTransfer::where('product', '=', $this->id)->getIndexedArray('product_storage_origin','{fk_product_storage_origin->id}');
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
    
        $values = ProductTransfer::where('product', '=', $this->id)->getIndexedArray('deposit_destiny','{fk_deposit_destiny->name}');
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
    
        $values = ProductTransfer::where('product', '=', $this->id)->getIndexedArray('product_storage_destiny','{fk_product_storage_destiny->id}');
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
    
        $values = ProductTransfer::where('product', '=', $this->id)->getIndexedArray('product','{fk_product->description}');
        return implode(', ', $values);
    }

    public function set_price_fk_product_to_string($price_fk_product_to_string)
    {
        if(is_array($price_fk_product_to_string))
        {
            $values = Product::where('id', 'in', $price_fk_product_to_string)->getIndexedArray('description', 'description');
            $this->price_fk_product_to_string = implode(', ', $values);
        }
        else
        {
            $this->price_fk_product_to_string = $price_fk_product_to_string;
        }

        $this->vdata['price_fk_product_to_string'] = $this->price_fk_product_to_string;
    }

    public function get_price_fk_product_to_string()
    {
        if(!empty($this->price_fk_product_to_string))
        {
            return $this->price_fk_product_to_string;
        }
    
        $values = Price::where('product', '=', $this->id)->getIndexedArray('product','{fk_product->description}');
        return implode(', ', $values);
    }

    public function set_price_fk_list_price_to_string($price_fk_list_price_to_string)
    {
        if(is_array($price_fk_list_price_to_string))
        {
            $values = PriceList::where('id', 'in', $price_fk_list_price_to_string)->getIndexedArray('name', 'name');
            $this->price_fk_list_price_to_string = implode(', ', $values);
        }
        else
        {
            $this->price_fk_list_price_to_string = $price_fk_list_price_to_string;
        }

        $this->vdata['price_fk_list_price_to_string'] = $this->price_fk_list_price_to_string;
    }

    public function get_price_fk_list_price_to_string()
    {
        if(!empty($this->price_fk_list_price_to_string))
        {
            return $this->price_fk_list_price_to_string;
        }
    
        $values = Price::where('product', '=', $this->id)->getIndexedArray('list_price','{fk_list_price->name}');
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
    
        $values = SaleItem::where('product', '=', $this->id)->getIndexedArray('sale','{fk_sale->id}');
        return implode(', ', $values);
    }

    public function set_product_validate_date_fk_product_to_string($product_validate_date_fk_product_to_string)
    {
        if(is_array($product_validate_date_fk_product_to_string))
        {
            $values = Product::where('id', 'in', $product_validate_date_fk_product_to_string)->getIndexedArray('description', 'description');
            $this->product_validate_date_fk_product_to_string = implode(', ', $values);
        }
        else
        {
            $this->product_validate_date_fk_product_to_string = $product_validate_date_fk_product_to_string;
        }

        $this->vdata['product_validate_date_fk_product_to_string'] = $this->product_validate_date_fk_product_to_string;
    }

    public function get_product_validate_date_fk_product_to_string()
    {
        if(!empty($this->product_validate_date_fk_product_to_string))
        {
            return $this->product_validate_date_fk_product_to_string;
        }
    
        $values = ProductValidateDate::where('product', '=', $this->id)->getIndexedArray('product','{fk_product->description}');
        return implode(', ', $values);
    }

    
}

