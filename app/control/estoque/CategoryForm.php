<?php

class CategoryForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'pos_product';
    private static $activeRecord = 'Category';
    private static $primaryKey = 'id';
    private static $formName = 'form_CategoryForm';

    use Adianti\Base\AdiantiFileSaveTrait;

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
        $this->form->setFormTitle("Cadastro de categoria de produto");


        $id = new TEntry('id');
        $name = new TEntry('name');
        $cest_ncm_default = new TDBCombo('cest_ncm_default', 'pos_product', 'CestNcm', 'id', 'cest: {fk_cest->number} ncm: {fk_ncm->number} ','id asc'  );
        $icon_category = new TFile('icon_category');
        $color = new TColor('color');

        $name->addValidation("Nome", new TRequiredValidator()); 
        $cest_ncm_default->addValidation("Cest ncm default", new TRequiredValidator()); 

        $id->setEditable(false);
        $name->setMaxLength(50);
        $cest_ncm_default->enableSearch();
        $icon_category->enableFileHandling();
        $color->setValue('#FD03BE');
        $id->setSize(100);
        $name->setSize('100%');
        $color->setSize('100%');
        $icon_category->setSize('100%');
        $cest_ncm_default->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Nome:", null, '14px', null, '100%'),$name],[new TLabel("Cest e NCM padrão", null, '14px', null, '100%'),$cest_ncm_default]);
        $row1->layout = ['col-sm-6 col-lg-2',' col-sm-6 col-lg-7','col-sm-6 col-lg-3'];

        $row2 = $this->form->addFields([new TLabel("url Icone:", null, '14px', null, '100%'),$icon_category],[new TLabel("Cor padrão:", null, '14px', null, '100%'),$color],[new TLabel("Multiplicador:", null, '14px', null, '100%')]);
        $row2->layout = [' col-sm-6 col-lg-4',' col-sm-2 col-lg-3',' col-sm-2 col-lg-3'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['CategoryList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        parent::setTargetContainer('adianti_right_panel');

        $btnClose = new TButton('closeCurtain');
        $btnClose->class = 'btn btn-sm btn-default';
        $btnClose->style = 'margin-right:10px;';
        $btnClose->onClick = "Template.closeRightPanel();";
        $btnClose->setLabel("Fechar");
        $btnClose->setImage('fas:times');

        $this->form->addHeaderWidget($btnClose);

        parent::add($this->form);

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new Category(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $icon_category_dir = '/icons/category'; 

            $object->store(); // save the object 

            $this->saveFile($object, $data, 'icon_category', $icon_category_dir);
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
            TApplication::loadPage('CategoryList', 'onShow', $loadPageParam); 

                        TScript::create("Template.closeRightPanel();"); 
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

                $object = new Category($key); // instantiates the Active Record 

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

