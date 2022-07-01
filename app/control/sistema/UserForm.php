<?php

class UserForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'pos_system';
    private static $activeRecord = 'User';
    private static $primaryKey = 'id';
    private static $formName = 'form_UserForm';

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
        $this->form->setFormTitle("Cadastro de user");


        $id = new TEntry('id');
        $obs = new TEntry('obs');
        $profile_img = new TEntry('profile_img');
        $origin_store = new TDBCombo('origin_store', 'pos_system', 'Store', 'id', '{social_name}','social_name asc'  );
        $current_store = new TDBCombo('current_store', 'pos_system', 'Store', 'id', '{social_name}','social_name asc'  );
        $profession = new TDBCombo('profession', 'pos_system', 'Profession', 'id', '{id}','id asc'  );
        $system_user = new TDBCombo('system_user', 'permission', 'SystemUsers', 'id', '{name}','name asc'  );

        $current_store->addValidation("Current store", new TRequiredValidator()); 
        $profession->addValidation("Profession", new TRequiredValidator()); 
        $system_user->addValidation("System user", new TRequiredValidator()); 

        $id->setEditable(false);
        $origin_store->setValue('1');
        $obs->setMaxLength(200);
        $profile_img->setMaxLength(255);

        $profession->enableSearch();
        $system_user->enableSearch();
        $origin_store->enableSearch();
        $current_store->enableSearch();

        $id->setSize(100);
        $obs->setSize('100%');
        $profession->setSize('100%');
        $profile_img->setSize('100%');
        $system_user->setSize('100%');
        $origin_store->setSize('100%');
        $current_store->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Observação:", null, '14px', null, '100%'),$obs]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("url imagem perfil:", null, '14px', null, '100%'),$profile_img],[new TLabel("Origin store:", null, '14px', null, '100%'),$origin_store]);
        $row2->layout = ['col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([new TLabel("Current store:", '#ff0000', '14px', null, '100%'),$current_store],[new TLabel("Profession:", '#ff0000', '14px', null, '100%'),$profession]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        $row4 = $this->form->addFields([new TLabel("System user:", '#ff0000', '14px', null, '100%'),$system_user],[]);
        $row4->layout = ['col-sm-6','col-sm-6'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['UserList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Sistema","Cadastro de user"]));
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

            $object = new User(); // create an empty object 

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
            TApplication::loadPage('UserList', 'onShow', $loadPageParam); 

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

                $object = new User($key); // instantiates the Active Record 

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

