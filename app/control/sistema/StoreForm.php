<?php

class StoreForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'pos_system';
    private static $activeRecord = 'Store';
    private static $primaryKey = 'id';
    private static $formName = 'form_StoreForm';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Cadastro de store");


        $id = new TEntry('id');
        $social_name = new TEntry('social_name');
        $abbreviation = new TEntry('abbreviation');
        $cnpj = new TEntry('cnpj');
        $icon_url = new TEntry('icon_url');
        $fantasy_name = new TEntry('fantasy_name');
        $obs = new TEntry('obs');
        $state_inscription = new TEntry('state_inscription');
        $municipal_inscription = new TEntry('municipal_inscription');
        $icms = new TEntry('icms');
        $tax_regime = new TEntry('tax_regime');
        $invoice_type = new TEntry('invoice_type');
        $invoice_provider_id = new TEntry('invoice_provider_id');
        $production_csc_number = new TEntry('production_csc_number');
        $production_csc_id = new TEntry('production_csc_id');
        $production_invoice_serie = new TEntry('production_invoice_serie');
        $production_invoice_sequence = new TEntry('production_invoice_sequence');
        $homologation_csc_number = new TEntry('homologation_csc_number');
        $homologation_csc_id = new TEntry('homologation_csc_id');
        $homologation_invoice_serie = new TEntry('homologation_invoice_serie');
        $homologation_invoice_sequence = new TEntry('homologation_invoice_sequence');
        $certificate_password = new TEntry('certificate_password');
        $store_group = new TDBCombo('store_group', 'pos_system', 'StoreGroup', 'id', '{name}','name asc'  );

        $social_name->addValidation("Social name", new TRequiredValidator()); 
        $abbreviation->addValidation("Abbreviation", new TRequiredValidator()); 
        $cnpj->addValidation("Cnpj", new TRequiredValidator()); 
        $invoice_type->addValidation("Invoice type", new TRequiredValidator()); 
        $store_group->addValidation("Store group", new TRequiredValidator()); 

        $id->setEditable(false);
        $invoice_type->setValue('1');
        $store_group->enableSearch();
        $cnpj->setMaxLength(20);
        $obs->setMaxLength(200);
        $icms->setMaxLength(30);
        $icon_url->setMaxLength(255);
        $tax_regime->setMaxLength(5);
        $social_name->setMaxLength(50);
        $abbreviation->setMaxLength(5);
        $fantasy_name->setMaxLength(100);
        $state_inscription->setMaxLength(30);
        $production_csc_id->setMaxLength(50);
        $invoice_provider_id->setMaxLength(50);
        $homologation_csc_id->setMaxLength(50);
        $certificate_password->setMaxLength(50);
        $municipal_inscription->setMaxLength(30);
        $production_csc_number->setMaxLength(50);
        $homologation_csc_number->setMaxLength(50);

        $id->setSize(100);
        $obs->setSize('100%');
        $icms->setSize('100%');
        $cnpj->setSize('100%');
        $icon_url->setSize('100%');
        $tax_regime->setSize('100%');
        $social_name->setSize('100%');
        $store_group->setSize('100%');
        $fantasy_name->setSize('100%');
        $abbreviation->setSize('100%');
        $invoice_type->setSize('100%');
        $state_inscription->setSize('100%');
        $production_csc_id->setSize('100%');
        $invoice_provider_id->setSize('100%');
        $homologation_csc_id->setSize('100%');
        $certificate_password->setSize('100%');
        $municipal_inscription->setSize('100%');
        $production_csc_number->setSize('100%');
        $homologation_csc_number->setSize('100%');
        $production_invoice_serie->setSize('100%');
        $homologation_invoice_serie->setSize('100%');
        $production_invoice_sequence->setSize('100%');
        $homologation_invoice_sequence->setSize('100%');




        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Social name:", '#ff0000', '14px', null, '100%'),$social_name]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Abbreviation:", '#ff0000', '14px', null, '100%'),$abbreviation],[new TLabel("Cnpj:", '#ff0000', '14px', null, '100%'),$cnpj]);
        $row2->layout = ['col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([new TLabel("Icon url:", null, '14px', null, '100%'),$icon_url],[new TLabel("Fantasy name:", null, '14px', null, '100%'),$fantasy_name]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        $row4 = $this->form->addFields([new TLabel("Obs:", null, '14px', null, '100%'),$obs],[new TLabel("State inscription:", null, '14px', null, '100%'),$state_inscription]);
        $row4->layout = ['col-sm-6','col-sm-6'];

        $row5 = $this->form->addFields([new TLabel("Minicipal inscription:", null, '14px', null, '100%'),$municipal_inscription],[new TLabel("Icms:", null, '14px', null, '100%'),$icms]);
        $row5->layout = ['col-sm-6','col-sm-6'];

        $row6 = $this->form->addFields([new TLabel("Tax regime:", null, '14px', null, '100%'),$tax_regime],[new TLabel("Invoice type:", '#ff0000', '14px', null, '100%'),$invoice_type]);
        $row6->layout = ['col-sm-6','col-sm-6'];

        $row7 = $this->form->addFields([new TLabel("Invoice provider id:", null, '14px', null, '100%'),$invoice_provider_id],[new TLabel("Production csc number:", null, '14px', null, '100%'),$production_csc_number]);
        $row7->layout = ['col-sm-6','col-sm-6'];

        $row8 = $this->form->addFields([new TLabel("Production csc id:", null, '14px', null, '100%'),$production_csc_id],[new TLabel("Production invoice serie:", null, '14px', null, '100%'),$production_invoice_serie]);
        $row8->layout = ['col-sm-6','col-sm-6'];

        $row9 = $this->form->addFields([new TLabel("Production invoice sequence:", null, '14px', null, '100%'),$production_invoice_sequence],[new TLabel("Homologation csc number:", null, '14px', null, '100%'),$homologation_csc_number]);
        $row9->layout = ['col-sm-6','col-sm-6'];

        $row10 = $this->form->addFields([new TLabel("Homologation csc id:", null, '14px', null, '100%'),$homologation_csc_id],[new TLabel("Homologation invoice serie:", null, '14px', null, '100%'),$homologation_invoice_serie]);
        $row10->layout = ['col-sm-6','col-sm-6'];

        $row11 = $this->form->addFields([new TLabel("Homologation invoice sequence:", null, '14px', null, '100%'),$homologation_invoice_sequence],[new TLabel("Certificate password:", null, '14px', null, '100%'),$certificate_password]);
        $row11->layout = ['col-sm-6','col-sm-6'];

        $row12 = $this->form->addFields([new TLabel("Store group:", '#ff0000', '14px', null, '100%'),$store_group],[]);
        $row12->layout = ['col-sm-6','col-sm-6'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['StoreList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Sistema","Cadastro de Lojas"]));
        }
        $container->add($this->form);

        parent::add($container);

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new Store(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('StoreList', 'onShow', $loadPageParam); 

        }
        catch (Exception $e) // in case of exception
        {
            //</catchAutoCode> 

            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open(self::$database); // open a transaction

                $object = new Store($key); // instantiates the Active Record 

                $this->form->setData($object); // fill the form 

                TTransaction::close(); // close the transaction 
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(true);

    }

    public function onShow($param = null)
    {

    } 

}

