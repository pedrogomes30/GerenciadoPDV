<?php

class SaleList extends TPage
{
    private $form; // form
    private $datagrid; // listing
    private $pageNavigation;
    private $loaded;
    private $filter_criteria;
    private static $database = 'pos_sales';
    private static $activeRecord = 'Sale';
    private static $primaryKey = 'id';
    private static $formName = 'form_SaleList';
    private $showMethods = ['onReload', 'onSearch', 'onRefresh', 'onClearFilters'];
    private $limit = 20;

    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct($param = null)
    {
        parent::__construct();

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);

        // define the form title
        $this->form->setFormTitle("Listagem de vendas");
        $this->limit = 20;

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



        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Number:", null, '14px', null, '100%'),$number]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Products value:", null, '14px', null, '100%'),$products_value],[new TLabel("Payments value:", null, '14px', null, '100%'),$payments_value]);
        $row2->layout = ['col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([new TLabel("Valor total:", null, '14px', null, '100%'),$total_value],[new TLabel("Sale date:", null, '14px', null, '100%'),$sale_date]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        $row4 = $this->form->addFields([new TLabel("Invoiced:", null, '14px', null, '100%'),$invoiced],[new TLabel("Invoice ambient:", null, '14px', null, '100%'),$invoice_ambient]);
        $row4->layout = ['col-sm-6','col-sm-6'];

        $row5 = $this->form->addFields([new TLabel("Discont value:", null, '14px', null, '100%'),$discont_value],[new TLabel("Observação:", null, '14px', null, '100%'),$obs]);
        $row5->layout = ['col-sm-6','col-sm-6'];

        $row6 = $this->form->addFields([new TLabel("Invoice number:", null, '14px', null, '100%'),$invoice_number],[new TLabel("Invoice serie:", null, '14px', null, '100%'),$invoice_serie]);
        $row6->layout = ['col-sm-6','col-sm-6'];

        $row7 = $this->form->addFields([new TLabel("Invoice coupon:", null, '14px', null, '100%'),$invoice_coupon],[new TLabel("Invoice xml:", null, '14px', null, '100%'),$invoice_xml]);
        $row7->layout = ['col-sm-6','col-sm-6'];

        $row8 = $this->form->addFields([new TLabel("Payment method:", null, '14px', null, '100%'),$payment_method],[new TLabel("Store:", null, '14px', null, '100%'),$store]);
        $row8->layout = ['col-sm-6','col-sm-6'];

        $row9 = $this->form->addFields([new TLabel("Employee cashier:", null, '14px', null, '100%'),$employee_cashier],[new TLabel("Cashier:", null, '14px', null, '100%'),$cashier]);
        $row9->layout = ['col-sm-6','col-sm-6'];

        $row10 = $this->form->addFields([new TLabel("Cliente:", null, '14px', null, '100%'),$client],[new TLabel("Salesman:", null, '14px', null, '100%'),$salesman]);
        $row10->layout = ['col-sm-6','col-sm-6'];

        $row11 = $this->form->addFields([new TLabel("Status:", null, '14px', null, '100%'),$status],[]);
        $row11->layout = ['col-sm-6','col-sm-6'];

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $btn_onsearch = $this->form->addAction("Buscar", new TAction([$this, 'onSearch']), 'fas:search #ffffff');
        $this->btn_onsearch = $btn_onsearch;
        $btn_onsearch->addStyleClass('btn-primary'); 

        $btn_onshow = $this->form->addAction("Cadastrar", new TAction(['SaleForm', 'onShow']), 'fas:plus #69aa46');
        $this->btn_onshow = $btn_onshow;

        // creates a Datagrid
        $this->datagrid = new TDataGrid;
        $this->datagrid->disableHtmlConversion();

        $this->datagrid_form = new TForm('datagrid_'.self::$formName);
        $this->datagrid_form->onsubmit = 'return false';

        $this->datagrid = new BootstrapDatagridWrapper($this->datagrid);
        $this->filter_criteria = new TCriteria;

        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);

        $column_id = new TDataGridColumn('id', "Id", 'center' , '70px');
        $column_number = new TDataGridColumn('number', "Number", 'left');
        $column_products_value = new TDataGridColumn('products_value', "Products value", 'left');
        $column_payments_value = new TDataGridColumn('payments_value', "Payments value", 'left');
        $column_total_value = new TDataGridColumn('total_value', "Valor total", 'left');
        $column_sale_date = new TDataGridColumn('sale_date', "Sale date", 'left');
        $column_invoiced = new TDataGridColumn('invoiced', "Invoiced", 'left');
        $column_invoice_ambient = new TDataGridColumn('invoice_ambient', "Invoice ambient", 'left');
        $column_discont_value = new TDataGridColumn('discont_value', "Discont value", 'left');
        $column_obs = new TDataGridColumn('obs', "Observação", 'left');
        $column_invoice_number = new TDataGridColumn('invoice_number', "Invoice number", 'left');
        $column_invoice_serie = new TDataGridColumn('invoice_serie', "Invoice serie", 'left');
        $column_invoice_coupon = new TDataGridColumn('invoice_coupon', "Invoice coupon", 'left');
        $column_invoice_xml = new TDataGridColumn('invoice_xml', "Invoice xml", 'left');
        $column_payment_method = new TDataGridColumn('payment_method', "Payment method", 'left');
        $column_fk_store_social_name = new TDataGridColumn('fk_store->social_name', "Store", 'left');
        $column_employee_cashier = new TDataGridColumn('employee_cashier', "Employee cashier", 'left');
        $column_cashier = new TDataGridColumn('cashier', "Cashier", 'left');
        $column_client = new TDataGridColumn('client', "Cliente", 'left');
        $column_salesman = new TDataGridColumn('salesman', "Salesman", 'left');
        $column_status = new TDataGridColumn('status', "Status", 'left');

        $order_id = new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', 'id');
        $column_id->setAction($order_id);

        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_number);
        $this->datagrid->addColumn($column_products_value);
        $this->datagrid->addColumn($column_payments_value);
        $this->datagrid->addColumn($column_total_value);
        $this->datagrid->addColumn($column_sale_date);
        $this->datagrid->addColumn($column_invoiced);
        $this->datagrid->addColumn($column_invoice_ambient);
        $this->datagrid->addColumn($column_discont_value);
        $this->datagrid->addColumn($column_obs);
        $this->datagrid->addColumn($column_invoice_number);
        $this->datagrid->addColumn($column_invoice_serie);
        $this->datagrid->addColumn($column_invoice_coupon);
        $this->datagrid->addColumn($column_invoice_xml);
        $this->datagrid->addColumn($column_payment_method);
        $this->datagrid->addColumn($column_fk_store_social_name);
        $this->datagrid->addColumn($column_employee_cashier);
        $this->datagrid->addColumn($column_cashier);
        $this->datagrid->addColumn($column_client);
        $this->datagrid->addColumn($column_salesman);
        $this->datagrid->addColumn($column_status);

        $action_onEdit = new TDataGridAction(array('SaleForm', 'onEdit'));
        $action_onEdit->setUseButton(false);
        $action_onEdit->setButtonClass('btn btn-default btn-sm');
        $action_onEdit->setLabel("Editar");
        $action_onEdit->setImage('far:edit #478fca');
        $action_onEdit->setField(self::$primaryKey);

        $this->datagrid->addAction($action_onEdit);

        $action_onDelete = new TDataGridAction(array('SaleList', 'onDelete'));
        $action_onDelete->setUseButton(false);
        $action_onDelete->setButtonClass('btn btn-default btn-sm');
        $action_onDelete->setLabel("Excluir");
        $action_onDelete->setImage('fas:trash-alt #dd5a43');
        $action_onDelete->setField(self::$primaryKey);

        $this->datagrid->addAction($action_onDelete);

        // create the datagrid model
        $this->datagrid->createModel();

        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->enableCounters();
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());

        $panel = new TPanelGroup();
        $panel->datagrid = 'datagrid-container';
        $this->datagridPanel = $panel;
        $this->datagrid_form->add($this->datagrid);
        $panel->add($this->datagrid_form);

        $panel->getBody()->class .= ' table-responsive';

        $panel->addFooter($this->pageNavigation);

        $headerActions = new TElement('div');
        $headerActions->class = ' datagrid-header-actions ';
        $headerActions->style = 'justify-content: space-between;';

        $head_left_actions = new TElement('div');
        $head_left_actions->class = ' datagrid-header-actions-left-actions ';

        $head_right_actions = new TElement('div');
        $head_right_actions->class = ' datagrid-header-actions-left-actions ';

        $headerActions->add($head_left_actions);
        $headerActions->add($head_right_actions);

        $panel->getBody()->insert(0, $headerActions);

        $dropdown_button_exportar = new TDropDown("Exportar", 'fas:file-export #2d3436');
        $dropdown_button_exportar->setPullSide('right');
        $dropdown_button_exportar->setButtonClass('btn btn-default waves-effect dropdown-toggle');
        $dropdown_button_exportar->addPostAction( "CSV", new TAction(['SaleList', 'onExportCsv'],['static' => 1]), 'datagrid_'.self::$formName, 'fas:file-csv #00b894' );
        $dropdown_button_exportar->addPostAction( "XLS", new TAction(['SaleList', 'onExportXls'],['static' => 1]), 'datagrid_'.self::$formName, 'fas:file-excel #4CAF50' );
        $dropdown_button_exportar->addPostAction( "PDF", new TAction(['SaleList', 'onExportPdf'],['static' => 1]), 'datagrid_'.self::$formName, 'far:file-pdf #e74c3c' );
        $dropdown_button_exportar->addPostAction( "XML", new TAction(['SaleList', 'onExportXml'],['static' => 1]), 'datagrid_'.self::$formName, 'far:file-code #95a5a6' );

        $head_right_actions->add($dropdown_button_exportar);

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Vendas","Vendas"]));
        }
        $container->add($this->form);
        $container->add($panel);

        parent::add($container);

    }

    public function onDelete($param = null) 
    { 
        if(isset($param['delete']) && $param['delete'] == 1)
        {
            try
            {
                // get the paramseter $key
                $key = $param['key'];
                // open a transaction with database
                TTransaction::open(self::$database);

                // instantiates object
                $object = new Sale($key, FALSE); 

                // deletes the object from the database
                $object->delete();

                // close the transaction
                TTransaction::close();

                // reload the listing
                $this->onReload( $param );
                // shows the success message
                new TMessage('info', AdiantiCoreTranslator::translate('Record deleted'));
            }
            catch (Exception $e) // in case of exception
            {
                // shows the exception error message
                new TMessage('error', $e->getMessage());
                // undo all pending operations
                TTransaction::rollback();
            }
        }
        else
        {
            // define the delete action
            $action = new TAction(array($this, 'onDelete'));
            $action->setParameters($param); // pass the key paramseter ahead
            $action->setParameter('delete', 1);
            // shows a dialog to the user
            new TQuestion(AdiantiCoreTranslator::translate('Do you really want to delete ?'), $action);   
        }
    }

    public function onExportCsv($param = null) 
    {
        try
        {
            $output = 'app/output/'.uniqid().'.csv';

            if ( (!file_exists($output) && is_writable(dirname($output))) OR is_writable($output))
            {
                $this->limit = 0;
                $objects = $this->onReload();

                if ($objects)
                {
                    $handler = fopen($output, 'w');
                    TTransaction::open(self::$database);

                    foreach ($objects as $object)
                    {
                        $row = [];
                        foreach ($this->datagrid->getColumns() as $column)
                        {
                            $column_name = $column->getName();

                            if (isset($object->$column_name))
                            {
                                $row[] = is_scalar($object->$column_name) ? $object->$column_name : '';
                            }
                            else if (method_exists($object, 'render'))
                            {
                                $column_name = (strpos($column_name, '{') === FALSE) ? ( '{' . $column_name . '}') : $column_name;
                                $row[] = $object->render($column_name);
                            }
                        }

                        fputcsv($handler, $row);
                    }

                    fclose($handler);
                    TTransaction::close();
                }
                else
                {
                    throw new Exception(_t('No records found'));
                }

                TPage::openFile($output);
            }
            else
            {
                throw new Exception(_t('Permission denied') . ': ' . $output);
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public function onExportXls($param = null) 
    {
        try
        {
            $output = 'app/output/'.uniqid().'.xls';

            if ( (!file_exists($output) && is_writable(dirname($output))) OR is_writable($output))
            {
                $widths = [];
                $titles = [];

                foreach ($this->datagrid->getColumns() as $column)
                {
                    $titles[] = $column->getLabel();
                    $width    = 100;

                    if (is_null($column->getWidth()))
                    {
                        $width = 100;
                    }
                    else if (strpos($column->getWidth(), '%') !== false)
                    {
                        $width = ((int) $column->getWidth()) * 5;
                    }
                    else if (is_numeric($column->getWidth()))
                    {
                        $width = $column->getWidth();
                    }

                    $widths[] = $width;
                }

                $table = new \TTableWriterXLS($widths);
                $table->addStyle('title',  'Helvetica', '10', 'B', '#ffffff', '#617FC3');
                $table->addStyle('data',   'Helvetica', '10', '',  '#000000', '#FFFFFF', 'LR');

                $table->addRow();

                foreach ($titles as $title)
                {
                    $table->addCell($title, 'center', 'title');
                }

                $this->limit = 0;
                $objects = $this->onReload();

                TTransaction::open(self::$database);
                if ($objects)
                {
                    foreach ($objects as $object)
                    {
                        $table->addRow();
                        foreach ($this->datagrid->getColumns() as $column)
                        {
                            $column_name = $column->getName();
                            $value = '';
                            if (isset($object->$column_name))
                            {
                                $value = is_scalar($object->$column_name) ? $object->$column_name : '';
                            }
                            else if (method_exists($object, 'render'))
                            {
                                $column_name = (strpos($column_name, '{') === FALSE) ? ( '{' . $column_name . '}') : $column_name;
                                $value = $object->render($column_name);
                            }

                            $transformer = $column->getTransformer();
                            if ($transformer)
                            {
                                $value = strip_tags(call_user_func($transformer, $value, $object, null));
                            }

                            $table->addCell($value, 'center', 'data');
                        }
                    }
                }
                $table->save($output);
                TTransaction::close();

                TPage::openFile($output);
            }
            else
            {
                throw new Exception(_t('Permission denied') . ': ' . $output);
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public function onExportPdf($param = null) 
    {
        try
        {
            $output = 'app/output/'.uniqid().'.pdf';

            if ( (!file_exists($output) && is_writable(dirname($output))) OR is_writable($output))
            {
                $this->limit = 0;
                $this->datagrid->prepareForPrinting();
                $this->onReload();

                $html = clone $this->datagrid;
                $contents = file_get_contents('app/resources/styles-print.html') . $html->getContents();

                $dompdf = new \Dompdf\Dompdf;
                $dompdf->loadHtml($contents);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();

                file_put_contents($output, $dompdf->output());

                $window = TWindow::create('PDF', 0.8, 0.8);
                $object = new TElement('object');
                $object->data  = $output;
                $object->type  = 'application/pdf';
                $object->style = "width: 100%; height:calc(100% - 10px)";

                $window->add($object);
                $window->show();
            }
            else
            {
                throw new Exception(_t('Permission denied') . ': ' . $output);
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public function onExportXml($param = null) 
    {
        try
        {
            $output = 'app/output/'.uniqid().'.xml';

            if ( (!file_exists($output) && is_writable(dirname($output))) OR is_writable($output))
            {
                $this->limit = 0;
                $objects = $this->onReload();

                if ($objects)
                {
                    TTransaction::open(self::$database);

                    $dom = new DOMDocument('1.0', 'UTF-8');
                    $dom->{'formatOutput'} = true;
                    $dataset = $dom->appendChild( $dom->createElement('dataset') );

                    foreach ($objects as $object)
                    {
                        $row = $dataset->appendChild( $dom->createElement( self::$activeRecord ) );

                        foreach ($this->datagrid->getColumns() as $column)
                        {
                            $column_name = $column->getName();
                            $column_name_raw = str_replace(['(','{','->', '-','>','}',')', ' '], ['','','_','','','','','_'], $column_name);

                            if (isset($object->$column_name))
                            {
                                $value = is_scalar($object->$column_name) ? $object->$column_name : '';
                                $row->appendChild($dom->createElement($column_name_raw, $value)); 
                            }
                            else if (method_exists($object, 'render'))
                            {
                                $column_name = (strpos($column_name, '{') === FALSE) ? ( '{' . $column_name . '}') : $column_name;
                                $value = $object->render($column_name);
                                $row->appendChild($dom->createElement($column_name_raw, $value));
                            }
                        }
                    }

                    $dom->save($output);

                    TTransaction::close();
                }
                else
                {
                    throw new Exception(_t('No records found'));
                }

                TPage::openFile($output);
            }
            else
            {
                throw new Exception(_t('Permission denied') . ': ' . $output);
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    /**
     * Register the filter in the session
     */
    public function onSearch($param = null)
    {
        $data = $this->form->getData();
        $filters = [];

        TSession::setValue(__CLASS__.'_filter_data', NULL);
        TSession::setValue(__CLASS__.'_filters', NULL);

        if (isset($data->id) AND ( (is_scalar($data->id) AND $data->id !== '') OR (is_array($data->id) AND (!empty($data->id)) )) )
        {

            $filters[] = new TFilter('id', '=', $data->id);// create the filter 
        }

        if (isset($data->number) AND ( (is_scalar($data->number) AND $data->number !== '') OR (is_array($data->number) AND (!empty($data->number)) )) )
        {

            $filters[] = new TFilter('number', 'like', "%{$data->number}%");// create the filter 
        }

        if (isset($data->products_value) AND ( (is_scalar($data->products_value) AND $data->products_value !== '') OR (is_array($data->products_value) AND (!empty($data->products_value)) )) )
        {

            $filters[] = new TFilter('products_value', '=', $data->products_value);// create the filter 
        }

        if (isset($data->payments_value) AND ( (is_scalar($data->payments_value) AND $data->payments_value !== '') OR (is_array($data->payments_value) AND (!empty($data->payments_value)) )) )
        {

            $filters[] = new TFilter('payments_value', '=', $data->payments_value);// create the filter 
        }

        if (isset($data->total_value) AND ( (is_scalar($data->total_value) AND $data->total_value !== '') OR (is_array($data->total_value) AND (!empty($data->total_value)) )) )
        {

            $filters[] = new TFilter('total_value', '=', $data->total_value);// create the filter 
        }

        if (isset($data->sale_date) AND ( (is_scalar($data->sale_date) AND $data->sale_date !== '') OR (is_array($data->sale_date) AND (!empty($data->sale_date)) )) )
        {

            $filters[] = new TFilter('sale_date', '=', $data->sale_date);// create the filter 
        }

        if (isset($data->invoiced) AND ( (is_scalar($data->invoiced) AND $data->invoiced !== '') OR (is_array($data->invoiced) AND (!empty($data->invoiced)) )) )
        {

            $filters[] = new TFilter('invoiced', '=', $data->invoiced);// create the filter 
        }

        if (isset($data->invoice_ambient) AND ( (is_scalar($data->invoice_ambient) AND $data->invoice_ambient !== '') OR (is_array($data->invoice_ambient) AND (!empty($data->invoice_ambient)) )) )
        {

            $filters[] = new TFilter('invoice_ambient', '=', $data->invoice_ambient);// create the filter 
        }

        if (isset($data->discont_value) AND ( (is_scalar($data->discont_value) AND $data->discont_value !== '') OR (is_array($data->discont_value) AND (!empty($data->discont_value)) )) )
        {

            $filters[] = new TFilter('discont_value', '=', $data->discont_value);// create the filter 
        }

        if (isset($data->obs) AND ( (is_scalar($data->obs) AND $data->obs !== '') OR (is_array($data->obs) AND (!empty($data->obs)) )) )
        {

            $filters[] = new TFilter('obs', 'like', "%{$data->obs}%");// create the filter 
        }

        if (isset($data->invoice_number) AND ( (is_scalar($data->invoice_number) AND $data->invoice_number !== '') OR (is_array($data->invoice_number) AND (!empty($data->invoice_number)) )) )
        {

            $filters[] = new TFilter('invoice_number', '=', $data->invoice_number);// create the filter 
        }

        if (isset($data->invoice_serie) AND ( (is_scalar($data->invoice_serie) AND $data->invoice_serie !== '') OR (is_array($data->invoice_serie) AND (!empty($data->invoice_serie)) )) )
        {

            $filters[] = new TFilter('invoice_serie', '=', $data->invoice_serie);// create the filter 
        }

        if (isset($data->invoice_coupon) AND ( (is_scalar($data->invoice_coupon) AND $data->invoice_coupon !== '') OR (is_array($data->invoice_coupon) AND (!empty($data->invoice_coupon)) )) )
        {

            $filters[] = new TFilter('invoice_coupon', 'like', "%{$data->invoice_coupon}%");// create the filter 
        }

        if (isset($data->invoice_xml) AND ( (is_scalar($data->invoice_xml) AND $data->invoice_xml !== '') OR (is_array($data->invoice_xml) AND (!empty($data->invoice_xml)) )) )
        {

            $filters[] = new TFilter('invoice_xml', 'like', "%{$data->invoice_xml}%");// create the filter 
        }

        if (isset($data->payment_method) AND ( (is_scalar($data->payment_method) AND $data->payment_method !== '') OR (is_array($data->payment_method) AND (!empty($data->payment_method)) )) )
        {

            $filters[] = new TFilter('payment_method', '=', $data->payment_method);// create the filter 
        }

        if (isset($data->store) AND ( (is_scalar($data->store) AND $data->store !== '') OR (is_array($data->store) AND (!empty($data->store)) )) )
        {

            $filters[] = new TFilter('store', '=', $data->store);// create the filter 
        }

        if (isset($data->employee_cashier) AND ( (is_scalar($data->employee_cashier) AND $data->employee_cashier !== '') OR (is_array($data->employee_cashier) AND (!empty($data->employee_cashier)) )) )
        {

            $filters[] = new TFilter('employee_cashier', '=', $data->employee_cashier);// create the filter 
        }

        if (isset($data->cashier) AND ( (is_scalar($data->cashier) AND $data->cashier !== '') OR (is_array($data->cashier) AND (!empty($data->cashier)) )) )
        {

            $filters[] = new TFilter('cashier', '=', $data->cashier);// create the filter 
        }

        if (isset($data->client) AND ( (is_scalar($data->client) AND $data->client !== '') OR (is_array($data->client) AND (!empty($data->client)) )) )
        {

            $filters[] = new TFilter('client', '=', $data->client);// create the filter 
        }

        if (isset($data->salesman) AND ( (is_scalar($data->salesman) AND $data->salesman !== '') OR (is_array($data->salesman) AND (!empty($data->salesman)) )) )
        {

            $filters[] = new TFilter('salesman', '=', $data->salesman);// create the filter 
        }

        if (isset($data->status) AND ( (is_scalar($data->status) AND $data->status !== '') OR (is_array($data->status) AND (!empty($data->status)) )) )
        {

            $filters[] = new TFilter('status', '=', $data->status);// create the filter 
        }

        // fill the form with data again
        $this->form->setData($data);

        // keep the search data in the session
        TSession::setValue(__CLASS__.'_filter_data', $data);
        TSession::setValue(__CLASS__.'_filters', $filters);

        $this->onReload(['offset' => 0, 'first_page' => 1]);
    }

    /**
     * Load the datagrid with data
     */
    public function onReload($param = NULL)
    {
        try
        {
            // open a transaction with database 'pos_sales'
            TTransaction::open(self::$database);

            // creates a repository for Sale
            $repository = new TRepository(self::$activeRecord);

            $criteria = clone $this->filter_criteria;

            if (empty($param['order']))
            {
                $param['order'] = 'id';    
            }

            if (empty($param['direction']))
            {
                $param['direction'] = 'desc';
            }

            $criteria->setProperties($param); // order, offset
            $criteria->setProperty('limit', $this->limit);

            if($filters = TSession::getValue(__CLASS__.'_filters'))
            {
                foreach ($filters as $filter) 
                {
                    $criteria->add($filter);       
                }
            }

            // load the objects according to criteria
            $objects = $repository->load($criteria, FALSE);

            $this->datagrid->clear();
            if ($objects)
            {
                // iterate the collection of active records
                foreach ($objects as $object)
                {

                    $row = $this->datagrid->addItem($object);
                    $row->id = "row_{$object->id}";

                }
            }

            // reset the criteria for record count
            $criteria->resetProperties();
            $count= $repository->count($criteria);

            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($this->limit); // limit

            // close the transaction
            TTransaction::close();
            $this->loaded = true;

            return $objects;
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }

    public function onShow($param = null)
    {

    }

    /**
     * method show()
     * Shows the page
     */
    public function show()
    {
        // check if the datagrid is already loaded
        if (!$this->loaded AND (!isset($_GET['method']) OR !(in_array($_GET['method'],  $this->showMethods))) )
        {
            if (func_num_args() > 0)
            {
                $this->onReload( func_get_arg(0) );
            }
            else
            {
                $this->onReload();
            }
        }
        parent::show();
    }

}

