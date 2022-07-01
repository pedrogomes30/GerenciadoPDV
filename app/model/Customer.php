<?php

class Customer extends TRecord
{
    const TABLENAME  = 'customer';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_system_user;
    private $fk_store_partiner;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('name');
        parent::addAttribute('document');
        parent::addAttribute('document_type');
        parent::addAttribute('email');
        parent::addAttribute('city');
        parent::addAttribute('uf');
        parent::addAttribute('postal_code');
        parent::addAttribute('phone_1');
        parent::addAttribute('phone_2');
        parent::addAttribute('phone_3');
        parent::addAttribute('system_user');
        parent::addAttribute('store_partiner');
            
    }

    /**
     * Method set_user
     * Sample of usage: $var->user = $object;
     * @param $object Instance of User
     */
    public function set_fk_system_user(User $object)
    {
        $this->fk_system_user = $object;
        $this->system_user = $object->id;
    }

    /**
     * Method get_fk_system_user
     * Sample of usage: $var->fk_system_user->attribute;
     * @returns User instance
     */
    public function get_fk_system_user()
    {
        TTransaction::open('pos_system');
        // loads the associated object
        if (empty($this->fk_system_user))
            $this->fk_system_user = new User($this->system_user);
        TTransaction::close();
        // returns the associated object
        return $this->fk_system_user;
    }
    /**
     * Method set_store_partiner
     * Sample of usage: $var->store_partiner = $object;
     * @param $object Instance of StorePartiner
     */
    public function set_fk_store_partiner(StorePartiner $object)
    {
        $this->fk_store_partiner = $object;
        $this->store_partiner = $object->id;
    }

    /**
     * Method get_fk_store_partiner
     * Sample of usage: $var->fk_store_partiner->attribute;
     * @returns StorePartiner instance
     */
    public function get_fk_store_partiner()
    {
    
        // loads the associated object
        if (empty($this->fk_store_partiner))
            $this->fk_store_partiner = new StorePartiner($this->store_partiner);
    
        // returns the associated object
        return $this->fk_store_partiner;
    }

    
}

