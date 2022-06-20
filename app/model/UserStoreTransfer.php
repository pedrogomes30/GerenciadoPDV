<?php

class UserStoreTransfer extends TRecord
{
    const TABLENAME  = 'user_store_transfer';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_user;
    private $fk_store_destiny;
    private $fk_store_origin;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('dt_transfer');
        parent::addAttribute('reason');
        parent::addAttribute('user');
        parent::addAttribute('store_origin');
        parent::addAttribute('store_destiny');
            
    }

    /**
     * Method set_user
     * Sample of usage: $var->user = $object;
     * @param $object Instance of User
     */
    public function set_fk_user(User $object)
    {
        $this->fk_user = $object;
        $this->user = $object->id;
    }

    /**
     * Method get_fk_user
     * Sample of usage: $var->fk_user->attribute;
     * @returns User instance
     */
    public function get_fk_user()
    {
    
        // loads the associated object
        if (empty($this->fk_user))
            $this->fk_user = new User($this->user);
    
        // returns the associated object
        return $this->fk_user;
    }
    /**
     * Method set_store
     * Sample of usage: $var->store = $object;
     * @param $object Instance of Store
     */
    public function set_fk_store_destiny(Store $object)
    {
        $this->fk_store_destiny = $object;
        $this->store_destiny = $object->id;
    }

    /**
     * Method get_fk_store_destiny
     * Sample of usage: $var->fk_store_destiny->attribute;
     * @returns Store instance
     */
    public function get_fk_store_destiny()
    {
    
        // loads the associated object
        if (empty($this->fk_store_destiny))
            $this->fk_store_destiny = new Store($this->store_destiny);
    
        // returns the associated object
        return $this->fk_store_destiny;
    }
    /**
     * Method set_store
     * Sample of usage: $var->store = $object;
     * @param $object Instance of Store
     */
    public function set_fk_store_origin(Store $object)
    {
        $this->fk_store_origin = $object;
        $this->store_origin = $object->id;
    }

    /**
     * Method get_fk_store_origin
     * Sample of usage: $var->fk_store_origin->attribute;
     * @returns Store instance
     */
    public function get_fk_store_origin()
    {
    
        // loads the associated object
        if (empty($this->fk_store_origin))
            $this->fk_store_origin = new Store($this->store_origin);
    
        // returns the associated object
        return $this->fk_store_origin;
    }

    
}

