<?php

class StatusProduto extends TRecord
{
    const TABLENAME  = 'status_produto';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const ATIVO = '1';
    const INATIVO = '2';
    const ERRO = '3';

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('status');
            
    }

    
}

