<?php

class ProductStatus extends TRecord
{
    const TABLENAME  = 'product_status';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const ATIVO = '1';
    const INATIVO = '2';
    const ERRO = '3';

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('status');
            
    }

    /**
     * Method getProducts
     */
    public function getProducts()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('status', '=', $this->id));
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
    
        $values = Product::where('status', '=', $this->id)->getIndexedArray('cest_ncm','{fk_cest_ncm->id}');
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
    
        $values = Product::where('status', '=', $this->id)->getIndexedArray('provider','{fk_provider->social_name}');
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
    
        $values = Product::where('status', '=', $this->id)->getIndexedArray('brand','{fk_brand->name}');
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
    
        $values = Product::where('status', '=', $this->id)->getIndexedArray('type','{fk_type->description}');
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
    
        $values = Product::where('status', '=', $this->id)->getIndexedArray('status','{fk_status->status}');
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
    
        $values = Product::where('status', '=', $this->id)->getIndexedArray('category','{fk_category->name}');
        return implode(', ', $values);
    }

    
}

