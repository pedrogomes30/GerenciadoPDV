<?php

class CashierControlVue extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = '';
    private static $activeRecord = '';
    private static $primaryKey = '';
    private static $formName = 'form_CashierControlVue';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param = null)
    {
        parent::__construct();

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Caixa");


        $pdvinbutido = new TElement('iframe');

        $pdvinbutido->id = 'pdv';
        $pdvinbutido->width = '100%';
        $pdvinbutido->height = '350px';
        $pdvinbutido->src = "localhost:8080";

        $this->pdvinbutido = $pdvinbutido;

        $row1 = $this->form->addFields([$pdvinbutido]);
        $row1->layout = [' col-sm-6 col-lg-12'];

        // create the form actions
        $btn_onaction = $this->form->addAction("Ação", new TAction([$this, 'onAction']), 'fas:rocket #ffffff');
        $this->btn_onaction = $btn_onaction;
        $btn_onaction->addStyleClass('btn-primary'); 

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Vendas","Caixa"]));
        }
        $container->add($this->form);

        parent::add($container);

    }

    public function onAction($param = null) 
    {
        try
        {

        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }

    public function onShow($param = null)
    {               

    } 

}

