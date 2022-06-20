<?php

class ProductForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'pos_product';
    private static $activeRecord = 'Product';
    private static $primaryKey = 'id';
    private static $formName = 'form_ProductForm';

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
        $this->form->setFormTitle("Cadastro de product");


        $id = new TEntry('id');
        $description = new TEntry('description');
        $sku = new TEntry('sku');
        $unity = new TEntry('unity');
        $type = new TEntry('type');
        $status = new TEntry('status');
        $description_variation = new TEntry('description_variation');
        $reference = new TEntry('reference');
        $barcode = new TEntry('barcode');
        $family_id = new TEntry('family_id');
        $obs = new TEntry('obs');
        $website = new TEntry('website');
        $origin = new TEntry('origin');
        $tribute_situation = new TEntry('tribute_situation');
        $cest = new TEntry('cest');
        $ncm = new TEntry('ncm');
        $is_variation = new TDBCombo();
        $cest_ncm = new TDBCombo('cest_ncm', 'pos_product', 'CestNcm', 'id', '{id}','id asc'  );
        $provider = new TDBCombo('provider', 'pos_product', 'Provider', 'id', '{social_name}','social_name asc'  );
        $brand = new TDBCombo('brand', 'pos_product', 'Brand', 'id', '{name}','name asc'  );
        $category = new TDBCombo('category', 'pos_product', 'Category', 'id', '{name}','name asc'  );

        $description->addValidation("Nome", new TRequiredValidator()); 
        $sku->addValidation("Sku", new TRequiredValidator()); 
        $unity->addValidation("Unidade de medida", new TRequiredValidator()); 
        $type->addValidation("Type", new TRequiredValidator()); 
        $status->addValidation("Status", new TRequiredValidator()); 
        $is_variation->addValidation("Is variation", new TRequiredValidator()); 
        $category->addValidation("Tipo do produto", new TRequiredValidator()); 

        $id->setEditable(false);
        $is_variation->addItems(["1"=>"Sim","2"=>"Não"]);
        $is_variation->setBooleanMode();
        $unity->setValue('UN');
        $type->setValue('new');
        $status->setValue('Ok');
        $is_variation->setValue('false');

        $brand->enableSearch();
        $provider->enableSearch();
        $cest_ncm->enableSearch();
        $category->enableSearch();
        $is_variation->enableSearch();

        $obs->setMaxLength(60);
        $sku->setMaxLength(20);
        $ncm->setMaxLength(20);
        $unity->setMaxLength(2);
        $cest->setMaxLength(20);
        $barcode->setMaxLength(20);
        $origin->setMaxLength(100);
        $website->setMaxLength(100);
        $reference->setMaxLength(30);
        $description->setMaxLength(60);
        $tribute_situation->setMaxLength(20);
        $description_variation->setMaxLength(50);

        $id->setSize(100);
        $ncm->setSize('100%');
        $obs->setSize('100%');
        $sku->setSize('100%');
        $type->setSize('100%');
        $cest->setSize('100%');
        $unity->setSize('100%');
        $brand->setSize('100%');
        $origin->setSize('100%');
        $status->setSize('100%');
        $website->setSize('100%');
        $barcode->setSize('100%');
        $cest_ncm->setSize('100%');
        $provider->setSize('100%');
        $category->setSize('100%');
        $family_id->setSize('100%');
        $reference->setSize('100%');
        $description->setSize('100%');
        $is_variation->setSize('100%');
        $tribute_situation->setSize('100%');
        $description_variation->setSize('100%');




        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Nome:", '#ff0000', '14px', null, '100%'),$description]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Sku:", '#ff0000', '14px', null, '100%'),$sku],[new TLabel("Unidade de medida:", '#ff0000', '14px', null, '100%'),$unity]);
        $row2->layout = ['col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([new TLabel("Type:", '#ff0000', '14px', null, '100%'),$type],[new TLabel("Status:", '#ff0000', '14px', null, '100%'),$status]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        $row4 = $this->form->addFields([new TLabel("Description variation:", null, '14px', null, '100%'),$description_variation],[new TLabel("codigo do fornecedor daquele produto:", null, '14px', null, '100%'),$reference]);
        $row4->layout = ['col-sm-6','col-sm-6'];

        $row5 = $this->form->addFields([new TLabel("Código de barras:", null, '14px', null, '100%'),$barcode],[new TLabel("Family id:", null, '14px', null, '100%'),$family_id]);
        $row5->layout = ['col-sm-6','col-sm-6'];

        $row6 = $this->form->addFields([new TLabel("Observação:", null, '14px', null, '100%'),$obs],[new TLabel("Website:", null, '14px', null, '100%'),$website]);
        $row6->layout = ['col-sm-6','col-sm-6'];

        $row7 = $this->form->addFields([new TLabel("Origin:", null, '14px', null, '100%'),$origin],[new TLabel("Tribute situation:", null, '14px', null, '100%'),$tribute_situation]);
        $row7->layout = ['col-sm-6','col-sm-6'];

        $row8 = $this->form->addFields([new TLabel("Cest:", null, '14px', null, '100%'),$cest],[new TLabel("Ncm:", null, '14px', null, '100%'),$ncm]);
        $row8->layout = ['col-sm-6','col-sm-6'];

        $row9 = $this->form->addFields([new TLabel("Is variation:", '#ff0000', '14px', null, '100%'),$is_variation],[new TLabel("Cest ncm:", null, '14px', null, '100%'),$cest_ncm]);
        $row9->layout = ['col-sm-6','col-sm-6'];

        $row10 = $this->form->addFields([new TLabel("Provider:", null, '14px', null, '100%'),$provider],[new TLabel("Brand:", null, '14px', null, '100%'),$brand]);
        $row10->layout = ['col-sm-6','col-sm-6'];

        $row11 = $this->form->addFields([new TLabel("Tipo do produto:", '#ff0000', '14px', null, '100%'),$category],[]);
        $row11->layout = ['col-sm-6','col-sm-6'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['ProductList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Estoque","Cadastro de product"]));
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

            $object = new Product(); // create an empty object 

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
            TApplication::loadPage('ProductList', 'onShow', $loadPageParam); 

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

                $object = new Product($key); // instantiates the Active Record 

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

