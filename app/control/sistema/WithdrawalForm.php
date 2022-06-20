<?php

class WithdrawalForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'pos_withdrawal_closure';
    private static $activeRecord = 'Withdrawal';
    private static $primaryKey = 'id';
    private static $formName = 'form_WithdrawalForm';

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
        $this->form->setFormTitle("Realizar Sangria de Caixa");


        $id = new TEntry('id');
        $user = new TDBCombo('user', 'pos_system', 'User', 'id', '{id}','id asc'  );
        $store = new TDBCombo('store', 'pos_system', 'Store', 'id', '{social_name}','social_name asc'  );
        $cashier = new TDBCombo('cashier', 'pos_system', 'Cashier', 'id', '{id}','id asc'  );
        $closure = new TDBCombo('closure', 'pos_withdrawal_closure', 'Closure', 'id', '{id}','id asc'  );
        $withdrawal_account = new TDBCombo('withdrawal_account', 'pos_withdrawal_closure', 'WithdrawalAccount', 'id', '{id}','id asc'  );
        $dt_withdrawal = new TDate('dt_withdrawal');
        $value = new TNumeric('value', '2', ',', '.' );
        $obs = new TEntry('obs');

        $user->addValidation("User", new TRequiredValidator()); 
        $store->addValidation("Store", new TRequiredValidator()); 
        $cashier->addValidation("Cashier", new TRequiredValidator()); 
        $closure->addValidation("Closure", new TRequiredValidator()); 
        $withdrawal_account->addValidation("Withdrawal account", new TRequiredValidator()); 
        $value->addValidation("Value", new TRequiredValidator()); 

        $id->setEditable(false);
        $dt_withdrawal->setMask('dd/mm/yyyy');
        $dt_withdrawal->setDatabaseMask('yyyy-mm-dd');
        $obs->setMaxLength(200);
        $user->enableSearch();
        $store->enableSearch();
        $cashier->enableSearch();
        $closure->enableSearch();
        $withdrawal_account->enableSearch();

        $id->setSize(100);
        $obs->setSize('100%');
        $user->setSize('100%');
        $store->setSize('100%');
        $value->setSize('100%');
        $cashier->setSize('100%');
        $closure->setSize('100%');
        $dt_withdrawal->setSize(110);
        $withdrawal_account->setSize('100%');


        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("User:", '#ff0000', '14px', null, '100%'),$user]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Store:", '#ff0000', '14px', null, '100%'),$store],[new TLabel("Cashier:", '#ff0000', '14px', null, '100%'),$cashier]);
        $row2->layout = ['col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([new TLabel("Closure:", '#ff0000', '14px', null, '100%'),$closure],[new TLabel("Withdrawal account:", '#ff0000', '14px', null, '100%'),$withdrawal_account]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        $row4 = $this->form->addFields([new TLabel("Dt withdrawal:", null, '14px', null, '100%'),$dt_withdrawal],[new TLabel("Value:", '#ff0000', '14px', null, '100%'),$value]);
        $row4->layout = ['col-sm-6','col-sm-6'];

        $row5 = $this->form->addFields([new TLabel("Obs:", null, '14px', null, '100%'),$obs],[]);
        $row5->layout = ['col-sm-6','col-sm-6'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['WithdrawalList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Sistema","Realizar Sangria de Caixa"]));
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

            $object = new Withdrawal(); // create an empty object 

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
            TApplication::loadPage('WithdrawalList', 'onShow', $loadPageParam); 

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

                $object = new Withdrawal($key); // instantiates the Active Record 

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

