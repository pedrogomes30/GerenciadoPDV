<?php

use eNotasGW\Api\Exceptions as Exceptions;
use eNotasGW\Api\fileParameter as fileParameter;

class eNotasApi
{
    const ENOTAS_KEY            = 'NWZiZGM0YWUtMDdmYi00NTEzLThjYjMtNTMwMjAxYmYwNjAw';
    const INVOICE_AMBIENT       = false;//true = production // false = homologation
    
    
    /*ATTENTION, INSTALL ENOTAS COMPONSER COMPLEMENT!!!!!!!!!!!*/
    
    //RETURN INVOICE AMBIENT
    public static function invoiceAmbient(){
        return static::INVOICE_AMBIENT;
    }
    
    //SEND NFCE
    public static function sendNfce($store_enotas_id, $invoiceRequest)
    {
        require_once '/var/www/html/vendor/enotas/php-client-v2/src/eNotasGW.php';
        eNotasGW::configure(array(
        	'apiKey' => static::API_KEY_ENOTAS,
            ));
        $return = eNotasGW::$NFeConsumidorApi->emitir($store_enotas_id,$invoiceRequest);
        return $return;
    }   
    
    //NFCE DEFAULT CONFIGS
    public static function getNfceConfig(){
        $settings                             = array();
        $settings['ambiente_emissao']         = static::INVOICE_AMBIENT?'Producao':'Homologacao';;
        $settings['presenca_consumidor']      = 'OperacaoPresencial';
        $settings['informacoes_adicionais']   = 'Documento emitido por ME ou EPP optante pelo Simples Nacional.';
        return $settings;
    }
    
    //save Store
    public static function saveStore($loja){
        require '/var/www/html/vendor/enotas/php-client-v2/src/eNotasGW.php';
        $result = eNotasGW::$EmpresaApi->inserirAtualizar($loja);
        return $result;
    }
    
    //UPDATE CERTIFICADE
    function updateCertificated($id_loja_enotas, $file, $password){
        require '/var/www/html/vendor/enotas/php-client-v2/src/eNotasGW.php';
        $result = eNotasGW::$EmpresaApi->atualizarCertificado($object->idEmpresa, $arquivoPfxOuP12, $senhaDoArquivo);
        return $result;
    }
}
