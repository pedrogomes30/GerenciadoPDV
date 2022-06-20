<?php

class SaleForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'pos_sales';
    private static $activeRecord = 'Sale';
    private static $primaryKey = 'id';
    private static $formName = 'form_SaleForm';

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
        $this->form->setFormTitle("Cadastro de Venda");


        $id = new TEntry('id');
        $number = new TEntry('number');
        $products_value = new TNumeric('products_value', '2', ',', '.' );
        $payments_value = new TNumeric('payments_value', '2', ',', '.' );
        $total_value = new TNumeric('total_value', '2', ',', '.' );
        $sale_date = new TDateTime('sale_date');
        $invoiced = new TRadioGroup('invoiced');
        $invoice_ambient = new TRadioGroup('invoice_ambient');
        $discont_value = new TNumeric('discont_value', '2', ',', '.' );
        $obs = new TEntry('obs');
        $invoice_number = new TEntry('invoice_number');
        $invoice_serie = new TEntry('invoice_serie');
        $invoice_coupon = new TEntry('invoice_coupon');
        $invoice_xml = new TEntry('invoice_xml');
        $payment_method = new TDBCombo('payment_method', 'pos_system', 'PaymentMethod', 'id', '{id}','id asc'  );
        $store = new TDBCombo('store', 'pos_system', 'Store', 'id', '{social_name}','social_name asc'  );
        $employee_cashier = new TDBCombo('employee_cashier', 'pos_system', 'User', 'id', '{id}','id asc'  );
        $cashier = new TDBCombo('cashier', 'pos_system', 'Cashier', 'id', '{id}','id asc'  );
        $client = new TDBCombo('client', 'pos_system', 'User', 'id', '{id}','id asc'  );
        $salesman = new TDBCombo('salesman', 'pos_system', 'User', 'id', '{id}','id asc'  );
        $status = new TDBCombo('status', 'pos_sales', 'Status', 'id', '{id}','id asc'  );

        $number->addValidation("Number", new TRequiredValidator()); 
        $products_value->addValidation("Products value", new TRequiredValidator()); 
        $payments_value->addValidation("Payments value", new TRequiredValidator()); 
        $total_value->addValidation("Valor total", new TRequiredValidator()); 
        $sale_date->addValidation("Sale date", new TRequiredValidator()); 
        $invoiced->addValidation("Invoiced", new TRequiredValidator()); 
        $invoice_ambient->addValidation("Invoice ambient", new TRequiredValidator()); 
        $payment_method->addValidation("Payment method", new TRequiredValidator()); 
        $store->addValidation("Store", new TRequiredValidator()); 
        $employee_cashier->addValidation("Employee cashier", new TRequiredValidator()); 
        $cashier->addValidation("Cashier", new TRequiredValidator()); 
        $status->addValidation("Status", new TRequiredValidator()); 

        $id->setEditable(false);
        $sale_date->setMask('dd/mm/yyyy hh:ii');
        $sale_date->setDatabaseMask('yyyy-mm-dd hh:ii');
        $invoiced->addItems(["1"=>"Sim","2"=>"Não"]);
        $invoice_ambient->addItems(["1"=>"Sim","2"=>"Não"]);

        $invoiced->setLayout('vertical');
        $invoice_ambient->setLayout('vertical');

        $invoiced->setBooleanMode();
        $invoice_ambient->setBooleanMode();

        $obs->setMaxLength(400);
        $number->setMaxLength(30);
        $invoice_coupon->setMaxLength(500);

        $status->setValue('2');
        $invoiced->setValue('false');
        $invoice_ambient->setValue('false');

        $store->enableSearch();
        $client->enableSearch();
        $status->enableSearch();
        $cashier->enableSearch();
        $salesman->enableSearch();
        $payment_method->enableSearch();
        $employee_cashier->enableSearch();

        $id->setSize(100);
        $obs->setSize('100%');
        $invoiced->setSize(80);
        $store->setSize('100%');
        $client->setSize('100%');
        $number->setSize('100%');
        $status->setSize('100%');
        $sale_date->setSize(150);
        $cashier->setSize('100%');
        $salesman->setSize('100%');
        $invoice_ambient->setSize(80);
        $total_value->setSize('100%');
        $invoice_xml->setSize('100%');
        $discont_value->setSize('100%');
        $invoice_serie->setSize('100%');
        $invoice_coupon->setSize('100%');
        $payment_method->setSize('100%');
        $payments_value->setSize('100%');
        $products_value->setSize('100%');
        $invoice_number->setSize('100%');
        $employee_cashier->setSize('100%');




        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Number:", '#ff0000', '14px', null, '100%'),$number]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Products value:", '#ff0000', '14px', null, '100%'),$products_value],[new TLabel("Payments value:", '#ff0000', '14px', null, '100%'),$payments_value]);
        $row2->layout = ['col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([new TLabel("Valor total:", '#ff0000', '14px', null, '100%'),$total_value],[new TLabel("Sale date:", '#ff0000', '14px', null, '100%'),$sale_date]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        $row4 = $this->form->addFields([new TLabel("Invoiced:", '#ff0000', '14px', null, '100%'),$invoiced],[new TLabel("Invoice ambient:", '#ff0000', '14px', null, '100%'),$invoice_ambient]);
        $row4->layout = ['col-sm-6','col-sm-6'];

        $row5 = $this->form->addFields([new TLabel("Discont value:", null, '14px', null, '100%'),$discont_value],[new TLabel("Observação:", null, '14px', null, '100%'),$obs]);
        $row5->layout = ['col-sm-6','col-sm-6'];

        $row6 = $this->form->addFields([new TLabel("Invoice number:", null, '14px', null, '100%'),$invoice_number],[new TLabel("Invoice serie:", null, '14px', null, '100%'),$invoice_serie]);
        $row6->layout = ['col-sm-6','col-sm-6'];

        $row7 = $this->form->addFields([new TLabel("Invoice coupon:", null, '14px', null, '100%'),$invoice_coupon],[new TLabel("Invoice xml:", null, '14px', null, '100%'),$invoice_xml]);
        $row7->layout = ['col-sm-6','col-sm-6'];

        $row8 = $this->form->addFields([new TLabel("Payment method:", '#ff0000', '14px', null, '100%'),$payment_method],[new TLabel("Store:", '#ff0000', '14px', null, '100%'),$store]);
        $row8->layout = ['col-sm-6','col-sm-6'];

        $row9 = $this->form->addFields([new TLabel("Employee cashier:", '#ff0000', '14px', null, '100%'),$employee_cashier],[new TLabel("Cashier:", '#ff0000', '14px', null, '100%'),$cashier]);
        $row9->layout = ['col-sm-6','col-sm-6'];

        $row10 = $this->form->addFields([new TLabel("Cliente:", null, '14px', null, '100%'),$client],[new TLabel("Salesman:", null, '14px', null, '100%'),$salesman]);
        $row10->layout = ['col-sm-6','col-sm-6'];

        $row11 = $this->form->addFields([new TLabel("Status:", '#ff0000', '14px', null, '100%'),$status],[]);
        $row11->layout = ['col-sm-6','col-sm-6'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['SaleList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Vendas","Cadastro de Venda"]));
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

            $object = new Sale(); // create an empty object 

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
            TApplication::loadPage('SaleList', 'onShow', $loadPageParam); 

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

                $object = new Sale($key); // instantiates the Active Record 

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

