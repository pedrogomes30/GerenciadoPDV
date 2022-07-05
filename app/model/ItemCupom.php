<?php

class ItemCupom extends TRecord
{
    const TABLENAME  = 'item_cupom';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_cupom;
    private $fk_sale_item;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('value');
        parent::addAttribute('sale_item');
        parent::addAttribute('cupom');
            
    }

    /**
     * Method set_cupom
     * Sample of usage: $var->cupom = $object;
     * @param $object Instance of Cupom
     */
    public function set_fk_cupom(Cupom $object)
    {
        $this->fk_cupom = $object;
        $this->cupom = $object->id;
    }

    /**
     * Method get_fk_cupom
     * Sample of usage: $var->fk_cupom->attribute;
     * @returns Cupom instance
     */
    public function get_fk_cupom()
    {
        TTransaction::open('pos_product');
        // loads the associated object
        if (empty($this->fk_cupom))
            $this->fk_cupom = new Cupom($this->cupom);
        TTransaction::close();
        // returns the associated object
        return $this->fk_cupom;
    }
    /**
     * Method set_sale_item
     * Sample of usage: $var->sale_item = $object;
     * @param $object Instance of SaleItem
     */
    public function set_fk_sale_item(SaleItem $object)
    {
        $this->fk_sale_item = $object;
        $this->sale_item = $object->id;
    }

    /**
     * Method get_fk_sale_item
     * Sample of usage: $var->fk_sale_item->attribute;
     * @returns SaleItem instance
     */
    public function get_fk_sale_item()
    {
    
        // loads the associated object
        if (empty($this->fk_sale_item))
            $this->fk_sale_item = new SaleItem($this->sale_item);
    
        // returns the associated object
        return $this->fk_sale_item;
    }

    
}

