<?php

class Ncm extends TRecord
{
    const TABLENAME  = 'ncm';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('description');
        parent::addAttribute('number');
            
    }

    /**
     * Method getCestNcms
     */
    public function getCestNcms()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('ncm', '=', $this->id));
        return CestNcm::getObjects( $criteria );
    }

    public function set_cest_ncm_fk_cest_to_string($cest_ncm_fk_cest_to_string)
    {
        if(is_array($cest_ncm_fk_cest_to_string))
        {
            $values = Cest::where('id', 'in', $cest_ncm_fk_cest_to_string)->getIndexedArray('id', 'id');
            $this->cest_ncm_fk_cest_to_string = implode(', ', $values);
        }
        else
        {
            $this->cest_ncm_fk_cest_to_string = $cest_ncm_fk_cest_to_string;
        }

        $this->vdata['cest_ncm_fk_cest_to_string'] = $this->cest_ncm_fk_cest_to_string;
    }

    public function get_cest_ncm_fk_cest_to_string()
    {
        if(!empty($this->cest_ncm_fk_cest_to_string))
        {
            return $this->cest_ncm_fk_cest_to_string;
        }
    
        $values = CestNcm::where('ncm', '=', $this->id)->getIndexedArray('cest','{fk_cest->id}');
        return implode(', ', $values);
    }

    public function set_cest_ncm_fk_ncm_to_string($cest_ncm_fk_ncm_to_string)
    {
        if(is_array($cest_ncm_fk_ncm_to_string))
        {
            $values = Ncm::where('id', 'in', $cest_ncm_fk_ncm_to_string)->getIndexedArray('id', 'id');
            $this->cest_ncm_fk_ncm_to_string = implode(', ', $values);
        }
        else
        {
            $this->cest_ncm_fk_ncm_to_string = $cest_ncm_fk_ncm_to_string;
        }

        $this->vdata['cest_ncm_fk_ncm_to_string'] = $this->cest_ncm_fk_ncm_to_string;
    }

    public function get_cest_ncm_fk_ncm_to_string()
    {
        if(!empty($this->cest_ncm_fk_ncm_to_string))
        {
            return $this->cest_ncm_fk_ncm_to_string;
        }
    
        $values = CestNcm::where('ncm', '=', $this->id)->getIndexedArray('ncm','{fk_ncm->id}');
        return implode(', ', $values);
    }

    
}

