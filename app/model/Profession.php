<?php

class Profession extends TRecord
{
    const TABLENAME  = 'profession';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const manager = '1';
    const cashier = '2';
    const stockist = '3';
    const aux_admin = '4';
    const admin = '5';

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('description');
        parent::addAttribute('is_manager');
            
    }

    /**
     * Method getUsers
     */
    public function getUsers()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('profession', '=', $this->id));
        return User::getObjects( $criteria );
    }

    public function set_user_fk_origin_store_to_string($user_fk_origin_store_to_string)
    {
        if(is_array($user_fk_origin_store_to_string))
        {
            $values = Store::where('id', 'in', $user_fk_origin_store_to_string)->getIndexedArray('fantasy_name', 'fantasy_name');
            $this->user_fk_origin_store_to_string = implode(', ', $values);
        }
        else
        {
            $this->user_fk_origin_store_to_string = $user_fk_origin_store_to_string;
        }

        $this->vdata['user_fk_origin_store_to_string'] = $this->user_fk_origin_store_to_string;
    }

    public function get_user_fk_origin_store_to_string()
    {
        if(!empty($this->user_fk_origin_store_to_string))
        {
            return $this->user_fk_origin_store_to_string;
        }
    
        $values = User::where('profession', '=', $this->id)->getIndexedArray('origin_store','{fk_origin_store->fantasy_name}');
        return implode(', ', $values);
    }

    public function set_user_fk_current_store_to_string($user_fk_current_store_to_string)
    {
        if(is_array($user_fk_current_store_to_string))
        {
            $values = Store::where('id', 'in', $user_fk_current_store_to_string)->getIndexedArray('fantasy_name', 'fantasy_name');
            $this->user_fk_current_store_to_string = implode(', ', $values);
        }
        else
        {
            $this->user_fk_current_store_to_string = $user_fk_current_store_to_string;
        }

        $this->vdata['user_fk_current_store_to_string'] = $this->user_fk_current_store_to_string;
    }

    public function get_user_fk_current_store_to_string()
    {
        if(!empty($this->user_fk_current_store_to_string))
        {
            return $this->user_fk_current_store_to_string;
        }
    
        $values = User::where('profession', '=', $this->id)->getIndexedArray('current_store','{fk_current_store->fantasy_name}');
        return implode(', ', $values);
    }

    public function set_user_fk_profession_to_string($user_fk_profession_to_string)
    {
        if(is_array($user_fk_profession_to_string))
        {
            $values = Profession::where('id', 'in', $user_fk_profession_to_string)->getIndexedArray('id', 'id');
            $this->user_fk_profession_to_string = implode(', ', $values);
        }
        else
        {
            $this->user_fk_profession_to_string = $user_fk_profession_to_string;
        }

        $this->vdata['user_fk_profession_to_string'] = $this->user_fk_profession_to_string;
    }

    public function get_user_fk_profession_to_string()
    {
        if(!empty($this->user_fk_profession_to_string))
        {
            return $this->user_fk_profession_to_string;
        }
    
        $values = User::where('profession', '=', $this->id)->getIndexedArray('profession','{fk_profession->id}');
        return implode(', ', $values);
    }

    
}

