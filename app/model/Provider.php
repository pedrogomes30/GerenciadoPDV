<?php

class Provider extends TRecord
{
    const TABLENAME  = 'provider';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const fornecedor_exemplo = '1';

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('social_name');
        parent::addAttribute('cnpj');
        parent::addAttribute('fantasy_name');
            
    }

    /**
     * Method getProducts
     */
    public function getProducts()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('provider', '=', $this->id));
        return Product::getObjects( $criteria );
    }
    /**
     * Method getBrands
     */
    public function getBrands()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('provider', '=', $this->id));
        return Brand::getObjects( $criteria );
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
    
        $values = Product::where('provider', '=', $this->id)->getIndexedArray('cest_ncm','{fk_cest_ncm->id}');
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
    
        $values = Product::where('provider', '=', $this->id)->getIndexedArray('provider','{fk_provider->social_name}');
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
    
        $values = Product::where('provider', '=', $this->id)->getIndexedArray('brand','{fk_brand->name}');
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
    
        $values = Product::where('provider', '=', $this->id)->getIndexedArray('type','{fk_type->description}');
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
    
        $values = Product::where('provider', '=', $this->id)->getIndexedArray('status','{fk_status->status}');
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
    
        $values = Product::where('provider', '=', $this->id)->getIndexedArray('category','{fk_category->name}');
        return implode(', ', $values);
    }

    public function set_brand_fk_provider_to_string($brand_fk_provider_to_string)
    {
        if(is_array($brand_fk_provider_to_string))
        {
            $values = Provider::where('id', 'in', $brand_fk_provider_to_string)->getIndexedArray('social_name', 'social_name');
            $this->brand_fk_provider_to_string = implode(', ', $values);
        }
        else
        {
            $this->brand_fk_provider_to_string = $brand_fk_provider_to_string;
        }

        $this->vdata['brand_fk_provider_to_string'] = $this->brand_fk_provider_to_string;
    }

    public function get_brand_fk_provider_to_string()
    {
        if(!empty($this->brand_fk_provider_to_string))
        {
            return $this->brand_fk_provider_to_string;
        }
    
        $values = Brand::where('provider', '=', $this->id)->getIndexedArray('provider','{fk_provider->social_name}');
        return implode(', ', $values);
    }

    
}

