<?php

class StorePartiner extends TRecord
{
    const TABLENAME  = 'store_partiner';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const fornecedor_exemplo = '1';

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('name');
        parent::addAttribute('cnpj');
            
    }

    /**
     * Method getCustomers
     */
    public function getCustomers()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('store_partiner', '=', $this->id));
        return Customer::getObjects( $criteria );
    }

    public function set_customer_fk_store_partiner_to_string($customer_fk_store_partiner_to_string)
    {
        if(is_array($customer_fk_store_partiner_to_string))
        {
            $values = StorePartiner::where('id', 'in', $customer_fk_store_partiner_to_string)->getIndexedArray('name', 'name');
            $this->customer_fk_store_partiner_to_string = implode(', ', $values);
        }
        else
        {
            $this->customer_fk_store_partiner_to_string = $customer_fk_store_partiner_to_string;
        }

        $this->vdata['customer_fk_store_partiner_to_string'] = $this->customer_fk_store_partiner_to_string;
    }

    public function get_customer_fk_store_partiner_to_string()
    {
        if(!empty($this->customer_fk_store_partiner_to_string))
        {
            return $this->customer_fk_store_partiner_to_string;
        }
    
        $values = Customer::where('store_partiner', '=', $this->id)->getIndexedArray('store_partiner','{fk_store_partiner->name}');
        return implode(', ', $values);
    }

    
}

