<?php

class StoreGroup extends TRecord
{
    const TABLENAME  = 'store_group';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const fashionbiju = '1';
    const jadebiju = '2';
    const tjbiju = '3';
    const florbiju = '4';
    const mimosbiju = '5';
    const divinabiju = '6';

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('name');
        parent::addAttribute('default_theme');
            
    }

    /**
     * Method getStores
     */
    public function getStores()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('store_group', '=', $this->id));
        return Store::getObjects( $criteria );
    }

    public function set_store_fk_store_group_to_string($store_fk_store_group_to_string)
    {
        if(is_array($store_fk_store_group_to_string))
        {
            $values = StoreGroup::where('id', 'in', $store_fk_store_group_to_string)->getIndexedArray('name', 'name');
            $this->store_fk_store_group_to_string = implode(', ', $values);
        }
        else
        {
            $this->store_fk_store_group_to_string = $store_fk_store_group_to_string;
        }

        $this->vdata['store_fk_store_group_to_string'] = $this->store_fk_store_group_to_string;
    }

    public function get_store_fk_store_group_to_string()
    {
        if(!empty($this->store_fk_store_group_to_string))
        {
            return $this->store_fk_store_group_to_string;
        }
    
        $values = Store::where('store_group', '=', $this->id)->getIndexedArray('store_group','{fk_store_group->name}');
        return implode(', ', $values);
    }

    
}

