<?php

class ProductForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'pos_product';
    private static $activeRecord = 'Product';
    private static $primaryKey = 'id';
    private static $formName = 'form_ProductForm';

    use BuilderMasterDetailTrait;

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
        $sku = new TEntry('sku');
        $dt_created = new TDateTime('dt_created');
        $is_variation = new TCombo('is_variation');
        $family_id = new TEntry('family_id');
        $description = new TEntry('description');
        $description_variation = new TEntry('description_variation');
        $reference = new TEntry('reference');
        $barcode = new TEntry('barcode');
        $provider = new TDBCombo('provider', 'pos_product', 'Provider', 'id', '{social_name}','social_name asc'  );
        $brand = new TDBCombo('brand', 'pos_product', 'Brand', 'id', '{name}','name asc'  );
        $category = new TDBCombo('category', 'pos_product', 'Category', 'id', '{name}','name asc'  );
        $website = new TEntry('website');
        $type = new TDBCombo('type', 'pos_product', 'TipoCadastro', 'id', '{descricao}','descricao asc'  );
        $status = new TEntry('status');
        $unity = new TEntry('unity');
        $obs = new TEntry('obs');
        $origin = new TEntry('origin');
        $tribute_situation = new TEntry('tribute_situation');
        $cest = new TDBCombo('cest', 'pos_product', 'Cest', 'number', '{number}  - {description} ','id asc'  );
        $ncm = new TDBCombo('ncm', 'pos_product', 'Ncm', 'number', '{number}','id asc'  );
        $price_fk_product_list_price = new TDBCombo('price_fk_product_list_price', 'pos_product', 'PriceList', 'id', '{name}','name asc'  );
        $price_fk_product_id = new THidden('price_fk_product_id');
        $price_fk_product_sell_price = new TNumeric('price_fk_product_sell_price', '2', ',', '.' );
        $price_fk_product_cust_price = new TNumeric('price_fk_product_cust_price', '2', ',', '.' );
        $button_adicionar_price_fk_product = new TButton('button_adicionar_price_fk_product');
        $product_storage_fk_product_deposit = new TDBCombo('product_storage_fk_product_deposit', 'pos_product', 'Deposit', 'id', '{name}','name asc'  );
        $product_storage_fk_product_id = new THidden('product_storage_fk_product_id');
        $product_storage_fk_product_quantity = new TEntry('product_storage_fk_product_quantity');
        $add_quantidade = new TEntry('add_quantidade');
        $product_storage_fk_product_min_storage = new TEntry('product_storage_fk_product_min_storage');
        $product_storage_fk_product_max_storage = new TEntry('product_storage_fk_product_max_storage');
        $button_adicionar_product_storage_fk_product = new TButton('button_adicionar_product_storage_fk_product');

        $sku->addValidation("Sku", new TRequiredValidator()); 
        $is_variation->addValidation("Is variation", new TRequiredValidator()); 
        $description->addValidation("Nome", new TRequiredValidator()); 
        $category->addValidation("Tipo do produto", new TRequiredValidator()); 
        $type->addValidation("Type", new TRequiredValidator()); 
        $status->addValidation("Status", new TRequiredValidator()); 
        $unity->addValidation("Unidade de medida", new TRequiredValidator()); 
        $barcode->addValidation(".", new TNumericValidator(), []); 

        $dt_created->setDatabaseMask('yyyy-mm-dd hh:ii');
        $dt_created->setMask('dd/mm/yyyy hh:ii');
        $is_variation->addItems(["1"=>"Sim","2"=>"Não"]);
        $is_variation->setBooleanMode();
        $button_adicionar_price_fk_product->setAction(new TAction([$this, 'onAddDetailPriceFkProduct'],['static' => 1]), "Adicionar");
        $button_adicionar_product_storage_fk_product->setAction(new TAction([$this, 'onAddDetailProductStorageFkProduct'],['static' => 1]), "Adicionar");

        $button_adicionar_price_fk_product->addStyleClass('btn-default');
        $button_adicionar_product_storage_fk_product->addStyleClass('btn-default');

        $button_adicionar_price_fk_product->setImage('fas:plus #2ecc71');
        $button_adicionar_product_storage_fk_product->setImage('fas:plus #2ecc71');

        $type->setValue('1');
        $unity->setValue('UN');
        $status->setValue('Ok');
        $is_variation->setValue('false');
        $dt_created->setValue(date('Y-m-d H:i:s'));

        $id->setEditable(false);
        $sku->setEditable(false);
        $family_id->setEditable(false);
        $dt_created->setEditable(false);
        $is_variation->setEditable(false);
        $product_storage_fk_product_quantity->setEditable(false);

        $ncm->enableSearch();
        $type->enableSearch();
        $cest->enableSearch();
        $brand->enableSearch();
        $provider->enableSearch();
        $category->enableSearch();
        $is_variation->enableSearch();
        $price_fk_product_list_price->enableSearch();
        $product_storage_fk_product_deposit->enableSearch();

        $obs->setMaxLength(60);
        $sku->setMaxLength(20);
        $unity->setMaxLength(2);
        $status->setMaxLength(15);
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
        $cest->setSize('100%');
        $type->setSize('100%');
        $brand->setSize('100%');
        $unity->setSize('100%');
        $status->setSize('100%');
        $origin->setSize('100%');
        $barcode->setSize('100%');
        $website->setSize('100%');
        $provider->setSize('100%');
        $category->setSize('100%');
        $reference->setSize('100%');
        $family_id->setSize('100%');
        $dt_created->setSize('100%');
        $description->setSize('100%');
        $is_variation->setSize('100%');
        $add_quantidade->setSize('100%');
        $price_fk_product_id->setSize(200);
        $tribute_situation->setSize('100%');
        $description_variation->setSize('100%');
        $product_storage_fk_product_id->setSize(200);
        $price_fk_product_list_price->setSize('100%');
        $price_fk_product_sell_price->setSize('100%');
        $price_fk_product_cust_price->setSize('100%');
        $product_storage_fk_product_deposit->setSize('100%');
        $product_storage_fk_product_quantity->setSize('100%');
        $product_storage_fk_product_min_storage->setSize('100%');
        $product_storage_fk_product_max_storage->setSize('100%');



        $button_adicionar_price_fk_product->id = '62b21ca6cf31d';
        $button_adicionar_product_storage_fk_product->id = '62b22022cf321';

        $this->form->appendPage("Geral");

        $this->form->addFields([new THidden('current_tab')]);
        $this->form->setTabFunction("$('[name=current_tab]').val($(this).attr('data-current_page'));");

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Sku:", null, '14px', null, '100%'),$sku],[],[new TLabel("Data cadastro:", null, '14px', null, '100%'),$dt_created]);
        $row1->layout = [' col-sm-6 col-lg-2',' col-sm-6 col-lg-3',' col-sm-2 col-lg-4',' col-sm-2 col-lg-3'];

        $row2 = $this->form->addFields([],[new TLabel("Is variation:", null, '14px', null, '100%'),$is_variation],[],[new TLabel("Family id:", null, '14px', null, '100%'),$family_id]);
        $row2->layout = [' col-sm-3 col-lg-2',' col-sm-6 col-lg-3',' col-sm-2 col-lg-4',' col-sm-6 col-lg-3'];

        $row3 = $this->form->addFields([new TLabel("Descrição produto:", null, '14px', null, '100%'),$description],[new TLabel("Descrição variação:", null, '14px', null, '100%'),$description_variation],[new TLabel("Referência:", null, '14px', null, '100%'),$reference],[new TLabel("Código de barras/ EAN13:", null, '14px', null, '100%'),$barcode]);
        $row3->layout = [' col-sm-6 col-lg-3',' col-sm-6 col-lg-3',' col-sm-6 col-lg-3',' col-sm-6 col-lg-3'];

        $row4 = $this->form->addFields([new TLabel("Fornecedor:", null, '14px', null, '100%'),$provider],[],[new TLabel("Marca:", null, '14px', null, '100%'),$brand],[],[new TLabel("Categoria produto:", null, '14px', null, '100%'),$category],[],[new TLabel("Website:", null, '14px', null, '100%'),$website]);
        $row4->layout = [' col-sm-6 col-lg-2',' col-sm-2 col-lg-1',' col-sm-6 col-lg-2',' col-sm-2 col-lg-1',' col-sm-6 col-lg-2',' col-sm-2 col-lg-1',' col-sm-6 col-lg-3'];

        $row5 = $this->form->addFields([new TLabel("Type:", null, '14px', null, '100%'),$type],[],[new TLabel("Status:", null, '14px', null, '100%'),$status],[new TLabel("Unidade de medida:", null, '14px', null, '100%'),$unity],[new TLabel("Observação:", null, '14px', null, '100%'),$obs]);
        $row5->layout = [' col-sm-6 col-lg-2',' col-sm-2 col-lg-1',' col-sm-6 col-lg-3',' col-sm-6 col-lg-3',' col-sm-6 col-lg-3'];

        $this->form->appendPage("Tributário");
        $row6 = $this->form->addFields([new TLabel("Origem:", null, '14px', null, '100%'),$origin],[new TLabel("Situação Tributária:", null, '14px', null, '100%'),$tribute_situation]);
        $row6->layout = ['col-sm-6','col-sm-6'];

        $row7 = $this->form->addFields([new TLabel("Cest:", null, '14px', null, '100%'),$cest],[new TLabel("Cest ncm:", null, '14px', null, '100%'),$ncm]);
        $row7->layout = ['col-sm-6','col-sm-6'];

        $this->form->appendPage("Precificação");

        $this->detailFormPriceFkProduct = new BootstrapFormBuilder('detailFormPriceFkProduct');
        $this->detailFormPriceFkProduct->setProperty('style', 'border:none; box-shadow:none; width:100%;');

        $this->detailFormPriceFkProduct->setProperty('class', 'form-horizontal builder-detail-form');

        $row8 = $this->detailFormPriceFkProduct->addFields([new TLabel("Lista Preço", null, '14px', null, '100%'),$price_fk_product_list_price,$price_fk_product_id],[new TLabel("Preço Venda:", null, '14px', null, '100%'),$price_fk_product_sell_price],[new TLabel("Preço Custo:", null, '14px', null, '100%'),$price_fk_product_cust_price]);
        $row8->layout = ['col-sm-6',' col-sm-2 col-lg-3',' col-sm-6 col-lg-3'];

        $row9 = $this->detailFormPriceFkProduct->addFields([$button_adicionar_price_fk_product]);
        $row9->layout = [' col-sm-12'];

        $row10 = $this->detailFormPriceFkProduct->addFields([new THidden('price_fk_product__row__id')]);
        $this->price_fk_product_criteria = new TCriteria();

        $this->price_fk_product_list = new BootstrapDatagridWrapper(new TDataGrid);
        $this->price_fk_product_list->disableHtmlConversion();;
        $this->price_fk_product_list->generateHiddenFields();
        $this->price_fk_product_list->setId('price_fk_product_list');

        $this->price_fk_product_list->style = 'width:100%';
        $this->price_fk_product_list->class .= ' table-bordered';

        $column_price_fk_product_fk_list_price_name = new TDataGridColumn('fk_list_price->name', "Lista de Preço", 'left');
        $column_price_fk_product_sell_price = new TDataGridColumn('sell_price', "Preço de Venda", 'left');
        $column_price_fk_product_cust_price = new TDataGridColumn('cust_price', "Preço de Custo", 'left');

        $column_price_fk_product__row__data = new TDataGridColumn('__row__data', '', 'center');
        $column_price_fk_product__row__data->setVisibility(false);

        $action_onEditDetailPrice = new TDataGridAction(array('ProductForm', 'onEditDetailPrice'));
        $action_onEditDetailPrice->setUseButton(false);
        $action_onEditDetailPrice->setButtonClass('btn btn-default btn-sm');
        $action_onEditDetailPrice->setLabel("Editar");
        $action_onEditDetailPrice->setImage('far:edit #478fca');
        $action_onEditDetailPrice->setFields(['__row__id', '__row__data']);

        $this->price_fk_product_list->addAction($action_onEditDetailPrice);
        $action_onDeleteDetailPrice = new TDataGridAction(array('ProductForm', 'onDeleteDetailPrice'));
        $action_onDeleteDetailPrice->setUseButton(false);
        $action_onDeleteDetailPrice->setButtonClass('btn btn-default btn-sm');
        $action_onDeleteDetailPrice->setLabel("Excluir");
        $action_onDeleteDetailPrice->setImage('fas:trash-alt #dd5a43');
        $action_onDeleteDetailPrice->setFields(['__row__id', '__row__data']);

        $this->price_fk_product_list->addAction($action_onDeleteDetailPrice);

        $this->price_fk_product_list->addColumn($column_price_fk_product_fk_list_price_name);
        $this->price_fk_product_list->addColumn($column_price_fk_product_sell_price);
        $this->price_fk_product_list->addColumn($column_price_fk_product_cust_price);

        $this->price_fk_product_list->addColumn($column_price_fk_product__row__data);

        $this->price_fk_product_list->createModel();
        $tableResponsiveDiv = new TElement('div');
        $tableResponsiveDiv->class = 'table-responsive';
        $tableResponsiveDiv->add($this->price_fk_product_list);
        $this->detailFormPriceFkProduct->addContent([$tableResponsiveDiv]);

        $row11 = $this->form->addFields([$this->detailFormPriceFkProduct]);
        $row11->layout = [' col-sm-6 col-lg-12'];

        $this->form->appendPage("Estoque");

        $this->detailFormProductStorageFkProduct = new BootstrapFormBuilder('detailFormProductStorageFkProduct');
        $this->detailFormProductStorageFkProduct->setProperty('style', 'border:none; box-shadow:none; width:100%;');

        $this->detailFormProductStorageFkProduct->setProperty('class', 'form-horizontal builder-detail-form');

        $row12 = $this->detailFormProductStorageFkProduct->addFields([new TLabel("Depósito:", null, '14px', null, '100%'),$product_storage_fk_product_deposit,$product_storage_fk_product_id],[new TLabel("Quantidade:", null, '14px', null, '100%'),$product_storage_fk_product_quantity],[new TLabel("Add. Quantidade:", null, '14px', null),$add_quantidade],[new TLabel("Estoque min.", null, '14px', null, '100%'),$product_storage_fk_product_min_storage],[new TLabel("Estoque máx.", null, '14px', null, '100%'),$product_storage_fk_product_max_storage]);
        $row12->layout = [' col-sm-6 col-lg-4',' col-sm-2 col-lg-2',' col-sm-2 col-lg-2',' col-sm-6 col-lg-2',' col-sm-2 col-lg-2'];

        $row13 = $this->detailFormProductStorageFkProduct->addFields([$button_adicionar_product_storage_fk_product]);
        $row13->layout = [' col-sm-12'];

        $row14 = $this->detailFormProductStorageFkProduct->addFields([new THidden('product_storage_fk_product__row__id')]);
        $this->product_storage_fk_product_criteria = new TCriteria();

        $this->product_storage_fk_product_list = new BootstrapDatagridWrapper(new TDataGrid);
        $this->product_storage_fk_product_list->disableHtmlConversion();;
        $this->product_storage_fk_product_list->generateHiddenFields();
        $this->product_storage_fk_product_list->setId('product_storage_fk_product_list');

        $this->product_storage_fk_product_list->style = 'width:100%';
        $this->product_storage_fk_product_list->class .= ' table-bordered';

        $column_product_storage_fk_product_fk_deposit_name = new TDataGridColumn('fk_deposit->name', "Depósito", 'left');
        $column_product_storage_fk_product_quantity = new TDataGridColumn('quantity', "Quantidade", 'left');
        $column_product_storage_fk_product_min_storage = new TDataGridColumn('min_storage', "Estoque min.", 'left');
        $column_product_storage_fk_product_max_storage = new TDataGridColumn('max_storage', "Estoque máx.", 'left');

        $column_product_storage_fk_product__row__data = new TDataGridColumn('__row__data', '', 'center');
        $column_product_storage_fk_product__row__data->setVisibility(false);

        $action_onEditDetailProductStorage = new TDataGridAction(array('ProductForm', 'onEditDetailProductStorage'));
        $action_onEditDetailProductStorage->setUseButton(false);
        $action_onEditDetailProductStorage->setButtonClass('btn btn-default btn-sm');
        $action_onEditDetailProductStorage->setLabel("Editar");
        $action_onEditDetailProductStorage->setImage('far:edit #478fca');
        $action_onEditDetailProductStorage->setFields(['__row__id', '__row__data']);

        $this->product_storage_fk_product_list->addAction($action_onEditDetailProductStorage);
        $action_onDeleteDetailProductStorage = new TDataGridAction(array('ProductForm', 'onDeleteDetailProductStorage'));
        $action_onDeleteDetailProductStorage->setUseButton(false);
        $action_onDeleteDetailProductStorage->setButtonClass('btn btn-default btn-sm');
        $action_onDeleteDetailProductStorage->setLabel("Excluir");
        $action_onDeleteDetailProductStorage->setImage('fas:trash-alt #dd5a43');
        $action_onDeleteDetailProductStorage->setFields(['__row__id', '__row__data']);

        $this->product_storage_fk_product_list->addAction($action_onDeleteDetailProductStorage);

        $this->product_storage_fk_product_list->addColumn($column_product_storage_fk_product_fk_deposit_name);
        $this->product_storage_fk_product_list->addColumn($column_product_storage_fk_product_quantity);
        $this->product_storage_fk_product_list->addColumn($column_product_storage_fk_product_min_storage);
        $this->product_storage_fk_product_list->addColumn($column_product_storage_fk_product_max_storage);

        $this->product_storage_fk_product_list->addColumn($column_product_storage_fk_product__row__data);

        $this->product_storage_fk_product_list->createModel();
        $tableResponsiveDiv = new TElement('div');
        $tableResponsiveDiv->class = 'table-responsive';
        $tableResponsiveDiv->add($this->product_storage_fk_product_list);
        $this->detailFormProductStorageFkProduct->addContent([$tableResponsiveDiv]);

        $row15 = $this->form->addFields([$this->detailFormProductStorageFkProduct]);
        $row15->layout = [' col-sm-6 col-lg-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave'],['static' => 1]), 'fas:save #ffffff');
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
            $container->add(TBreadCrumb::create(["Estoque","Cadastro de Produto"]));
        }
        $container->add($this->form);

        parent::add($container);

    }

    public  function onAddDetailPriceFkProduct($param = null) 
    {
        try
        {
            $data = $this->form->getData();

                $errors = [];
                $requiredFields = [];
                $requiredFields[] = ['label'=>"List price", 'name'=>"price_fk_product_list_price", 'class'=>'TRequiredValidator', 'value'=>[]];
                $requiredFields[] = ['label'=>"Sell price", 'name'=>"price_fk_product_sell_price", 'class'=>'TRequiredValidator', 'value'=>[]];
                $requiredFields[] = ['label'=>"Cust price", 'name'=>"price_fk_product_cust_price", 'class'=>'TRequiredValidator', 'value'=>[]];
                foreach($requiredFields as $requiredField)
                {
                    try
                    {
                        (new $requiredField['class'])->validate($requiredField['label'], $data->{$requiredField['name']}, $requiredField['value']);
                    }
                    catch(Exception $e)
                    {
                        $errors[] = $e->getMessage() . '.';
                    }
                 }
                 if(count($errors) > 0)
                 {
                     throw new Exception(implode('<br>', $errors));
                 }

                $__row__id = !empty($data->price_fk_product__row__id) ? $data->price_fk_product__row__id : 'b'.uniqid();

                TTransaction::open(self::$database);

                $grid_data = new Price();
                $grid_data->__row__id = $__row__id;
                $grid_data->list_price = $data->price_fk_product_list_price;
                $grid_data->id = $data->price_fk_product_id;
                $grid_data->sell_price = $data->price_fk_product_sell_price;
                $grid_data->cust_price = $data->price_fk_product_cust_price;

                $__row__data = array_merge($grid_data->toArray(), (array)$grid_data->getVirtualData());
                $__row__data['__row__id'] = $__row__id;
                $__row__data['__display__']['list_price'] =  $param['price_fk_product_list_price'] ?? null;
                $__row__data['__display__']['id'] =  $param['price_fk_product_id'] ?? null;
                $__row__data['__display__']['sell_price'] =  $param['price_fk_product_sell_price'] ?? null;
                $__row__data['__display__']['cust_price'] =  $param['price_fk_product_cust_price'] ?? null;

                $grid_data->__row__data = base64_encode(serialize((object)$__row__data));
                $row = $this->price_fk_product_list->addItem($grid_data);
                $row->id = $grid_data->__row__id;

                TDataGrid::replaceRowById('price_fk_product_list', $grid_data->__row__id, $row);

                TTransaction::close();

                $data = new stdClass;
                $data->price_fk_product_list_price = '';
                $data->price_fk_product_id = '';
                $data->price_fk_product_sell_price = '';
                $data->price_fk_product_cust_price = '';
                $data->price_fk_product__row__id = '';

                TForm::sendData(self::$formName, $data);
                TScript::create("
                   var element = $('#62b21ca6cf31d');
                   if(typeof element.attr('add') != 'undefined')
                   {
                       element.html(base64_decode(element.attr('add')));
                   }
                ");

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public  function onAddDetailProductStorageFkProduct($param = null) 
    {
        try
        {
            $data = $this->form->getData();

                $errors = [];
                $requiredFields = [];
                $requiredFields[] = ['label'=>"Deposit", 'name'=>"product_storage_fk_product_deposit", 'class'=>'TRequiredValidator', 'value'=>[]];
                $requiredFields[] = ['label'=>"Quantity", 'name'=>"product_storage_fk_product_quantity", 'class'=>'TRequiredValidator', 'value'=>[]];
                $requiredFields[] = ['label'=>".", 'name'=>"product_storage_fk_product_quantity", 'class'=>'TNumericValidator', 'value'=>[]];
                foreach($requiredFields as $requiredField)
                {
                    try
                    {
                        (new $requiredField['class'])->validate($requiredField['label'], $data->{$requiredField['name']}, $requiredField['value']);
                    }
                    catch(Exception $e)
                    {
                        $errors[] = $e->getMessage() . '.';
                    }
                 }
                 if(count($errors) > 0)
                 {
                     throw new Exception(implode('<br>', $errors));
                 }

                $__row__id = !empty($data->product_storage_fk_product__row__id) ? $data->product_storage_fk_product__row__id : 'b'.uniqid();

                TTransaction::open(self::$database);

                $grid_data = new ProductStorage();
                $grid_data->__row__id = $__row__id;
                $grid_data->deposit = $data->product_storage_fk_product_deposit;
                $grid_data->id = $data->product_storage_fk_product_id;
                $grid_data->quantity = $data->product_storage_fk_product_quantity;
                $grid_data->add_quantidade = $data->add_quantidade;
                $grid_data->min_storage = $data->product_storage_fk_product_min_storage;
                $grid_data->max_storage = $data->product_storage_fk_product_max_storage;

                $__row__data = array_merge($grid_data->toArray(), (array)$grid_data->getVirtualData());
                $__row__data['__row__id'] = $__row__id;
                $__row__data['__display__']['deposit'] =  $param['product_storage_fk_product_deposit'] ?? null;
                $__row__data['__display__']['id'] =  $param['product_storage_fk_product_id'] ?? null;
                $__row__data['__display__']['quantity'] =  $param['product_storage_fk_product_quantity'] ?? null;
                $__row__data['__display__']['add_quantidade'] =  $param['add_quantidade'] ?? null;
                $__row__data['__display__']['min_storage'] =  $param['product_storage_fk_product_min_storage'] ?? null;
                $__row__data['__display__']['max_storage'] =  $param['product_storage_fk_product_max_storage'] ?? null;

                $grid_data->__row__data = base64_encode(serialize((object)$__row__data));
                $row = $this->product_storage_fk_product_list->addItem($grid_data);
                $row->id = $grid_data->__row__id;

                TDataGrid::replaceRowById('product_storage_fk_product_list', $grid_data->__row__id, $row);

                TTransaction::close();

                $data = new stdClass;
                $data->product_storage_fk_product_deposit = '';
                $data->product_storage_fk_product_id = '';
                $data->product_storage_fk_product_quantity = '';
                $data->add_quantidade = '';
                $data->product_storage_fk_product_min_storage = '';
                $data->product_storage_fk_product_max_storage = '';
                $data->product_storage_fk_product__row__id = '';

                TForm::sendData(self::$formName, $data);
                TScript::create("
                   var element = $('#62b22022cf321');
                   if(typeof element.attr('add') != 'undefined')
                   {
                       element.html(base64_decode(element.attr('add')));
                   }
                ");

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public static function onEditDetailPrice($param = null) 
    {
        try
        {

                $__row__data = unserialize(base64_decode($param['__row__data']));
                $__row__data->__display__ = is_array($__row__data->__display__) ? (object) $__row__data->__display__ : $__row__data->__display__;

                $data = new stdClass;
                $data->price_fk_product_list_price = $__row__data->__display__->list_price ?? null;
                $data->price_fk_product_id = $__row__data->__display__->id ?? null;
                $data->price_fk_product_sell_price = $__row__data->__display__->sell_price ?? null;
                $data->price_fk_product_cust_price = $__row__data->__display__->cust_price ?? null;
                $data->price_fk_product__row__id = $__row__data->__row__id;

                TForm::sendData(self::$formName, $data);
                TScript::create("
                   var element = $('#62b21ca6cf31d');
                   if(!element.attr('add')){
                       element.attr('add', base64_encode(element.html()));
                   }
                   element.html(\"<span><i class='far fa-edit' style='color:#478fca;padding-right:4px;'></i>Editar</span>\");
                   if(!element.attr('edit')){
                       element.attr('edit', base64_encode(element.html()));
                   }
                ");

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public static function onDeleteDetailPrice($param = null) 
    {
        try
        {

                $__row__data = unserialize(base64_decode($param['__row__data']));

                $data = new stdClass;
                $data->price_fk_product_list_price = '';
                $data->price_fk_product_id = '';
                $data->price_fk_product_sell_price = '';
                $data->price_fk_product_cust_price = '';
                $data->price_fk_product__row__id = '';

                TForm::sendData(self::$formName, $data);

                TDataGrid::removeRowById('price_fk_product_list', $__row__data->__row__id);

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public static function onEditDetailProductStorage($param = null) 
    {
        try
        {

                $__row__data = unserialize(base64_decode($param['__row__data']));
                $__row__data->__display__ = is_array($__row__data->__display__) ? (object) $__row__data->__display__ : $__row__data->__display__;

                $data = new stdClass;
                $data->product_storage_fk_product_deposit = $__row__data->__display__->deposit ?? null;
                $data->product_storage_fk_product_id = $__row__data->__display__->id ?? null;
                $data->product_storage_fk_product_quantity = $__row__data->__display__->quantity ?? null;
                $data->add_quantidade = $__row__data->__display__->add_quantidade ?? null;
                $data->product_storage_fk_product_min_storage = $__row__data->__display__->min_storage ?? null;
                $data->product_storage_fk_product_max_storage = $__row__data->__display__->max_storage ?? null;
                $data->product_storage_fk_product__row__id = $__row__data->__row__id;

                TForm::sendData(self::$formName, $data);
                TScript::create("
                   var element = $('#62b22022cf321');
                   if(!element.attr('add')){
                       element.attr('add', base64_encode(element.html()));
                   }
                   element.html(\"<span><i class='far fa-edit' style='color:#478fca;padding-right:4px;'></i>Editar</span>\");
                   if(!element.attr('edit')){
                       element.attr('edit', base64_encode(element.html()));
                   }
                ");

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public static function onDeleteDetailProductStorage($param = null) 
    {
        try
        {

                $__row__data = unserialize(base64_decode($param['__row__data']));

                $data = new stdClass;
                $data->product_storage_fk_product_deposit = '';
                $data->product_storage_fk_product_id = '';
                $data->product_storage_fk_product_quantity = '';
                $data->add_quantidade = '';
                $data->product_storage_fk_product_min_storage = '';
                $data->product_storage_fk_product_max_storage = '';
                $data->product_storage_fk_product__row__id = '';

                TForm::sendData(self::$formName, $data);

                TDataGrid::removeRowById('product_storage_fk_product_list', $__row__data->__row__id);

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
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

            TForm::sendData(self::$formName, (object)['id' => $object->id]);

            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            $product_storage_fk_product_items = $this->storeMasterDetailItems('ProductStorage', 'product', 'product_storage_fk_product', $object, $param['product_storage_fk_product_list___row__data'] ?? [], $this->form, $this->product_storage_fk_product_list, function($masterObject, $detailObject){ 

                //code here

            }, $this->product_storage_fk_product_criteria); 

            $price_fk_product_items = $this->storeMasterDetailItems('Price', 'product', 'price_fk_product', $object, $param['price_fk_product_list___row__data'] ?? [], $this->form, $this->price_fk_product_list, function($masterObject, $detailObject){ 

                //code here

            }, $this->price_fk_product_criteria); 

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

                $product_storage_fk_product_items = $this->loadMasterDetailItems('ProductStorage', 'product', 'product_storage_fk_product', $object, $this->form, $this->product_storage_fk_product_list, $this->product_storage_fk_product_criteria, function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }); 

                $price_fk_product_items = $this->loadMasterDetailItems('Price', 'product', 'price_fk_product', $object, $this->form, $this->price_fk_product_list, $this->price_fk_product_criteria, function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }); 

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

