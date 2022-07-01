<?php

class CestNcm extends TRecord
{
    const TABLENAME  = 'cest_ncm';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_cest;
    private $fk_ncm;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('cest');
        parent::addAttribute('ncm');
            
    }

    /**
     * Method set_cest
     * Sample of usage: $var->cest = $object;
     * @param $object Instance of Cest
     */
    public function set_fk_cest(Cest $object)
    {
        $this->fk_cest = $object;
        $this->cest = $object->id;
    }

    /**
     * Method get_fk_cest
     * Sample of usage: $var->fk_cest->attribute;
     * @returns Cest instance
     */
    public function get_fk_cest()
    {
    
        // loads the associated object
        if (empty($this->fk_cest))
            $this->fk_cest = new Cest($this->cest);
    
        // returns the associated object
        return $this->fk_cest;
    }
    /**
     * Method set_ncm
     * Sample of usage: $var->ncm = $object;
     * @param $object Instance of Ncm
     */
    public function set_fk_ncm(Ncm $object)
    {
        $this->fk_ncm = $object;
        $this->ncm = $object->id;
    }

    /**
     * Method get_fk_ncm
     * Sample of usage: $var->fk_ncm->attribute;
     * @returns Ncm instance
     */
    public function get_fk_ncm()
    {
    
        // loads the associated object
        if (empty($this->fk_ncm))
            $this->fk_ncm = new Ncm($this->ncm);
    
        // returns the associated object
        return $this->fk_ncm;
    }

    /**
     * Method getProducts
     */
    public function getProducts()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('cest_ncm', '=', $this->id));
        return Product::getObjects( $criteria );
    }
    /**
     * Method getCategorys
     */
    public function getCategorys()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('cest_ncm_default', '=', $this->id));
        return Category::getObjects( $criteria );
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
    
        $values = Product::where('cest_ncm', '=', $this->id)->getIndexedArray('cest_ncm','{fk_cest_ncm->id}');
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
    
        $values = Product::where('cest_ncm', '=', $this->id)->getIndexedArray('provider','{fk_provider->social_name}');
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
    
        $values = Product::where('cest_ncm', '=', $this->id)->getIndexedArray('brand','{fk_brand->name}');
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
    
        $values = Product::where('cest_ncm', '=', $this->id)->getIndexedArray('type','{fk_type->description}');
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
    
        $values = Product::where('cest_ncm', '=', $this->id)->getIndexedArray('status','{fk_status->status}');
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
    
        $values = Product::where('cest_ncm', '=', $this->id)->getIndexedArray('category','{fk_category->name}');
        return implode(', ', $values);
    }

    public function set_category_fk_cest_ncm_default_to_string($category_fk_cest_ncm_default_to_string)
    {
        if(is_array($category_fk_cest_ncm_default_to_string))
        {
            $values = CestNcm::where('id', 'in', $category_fk_cest_ncm_default_to_string)->getIndexedArray('id', 'id');
            $this->category_fk_cest_ncm_default_to_string = implode(', ', $values);
        }
        else
        {
            $this->category_fk_cest_ncm_default_to_string = $category_fk_cest_ncm_default_to_string;
        }

        $this->vdata['category_fk_cest_ncm_default_to_string'] = $this->category_fk_cest_ncm_default_to_string;
    }

    public function get_category_fk_cest_ncm_default_to_string()
    {
        if(!empty($this->category_fk_cest_ncm_default_to_string))
        {
            return $this->category_fk_cest_ncm_default_to_string;
        }
    
        $values = Category::where('cest_ncm_default', '=', $this->id)->getIndexedArray('cest_ncm_default','{fk_cest_ncm_default->id}');
        return implode(', ', $values);
    }

    
}

