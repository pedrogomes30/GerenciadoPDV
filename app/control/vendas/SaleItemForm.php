<?php

class SaleItemForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'pos_sales';
    private static $activeRecord = 'SaleItem';
    private static $primaryKey = 'id';
    private static $formName = 'form_SaleItemForm';

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
        $this->form->setFormTitle("Cadastro de itens vendidos");


        $id = new TEntry('id');
        $discont_value = new TNumeric('discont_value', '2', ',', '.' );
        $quantity = new TEntry('quantity');
        $unitary_value = new TNumeric('unitary_value', '2', ',', '.' );
        $total_value = new TNumeric('total_value', '2', ',', '.' );
        $sale_date = new TDate('sale_date');
        $sale = new TDBCombo('sale', 'pos_sales', 'Sale', 'id', '{id}','id asc'  );
        $store = new TDBCombo('store', 'pos_system', 'Store', 'id', '{social_name}','social_name asc'  );
        $deposit = new TDBCombo('deposit', 'pos_product', 'Deposit', 'id', '{name}','name asc'  );
        $product_storage = new TDBCombo('product_storage', 'pos_product', 'ProductStorage', 'id', '{id}','id asc'  );
        $product = new TDBCombo('product', 'pos_product', 'Product', 'id', '{description}','description asc'  );

        $quantity->addValidation("Quantidade", new TRequiredValidator()); 
        $unitary_value->addValidation("Valor", new TRequiredValidator()); 
        $total_value->addValidation("Total value", new TRequiredValidator()); 
        $sale_date->addValidation("Sale date", new TRequiredValidator()); 
        $sale->addValidation("Código da venda", new TRequiredValidator()); 
        $store->addValidation("Store", new TRequiredValidator()); 
        $deposit->addValidation("Deposit", new TRequiredValidator()); 
        $product_storage->addValidation("Product storage", new TRequiredValidator()); 
        $product->addValidation("Produto", new TRequiredValidator()); 

        $id->setEditable(false);
        $sale_date->setMask('dd/mm/yyyy');
        $sale_date->setDatabaseMask('yyyy-mm-dd');
        $sale->enableSearch();
        $store->enableSearch();
        $deposit->enableSearch();
        $product->enableSearch();
        $product_storage->enableSearch();

        $id->setSize(100);
        $sale->setSize('100%');
        $store->setSize('100%');
        $sale_date->setSize(110);
        $deposit->setSize('100%');
        $product->setSize('100%');
        $quantity->setSize('100%');
        $total_value->setSize('100%');
        $discont_value->setSize('100%');
        $unitary_value->setSize('100%');
        $product_storage->setSize('100%');


        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Desconto:", null, '14px', null, '100%'),$discont_value]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Quantidade:", '#ff0000', '14px', null, '100%'),$quantity],[new TLabel("Valor:", '#ff0000', '14px', null, '100%'),$unitary_value]);
        $row2->layout = ['col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([new TLabel("Total value:", '#ff0000', '14px', null, '100%'),$total_value],[new TLabel("Sale date:", '#ff0000', '14px', null, '100%'),$sale_date]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        $row4 = $this->form->addFields([new TLabel("Código da venda:", '#ff0000', '14px', null, '100%'),$sale],[new TLabel("Store:", '#ff0000', '14px', null, '100%'),$store]);
        $row4->layout = ['col-sm-6','col-sm-6'];

        $row5 = $this->form->addFields([new TLabel("Deposit:", '#ff0000', '14px', null, '100%'),$deposit],[new TLabel("Product storage:", '#ff0000', '14px', null, '100%'),$product_storage]);
        $row5->layout = ['col-sm-6','col-sm-6'];

        $row6 = $this->form->addFields([new TLabel("Produto:", '#ff0000', '14px', null, '100%'),$product],[]);
        $row6->layout = ['col-sm-6','col-sm-6'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['SaleItemList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Vendas","Cadastro de itens vendidos"]));
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

            $object = new SaleItem(); // create an empty object 

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
            TApplication::loadPage('SaleItemList', 'onShow', $loadPageParam); 

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

                $object = new SaleItem($key); // instantiates the Active Record 

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

