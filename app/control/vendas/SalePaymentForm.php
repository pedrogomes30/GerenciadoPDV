<?php

class SalePaymentForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'pos_sales';
    private static $activeRecord = 'SalePayment';
    private static $primaryKey = 'id';
    private static $formName = 'form_SalePaymentForm';

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
        $this->form->setFormTitle("Cadastro de pagamentos");


        $id = new TEntry('id');
        $value = new TNumeric('value', '2', ',', '.' );
        $sale_date = new TDate('sale_date');
        $store = new TEntry('store');
        $sale = new TDBCombo('sale', 'pos_sales', 'Sale', 'id', '{id}','id asc'  );
        $payment_method = new TDBCombo('payment_method', 'pos_system', 'PaymentMethod', 'id', '{id}','id asc'  );

        $value->addValidation("Value", new TRequiredValidator()); 
        $sale_date->addValidation("Sale date", new TRequiredValidator()); 
        $store->addValidation("Store", new TRequiredValidator()); 
        $sale->addValidation("Sale", new TRequiredValidator()); 
        $payment_method->addValidation("Payment method", new TRequiredValidator()); 

        $id->setEditable(false);
        $sale_date->setMask('dd/mm/yyyy');
        $sale_date->setDatabaseMask('yyyy-mm-dd');
        $sale->enableSearch();
        $payment_method->enableSearch();

        $id->setSize(100);
        $sale->setSize('100%');
        $value->setSize('100%');
        $store->setSize('100%');
        $sale_date->setSize(110);
        $payment_method->setSize('100%');



        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Value:", '#ff0000', '14px', null, '100%'),$value]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Sale date:", '#ff0000', '14px', null, '100%'),$sale_date],[new TLabel("Store:", '#ff0000', '14px', null, '100%'),$store]);
        $row2->layout = ['col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([new TLabel("Sale:", '#ff0000', '14px', null, '100%'),$sale],[new TLabel("Payment method:", '#ff0000', '14px', null, '100%'),$payment_method]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['SalePaymentList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Vendas","Cadastro de pagamentos"]));
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

            $object = new SalePayment(); // create an empty object 

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
            TApplication::loadPage('SalePaymentList', 'onShow', $loadPageParam); 

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

                $object = new SalePayment($key); // instantiates the Active Record 

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

