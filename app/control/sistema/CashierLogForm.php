<?php

class CashierLogForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'pos_system';
    private static $activeRecord = 'CashierLog';
    private static $primaryKey = 'id';
    private static $formName = 'form_CashierLogForm';

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
        $this->form->setFormTitle("Cadastro Registro do Caixa");


        $id = new TEntry('id');
        $dt_login = new TDateTime('dt_login');
        $dt_logout = new TDateTime('dt_logout');
        $user = new TDBCombo('user', 'pos_system', 'User', 'id', '{id}','id asc'  );
        $cashier_id = new TDBCombo('cashier_id', 'pos_system', 'Cashier', 'id', '{id}','id asc'  );

        $dt_login->addValidation("Dt login", new TRequiredValidator()); 
        $dt_logout->addValidation("Dt logout", new TRequiredValidator()); 
        $user->addValidation("User", new TRequiredValidator()); 
        $cashier_id->addValidation("Cashier id", new TRequiredValidator()); 

        $id->setEditable(false);
        $dt_login->setMask('dd/mm/yyyy hh:ii');
        $dt_logout->setMask('dd/mm/yyyy hh:ii');

        $dt_login->setDatabaseMask('yyyy-mm-dd hh:ii');
        $dt_logout->setDatabaseMask('yyyy-mm-dd hh:ii');

        $user->enableSearch();
        $cashier_id->enableSearch();

        $id->setSize(100);
        $user->setSize('100%');
        $dt_login->setSize(150);
        $dt_logout->setSize(150);
        $cashier_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Dt login:", '#ff0000', '14px', null, '100%'),$dt_login]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Dt logout:", '#ff0000', '14px', null, '100%'),$dt_logout],[new TLabel("User:", '#ff0000', '14px', null, '100%'),$user]);
        $row2->layout = ['col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([new TLabel("Cashier id:", '#ff0000', '14px', null, '100%'),$cashier_id],[]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['CashierLogList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Sistema","Cadastro Registro do Caixa"]));
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

            $object = new CashierLog(); // create an empty object 

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
            TApplication::loadPage('CashierLogList', 'onShow', $loadPageParam); 

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

                $object = new CashierLog($key); // instantiates the Active Record 

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

