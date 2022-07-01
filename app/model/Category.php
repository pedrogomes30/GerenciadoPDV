<?php

class Category extends TRecord
{
    const TABLENAME  = 'category';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const adornos_presentes = '2';
    const pelucia = '3';
    const maquiagem = '4';
    const acessorios_maquiagem = '6';
    const acessorios_cabelo = '5';
    const aneis = '7';
    const brincos = '8';
    const chapeu = '9';
    const cinto = '10';
    const carteira = '11';
    const bolsa = '12';
    const unha = '13';
    const necessair = '14';
    const produtos_cabelo = '15';
    const cuidados_pele = '16';
    const bijuterias = '17';
    const oculos = '18';
    const cadastro_antigo = '19';
    const relogio = '20';
    const inverno = '21';

    private $fk_cest_ncm_default;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('name');
        parent::addAttribute('color');
        parent::addAttribute('multiply');
        parent::addAttribute('icon_category');
        parent::addAttribute('cest_ncm_default');
    
    }

    /**
     * Method set_cest_ncm
     * Sample of usage: $var->cest_ncm = $object;
     * @param $object Instance of CestNcm
     */
    public function set_fk_cest_ncm_default(CestNcm $object)
    {
        $this->fk_cest_ncm_default = $object;
        $this->cest_ncm_default = $object->id;
    }

    /**
     * Method get_fk_cest_ncm_default
     * Sample of usage: $var->fk_cest_ncm_default->attribute;
     * @returns CestNcm instance
     */
    public function get_fk_cest_ncm_default()
    {
    
        // loads the associated object
        if (empty($this->fk_cest_ncm_default))
            $this->fk_cest_ncm_default = new CestNcm($this->cest_ncm_default);
    
        // returns the associated object
        return $this->fk_cest_ncm_default;
    }

    /**
     * Method getProducts
     */
    public function getProducts()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('category', '=', $this->id));
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
    
        $values = Product::where('category', '=', $this->id)->getIndexedArray('cest_ncm','{fk_cest_ncm->id}');
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
    
        $values = Product::where('category', '=', $this->id)->getIndexedArray('provider','{fk_provider->social_name}');
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
    
        $values = Product::where('category', '=', $this->id)->getIndexedArray('brand','{fk_brand->name}');
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
    
        $values = Product::where('category', '=', $this->id)->getIndexedArray('type','{fk_type->description}');
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
    
        $values = Product::where('category', '=', $this->id)->getIndexedArray('status','{fk_status->status}');
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
    
        $values = Product::where('category', '=', $this->id)->getIndexedArray('category','{fk_category->name}');
        return implode(', ', $values);
    }

}

