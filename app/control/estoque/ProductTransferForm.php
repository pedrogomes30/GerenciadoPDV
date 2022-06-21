<?php

class ProductTransferForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'pos_product';
    private static $activeRecord = 'ProductTransfer';
    private static $primaryKey = 'id';
    private static $formName = 'form_ProductTransferForm';

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
        $this->form->setFormTitle("Cadastro de product transfer");


        $id = new TEntry('id');
        $quantity = new TEntry('quantity');
        $transfer_type = new TEntry('transfer_type');
        $protocol = new TEntry('protocol');
        $user = new TEntry('user');
        $deposit_origin = new TDBCombo('deposit_origin', 'pos_product', 'Deposit', 'id', '{name}','name asc'  );
        $product_storage_origin = new TDBCombo('product_storage_origin', 'pos_product', 'ProductStorage', 'id', '{id}','id asc'  );
        $deposit_destiny = new TDBCombo('deposit_destiny', 'pos_product', 'Deposit', 'id', '{name}','name asc'  );
        $product_storage_destiny = new TDBCombo('product_storage_destiny', 'pos_product', 'ProductStorage', 'id', '{id}','id asc'  );
        $product = new TDBCombo('product', 'pos_product', 'Product', 'id', '{description}','description asc'  );

        $quantity->addValidation("Quantity", new TRequiredValidator()); 
        $transfer_type->addValidation("Transfer type", new TRequiredValidator()); 
        $deposit_destiny->addValidation("Deposit destiny", new TRequiredValidator()); 
        $product_storage_destiny->addValidation("Product storage destiny", new TRequiredValidator()); 
        $product->addValidation("Product", new TRequiredValidator()); 

        $id->setEditable(false);
        $transfer_type->setMaxLength(20);
        $transfer_type->setValue('transferencia');
        $product->enableSearch();
        $deposit_origin->enableSearch();
        $deposit_destiny->enableSearch();
        $product_storage_origin->enableSearch();
        $product_storage_destiny->enableSearch();

        $id->setSize(100);
        $user->setSize('100%');
        $product->setSize('100%');
        $quantity->setSize('100%');
        $protocol->setSize('100%');
        $transfer_type->setSize('100%');
        $deposit_origin->setSize('100%');
        $deposit_destiny->setSize('100%');
        $product_storage_origin->setSize('100%');
        $product_storage_destiny->setSize('100%');



        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Quantity:", '#ff0000', '14px', null, '100%'),$quantity]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Transfer type:", '#ff0000', '14px', null, '100%'),$transfer_type],[new TLabel("Protocol:", null, '14px', null, '100%'),$protocol]);
        $row2->layout = ['col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([new TLabel("User:", null, '14px', null, '100%'),$user],[new TLabel("Deposit origin:", null, '14px', null, '100%'),$deposit_origin]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        $row4 = $this->form->addFields([new TLabel("Product storage origin:", null, '14px', null, '100%'),$product_storage_origin],[new TLabel("Deposit destiny:", '#ff0000', '14px', null, '100%'),$deposit_destiny]);
        $row4->layout = ['col-sm-6','col-sm-6'];

        $row5 = $this->form->addFields([new TLabel("Product storage destiny:", '#ff0000', '14px', null, '100%'),$product_storage_destiny],[new TLabel("Product:", '#ff0000', '14px', null, '100%'),$product]);
        $row5->layout = ['col-sm-6','col-sm-6'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['ProductTransferList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Estoque","Cadastro de product transfer"]));
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

            $object = new ProductTransfer(); // create an empty object 

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
            TApplication::loadPage('ProductTransferList', 'onShow', $loadPageParam); 

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

                $object = new ProductTransfer($key); // instantiates the Active Record 

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

