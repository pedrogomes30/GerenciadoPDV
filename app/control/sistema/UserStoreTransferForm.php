<?php

class UserStoreTransferForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'pos_system';
    private static $activeRecord = 'UserStoreTransfer';
    private static $primaryKey = 'id';
    private static $formName = 'form_UserStoreTransferForm';

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
        $this->form->setFormTitle("Realizar Transferência de usuário");


        $id = new TEntry('id');
        $dt_transfer = new TDate('dt_transfer');
        $reason = new TEntry('reason');
        $user = new TDBCombo('user', 'pos_system', 'User', 'id', '{id}','id asc'  );
        $store_origin = new TDBCombo('store_origin', 'pos_system', 'Store', 'id', '{social_name}','social_name asc'  );
        $store_destiny = new TDBCombo('store_destiny', 'pos_system', 'Store', 'id', '{social_name}','social_name asc'  );

        $dt_transfer->addValidation("Dt transfer", new TRequiredValidator()); 
        $user->addValidation("User", new TRequiredValidator()); 
        $store_origin->addValidation("Store origin", new TRequiredValidator()); 
        $store_destiny->addValidation("Store destiny", new TRequiredValidator()); 

        $id->setEditable(false);
        $dt_transfer->setMask('dd/mm/yyyy');
        $dt_transfer->setDatabaseMask('yyyy-mm-dd');
        $reason->setMaxLength(100);
        $user->enableSearch();
        $store_origin->enableSearch();
        $store_destiny->enableSearch();

        $id->setSize(100);
        $user->setSize('100%');
        $reason->setSize('100%');
        $dt_transfer->setSize(110);
        $store_origin->setSize('100%');
        $store_destiny->setSize('100%');



        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Dt transfer:", '#ff0000', '14px', null, '100%'),$dt_transfer]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Reason:", null, '14px', null, '100%'),$reason],[new TLabel("User:", '#ff0000', '14px', null, '100%'),$user]);
        $row2->layout = ['col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([new TLabel("Store origin:", '#ff0000', '14px', null, '100%'),$store_origin],[new TLabel("Store destiny:", '#ff0000', '14px', null, '100%'),$store_destiny]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['UserStoreTransferList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Sistema","Realizar Transferência de usuário"]));
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

            $object = new UserStoreTransfer(); // create an empty object 

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
            TApplication::loadPage('UserStoreTransferList', 'onShow', $loadPageParam); 

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

                $object = new UserStoreTransfer($key); // instantiates the Active Record 

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

