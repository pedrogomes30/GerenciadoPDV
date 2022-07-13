<?php

class Cupom extends TRecord
{
    const TABLENAME  = 'cupom';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const AVAR = '1';
    const FUNC = '2';
    const PARC = '3';

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('with_client');
        parent::addAttribute('code');
        parent::addAttribute('value');
        parent::addAttribute('description');
        parent::addAttribute('all_products');
        parent::addAttribute('acumulate');
        parent::addAttribute('percent');
        parent::addAttribute('quantity');
        parent::addAttribute('default');
            
    }

    /**
     * Method getCupomProductss
     */
    public function getCupomProductss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('cupom', '=', $this->id));
        return CupomProducts::getObjects( $criteria );
    }
    /**
     * Method getItemCupoms
     */
    public function getItemCupoms()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('cupom', '=', $this->id));
        return ItemCupom::getObjects( $criteria );
    }

    public function set_cupom_products_fk_product_to_string($cupom_products_fk_product_to_string)
    {
        if(is_array($cupom_products_fk_product_to_string))
        {
            $values = Product::where('id', 'in', $cupom_products_fk_product_to_string)->getIndexedArray('description', 'description');
            $this->cupom_products_fk_product_to_string = implode(', ', $values);
        }
        else
        {
            $this->cupom_products_fk_product_to_string = $cupom_products_fk_product_to_string;
        }

        $this->vdata['cupom_products_fk_product_to_string'] = $this->cupom_products_fk_product_to_string;
    }

    public function get_cupom_products_fk_product_to_string()
    {
        if(!empty($this->cupom_products_fk_product_to_string))
        {
            return $this->cupom_products_fk_product_to_string;
        }
    
        $values = CupomProducts::where('cupom', '=', $this->id)->getIndexedArray('product','{fk_product->description}');
        return implode(', ', $values);
    }

    public function set_cupom_products_fk_cupom_to_string($cupom_products_fk_cupom_to_string)
    {
        if(is_array($cupom_products_fk_cupom_to_string))
        {
            $values = Cupom::where('id', 'in', $cupom_products_fk_cupom_to_string)->getIndexedArray('id', 'id');
            $this->cupom_products_fk_cupom_to_string = implode(', ', $values);
        }
        else
        {
            $this->cupom_products_fk_cupom_to_string = $cupom_products_fk_cupom_to_string;
        }

        $this->vdata['cupom_products_fk_cupom_to_string'] = $this->cupom_products_fk_cupom_to_string;
    }

    public function get_cupom_products_fk_cupom_to_string()
    {
        if(!empty($this->cupom_products_fk_cupom_to_string))
        {
            return $this->cupom_products_fk_cupom_to_string;
        }
    
        $values = CupomProducts::where('cupom', '=', $this->id)->getIndexedArray('cupom','{fk_cupom->id}');
        return implode(', ', $values);
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
    
        $values = ItemCupom::where('cupom', '=', $this->id)->getIndexedArray('sale_item','{fk_sale_item->id}');
        return implode(', ', $values);
    }

    
}

