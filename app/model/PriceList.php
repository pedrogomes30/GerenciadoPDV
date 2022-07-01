<?php

class PriceList extends TRecord
{
    const TABLENAME  = 'price_list';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const PADRAO = '1';

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
     * Method getPrices
     */
    public function getPrices()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('price_list', '=', $this->id));
        return Price::getObjects( $criteria );
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
    
        $values = Price::where('price_list', '=', $this->id)->getIndexedArray('product','{fk_product->description}');
        return implode(', ', $values);
    }

    public function set_price_fk_price_list_to_string($price_fk_price_list_to_string)
    {
        if(is_array($price_fk_price_list_to_string))
        {
            $values = PriceList::where('id', 'in', $price_fk_price_list_to_string)->getIndexedArray('name', 'name');
            $this->price_fk_price_list_to_string = implode(', ', $values);
        }
        else
        {
            $this->price_fk_price_list_to_string = $price_fk_price_list_to_string;
        }

        $this->vdata['price_fk_price_list_to_string'] = $this->price_fk_price_list_to_string;
    }

    public function get_price_fk_price_list_to_string()
    {
        if(!empty($this->price_fk_price_list_to_string))
        {
            return $this->price_fk_price_list_to_string;
        }
    
        $values = Price::where('price_list', '=', $this->id)->getIndexedArray('price_list','{fk_price_list->name}');
        return implode(', ', $values);
    }

    
}

