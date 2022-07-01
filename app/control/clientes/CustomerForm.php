<?php

class CustomerForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'pos_customers';
    private static $activeRecord = 'Customer';
    private static $primaryKey = 'id';
    private static $formName = 'form_CustomerForm';

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
        $this->form->setFormTitle("Cadastro de Cliente");


        $id = new TEntry('id');
        $name = new TEntry('name');
        $document = new TEntry('document');
        $document_type = new TRadioGroup('document_type');
        $email = new TEntry('email');
        $phone_1 = new TEntry('phone_1');
        $phone_2 = new TEntry('phone_2');
        $phone_3 = new TEntry('phone_3');
        $system_user = new TDBCombo('system_user', 'pos_system', 'User', 'id', '{id}','id asc'  );
        $store_partiner = new TDBCombo('store_partiner', 'pos_customers', 'StorePartiner', 'id', '{name}','name asc'  );

        $name->addValidation("Name", new TRequiredValidator()); 
        $document->addValidation("Document", new TRequiredValidator()); 
        $document_type->addValidation("Document type", new TRequiredValidator()); 
        $email->addValidation("Email", new TRequiredValidator()); 

        $id->setEditable(false);
        $document_type->addItems(["1"=>"Sim","2"=>"Não"]);
        $document_type->setLayout('vertical');
        $document_type->setValue('cpf/cnpj');
        $document_type->setBooleanMode();
        $system_user->enableSearch();
        $store_partiner->enableSearch();

        $name->setMaxLength(100);
        $email->setMaxLength(100);
        $phone_1->setMaxLength(20);
        $phone_2->setMaxLength(30);
        $phone_3->setMaxLength(30);
        $document->setMaxLength(30);

        $id->setSize(100);
        $name->setSize('100%');
        $email->setSize('100%');
        $phone_1->setSize('100%');
        $phone_2->setSize('100%');
        $phone_3->setSize('100%');
        $document->setSize('100%');
        $document_type->setSize(80);
        $system_user->setSize('100%');
        $store_partiner->setSize('100%');



        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Name:", '#ff0000', '14px', null, '100%'),$name]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Document:", '#ff0000', '14px', null, '100%'),$document],[new TLabel("Document type:", '#ff0000', '14px', null, '100%'),$document_type]);
        $row2->layout = ['col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([new TLabel("Email:", '#ff0000', '14px', null, '100%'),$email],[new TLabel("Phone 1:", null, '14px', null, '100%'),$phone_1]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        $row4 = $this->form->addFields([new TLabel("Phone 2:", null, '14px', null, '100%'),$phone_2],[new TLabel("Phone 3:", null, '14px', null, '100%'),$phone_3]);
        $row4->layout = ['col-sm-6','col-sm-6'];

        $row5 = $this->form->addFields([new TLabel("System user:", null, '14px', null, '100%'),$system_user],[new TLabel("Store partiner:", null, '14px', null, '100%'),$store_partiner]);
        $row5->layout = ['col-sm-6','col-sm-6'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['CustomerList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Clientes","Cadastro de Cliente"]));
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

            $object = new Customer(); // create an empty object 

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
            TApplication::loadPage('CustomerList', 'onShow', $loadPageParam); 

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

                $object = new Customer($key); // instantiates the Active Record 

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

