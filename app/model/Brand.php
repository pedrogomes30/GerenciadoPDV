<?php

class Brand extends TRecord
{
    const TABLENAME  = 'brand';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_provider;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('name');
        parent::addAttribute('provider');
            
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
     * Method getProducts
     */
    public function getProducts()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('brand', '=', $this->id));
        return Product::getObjects( $criteria );
    }

    public function set_product_fk_cest_ncm_to_string($product_fk_cest_ncm_to_string)
    {
        if(is_array($product_fk_cest_ncm_to_string))
        {
            $values = CestNcm::where('id', 'in', $product_fk_cest_ncm_to_string)->getIndexedArray('id', 'id');
            $this->product_fk_cest_ncm_to_string = implode(', ', $values);
        }
        else
        {
            $this->product_fk_cest_ncm_to_string = $product_fk_cest_ncm_to_string;
        }

        $this->vdata['product_fk_cest_ncm_to_string'] = $this->product_fk_cest_ncm_to_string;
    }

    public function get_product_fk_cest_ncm_to_string()
    {
        if(!empty($this->product_fk_cest_ncm_to_string))
        {
            return $this->product_fk_cest_ncm_to_string;
        }
    
        $values = Product::where('brand', '=', $this->id)->getIndexedArray('cest_ncm','{fk_cest_ncm->id}');
        return implode(', ', $values);
    }

    public function set_product_fk_provider_to_string($product_fk_provider_to_string)
    {
        if(is_array($product_fk_provider_to_string))
        {
            $values = Provider::where('id', 'in', $product_fk_provider_to_string)->getIndexedArray('social_name', 'social_name');
            $this->product_fk_provider_to_string = implode(', ', $values);
        }
        else
        {
            $this->product_fk_provider_to_string = $product_fk_provider_to_string;
        }

        $this->vdata['product_fk_provider_to_string'] = $this->product_fk_provider_to_string;
    }

    public function get_product_fk_provider_to_string()
    {
        if(!empty($this->product_fk_provider_to_string))
        {
            return $this->product_fk_provider_to_string;
        }
    
        $values = Product::where('brand', '=', $this->id)->getIndexedArray('provider','{fk_provider->social_name}');
        return implode(', ', $values);
    }

    public function set_product_fk_brand_to_string($product_fk_brand_to_string)
    {
        if(is_array($product_fk_brand_to_string))
        {
            $values = Brand::where('id', 'in', $product_fk_brand_to_string)->getIndexedArray('name', 'name');
            $this->product_fk_brand_to_string = implode(', ', $values);
        }
        else
        {
            $this->product_fk_brand_to_string = $product_fk_brand_to_string;
        }

        $this->vdata['product_fk_brand_to_string'] = $this->product_fk_brand_to_string;
    }

    public function get_product_fk_brand_to_string()
    {
        if(!empty($this->product_fk_brand_to_string))
        {
            return $this->product_fk_brand_to_string;
        }
    
        $values = Product::where('brand', '=', $this->id)->getIndexedArray('brand','{fk_brand->name}');
        return implode(', ', $values);
    }

    public function set_product_fk_type_to_string($product_fk_type_to_string)
    {
        if(is_array($product_fk_type_to_string))
        {
            $values = ProductType::where('id', 'in', $product_fk_type_to_string)->getIndexedArray('description', 'description');
            $this->product_fk_type_to_string = implode(', ', $values);
        }
        else
        {
            $this->product_fk_type_to_string = $product_fk_type_to_string;
        }

        $this->vdata['product_fk_type_to_string'] = $this->product_fk_type_to_string;
    }

    public function get_product_fk_type_to_string()
    {
        if(!empty($this->product_fk_type_to_string))
        {
            return $this->product_fk_type_to_string;
        }
    
        $values = Product::where('brand', '=', $this->id)->getIndexedArray('type','{fk_type->description}');
        return implode(', ', $values);
    }

    public function set_product_fk_status_to_string($product_fk_status_to_string)
    {
        if(is_array($product_fk_status_to_string))
        {
            $values = ProductStatus::where('id', 'in', $product_fk_status_to_string)->getIndexedArray('status', 'status');
            $this->product_fk_status_to_string = implode(', ', $values);
        }
        else
        {
            $this->product_fk_status_to_string = $product_fk_status_to_string;
        }

        $this->vdata['product_fk_status_to_string'] = $this->product_fk_status_to_string;
    }

    public function get_product_fk_status_to_string()
    {
        if(!empty($this->product_fk_status_to_string))
        {
            return $this->product_fk_status_to_string;
        }
    
        $values = Product::where('brand', '=', $this->id)->getIndexedArray('status','{fk_status->status}');
        return implode(', ', $values);
    }

    public function set_product_fk_category_to_string($product_fk_category_to_string)
    {
        if(is_array($product_fk_category_to_string))
        {
            $values = Category::where('id', 'in', $product_fk_category_to_string)->getIndexedArray('name', 'name');
            $this->product_fk_category_to_string = implode(', ', $values);
        }
        else
        {
            $this->product_fk_category_to_string = $product_fk_category_to_string;
        }

        $this->vdata['product_fk_category_to_string'] = $this->product_fk_category_to_string;
    }

    public function get_product_fk_category_to_string()
    {
        if(!empty($this->product_fk_category_to_string))
        {
            return $this->product_fk_category_to_string;
        }
    
        $values = Product::where('brand', '=', $this->id)->getIndexedArray('category','{fk_category->name}');
        return implode(', ', $values);
    }

    
}

