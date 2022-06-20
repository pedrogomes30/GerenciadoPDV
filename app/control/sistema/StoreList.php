<?php

class StoreList extends TPage
{
    private $form; // form
    private $datagrid; // listing
    private $pageNavigation;
    private $loaded;
    private $filter_criteria;
    private static $database = 'pos_system';
    private static $activeRecord = 'Store';
    private static $primaryKey = 'id';
    private static $formName = 'form_StoreList';
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
        $this->form->setFormTitle("Listagem de lojas");
        $this->limit = 20;

        $id = new TEntry('id');
        $social_name = new TEntry('social_name');
        $abbreviation = new TEntry('abbreviation');
        $cnpj = new TEntry('cnpj');
        $icon_url = new TEntry('icon_url');
        $fantasy_name = new TEntry('fantasy_name');
        $obs = new TEntry('obs');
        $state_inscription = new TEntry('state_inscription');
        $minicipal_inscription = new TEntry('minicipal_inscription');
        $icms = new TEntry('icms');
        $tax_regime = new TEntry('tax_regime');
        $invoice_type = new TEntry('invoice_type');
        $invoice_provider_id = new TEntry('invoice_provider_id');
        $production_csc_number = new TEntry('production_csc_number');
        $production_csc_id = new TEntry('production_csc_id');
        $production_invoice_serie = new TEntry('production_invoice_serie');
        $production_invoice_sequence = new TEntry('production_invoice_sequence');
        $homologation_csc_number = new TEntry('homologation_csc_number');
        $homologation_csc_id = new TEntry('homologation_csc_id');
        $homologation_invoice_serie = new TEntry('homologation_invoice_serie');
        $homologation_invoice_sequence = new TEntry('homologation_invoice_sequence');
        $certificate_password = new TEntry('certificate_password');
        $store_group = new TDBCombo('store_group', 'pos_system', 'GroupStore', 'id', '{name}','name asc'  );


        $store_group->enableSearch();
        $cnpj->setMaxLength(20);
        $obs->setMaxLength(200);
        $icms->setMaxLength(30);
        $icon_url->setMaxLength(255);
        $tax_regime->setMaxLength(5);
        $social_name->setMaxLength(50);
        $abbreviation->setMaxLength(5);
        $fantasy_name->setMaxLength(100);
        $state_inscription->setMaxLength(30);
        $production_csc_id->setMaxLength(50);
        $invoice_provider_id->setMaxLength(50);
        $homologation_csc_id->setMaxLength(50);
        $certificate_password->setMaxLength(50);
        $minicipal_inscription->setMaxLength(30);
        $production_csc_number->setMaxLength(50);
        $homologation_csc_number->setMaxLength(50);

        $id->setSize(100);
        $obs->setSize('100%');
        $icms->setSize('100%');
        $cnpj->setSize('100%');
        $icon_url->setSize('100%');
        $tax_regime->setSize('100%');
        $social_name->setSize('100%');
        $store_group->setSize('100%');
        $fantasy_name->setSize('100%');
        $abbreviation->setSize('100%');
        $invoice_type->setSize('100%');
        $state_inscription->setSize('100%');
        $production_csc_id->setSize('100%');
        $invoice_provider_id->setSize('100%');
        $homologation_csc_id->setSize('100%');
        $certificate_password->setSize('100%');
        $minicipal_inscription->setSize('100%');
        $production_csc_number->setSize('100%');
        $homologation_csc_number->setSize('100%');
        $production_invoice_serie->setSize('100%');
        $homologation_invoice_serie->setSize('100%');
        $production_invoice_sequence->setSize('100%');
        $homologation_invoice_sequence->setSize('100%');




        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Social name:", null, '14px', null, '100%'),$social_name]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Abbreviation:", null, '14px', null, '100%'),$abbreviation],[new TLabel("Cnpj:", null, '14px', null, '100%'),$cnpj]);
        $row2->layout = ['col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([new TLabel("Icon url:", null, '14px', null, '100%'),$icon_url],[new TLabel("Fantasy name:", null, '14px', null, '100%'),$fantasy_name]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        $row4 = $this->form->addFields([new TLabel("Obs:", null, '14px', null, '100%'),$obs],[new TLabel("State inscription:", null, '14px', null, '100%'),$state_inscription]);
        $row4->layout = ['col-sm-6','col-sm-6'];

        $row5 = $this->form->addFields([new TLabel("Minicipal inscription:", null, '14px', null, '100%'),$minicipal_inscription],[new TLabel("Icms:", null, '14px', null, '100%'),$icms]);
        $row5->layout = ['col-sm-6','col-sm-6'];

        $row6 = $this->form->addFields([new TLabel("Tax regime:", null, '14px', null, '100%'),$tax_regime],[new TLabel("Invoice type:", null, '14px', null, '100%'),$invoice_type]);
        $row6->layout = ['col-sm-6','col-sm-6'];

        $row7 = $this->form->addFields([new TLabel("Invoice provider id:", null, '14px', null, '100%'),$invoice_provider_id],[new TLabel("Production csc number:", null, '14px', null, '100%'),$production_csc_number]);
        $row7->layout = ['col-sm-6','col-sm-6'];

        $row8 = $this->form->addFields([new TLabel("Production csc id:", null, '14px', null, '100%'),$production_csc_id],[new TLabel("Production invoice serie:", null, '14px', null, '100%'),$production_invoice_serie]);
        $row8->layout = ['col-sm-6','col-sm-6'];

        $row9 = $this->form->addFields([new TLabel("Production invoice sequence:", null, '14px', null, '100%'),$production_invoice_sequence],[new TLabel("Homologation csc number:", null, '14px', null, '100%'),$homologation_csc_number]);
        $row9->layout = ['col-sm-6','col-sm-6'];

        $row10 = $this->form->addFields([new TLabel("Homologation csc id:", null, '14px', null, '100%'),$homologation_csc_id],[new TLabel("Homologation invoice serie:", null, '14px', null, '100%'),$homologation_invoice_serie]);
        $row10->layout = ['col-sm-6','col-sm-6'];

        $row11 = $this->form->addFields([new TLabel("Homologation invoice sequence:", null, '14px', null, '100%'),$homologation_invoice_sequence],[new TLabel("Certificate password:", null, '14px', null, '100%'),$certificate_password]);
        $row11->layout = ['col-sm-6','col-sm-6'];

        $row12 = $this->form->addFields([new TLabel("Store group:", null, '14px', null, '100%'),$store_group],[]);
        $row12->layout = ['col-sm-6','col-sm-6'];

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $btn_onsearch = $this->form->addAction("Buscar", new TAction([$this, 'onSearch']), 'fas:search #ffffff');
        $this->btn_onsearch = $btn_onsearch;
        $btn_onsearch->addStyleClass('btn-primary'); 

        $btn_onshow = $this->form->addAction("Cadastrar", new TAction(['StoreForm', 'onShow']), 'fas:plus #69aa46');
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
        $column_social_name = new TDataGridColumn('social_name', "Social name", 'left');
        $column_abbreviation = new TDataGridColumn('abbreviation', "Abbreviation", 'left');
        $column_cnpj = new TDataGridColumn('cnpj', "Cnpj", 'left');
        $column_icon_url = new TDataGridColumn('icon_url', "Icon url", 'left');
        $column_fantasy_name = new TDataGridColumn('fantasy_name', "Fantasy name", 'left');
        $column_obs = new TDataGridColumn('obs', "Obs", 'left');
        $column_state_inscription = new TDataGridColumn('state_inscription', "State inscription", 'left');
        $column_minicipal_inscription = new TDataGridColumn('minicipal_inscription', "Minicipal inscription", 'left');
        $column_icms = new TDataGridColumn('icms', "Icms", 'left');
        $column_tax_regime = new TDataGridColumn('tax_regime', "Tax regime", 'left');
        $column_invoice_type = new TDataGridColumn('invoice_type', "Invoice type", 'left');
        $column_invoice_provider_id = new TDataGridColumn('invoice_provider_id', "Invoice provider id", 'left');
        $column_production_csc_number = new TDataGridColumn('production_csc_number', "Production csc number", 'left');
        $column_production_csc_id = new TDataGridColumn('production_csc_id', "Production csc id", 'left');
        $column_production_invoice_serie = new TDataGridColumn('production_invoice_serie', "Production invoice serie", 'left');
        $column_production_invoice_sequence = new TDataGridColumn('production_invoice_sequence', "Production invoice sequence", 'left');
        $column_homologation_csc_number = new TDataGridColumn('homologation_csc_number', "Homologation csc number", 'left');
        $column_homologation_csc_id = new TDataGridColumn('homologation_csc_id', "Homologation csc id", 'left');
        $column_homologation_invoice_serie = new TDataGridColumn('homologation_invoice_serie', "Homologation invoice serie", 'left');
        $column_homologation_invoice_sequence = new TDataGridColumn('homologation_invoice_sequence', "Homologation invoice sequence", 'left');
        $column_certificate_password = new TDataGridColumn('certificate_password', "Certificate password", 'left');
        $column_fk_store_group_name = new TDataGridColumn('fk_store_group->name', "Store group", 'left');

        $order_id = new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', 'id');
        $column_id->setAction($order_id);

        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_social_name);
        $this->datagrid->addColumn($column_abbreviation);
        $this->datagrid->addColumn($column_cnpj);
        $this->datagrid->addColumn($column_icon_url);
        $this->datagrid->addColumn($column_fantasy_name);
        $this->datagrid->addColumn($column_obs);
        $this->datagrid->addColumn($column_state_inscription);
        $this->datagrid->addColumn($column_minicipal_inscription);
        $this->datagrid->addColumn($column_icms);
        $this->datagrid->addColumn($column_tax_regime);
        $this->datagrid->addColumn($column_invoice_type);
        $this->datagrid->addColumn($column_invoice_provider_id);
        $this->datagrid->addColumn($column_production_csc_number);
        $this->datagrid->addColumn($column_production_csc_id);
        $this->datagrid->addColumn($column_production_invoice_serie);
        $this->datagrid->addColumn($column_production_invoice_sequence);
        $this->datagrid->addColumn($column_homologation_csc_number);
        $this->datagrid->addColumn($column_homologation_csc_id);
        $this->datagrid->addColumn($column_homologation_invoice_serie);
        $this->datagrid->addColumn($column_homologation_invoice_sequence);
        $this->datagrid->addColumn($column_certificate_password);
        $this->datagrid->addColumn($column_fk_store_group_name);

        $action_onEdit = new TDataGridAction(array('StoreForm', 'onEdit'));
        $action_onEdit->setUseButton(false);
        $action_onEdit->setButtonClass('btn btn-default btn-sm');
        $action_onEdit->setLabel("Editar");
        $action_onEdit->setImage('far:edit #478fca');
        $action_onEdit->setField(self::$primaryKey);

        $this->datagrid->addAction($action_onEdit);

        $action_onDelete = new TDataGridAction(array('StoreList', 'onDelete'));
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
        $dropdown_button_exportar->addPostAction( "CSV", new TAction(['StoreList', 'onExportCsv'],['static' => 1]), 'datagrid_'.self::$formName, 'fas:file-csv #00b894' );
        $dropdown_button_exportar->addPostAction( "XLS", new TAction(['StoreList', 'onExportXls'],['static' => 1]), 'datagrid_'.self::$formName, 'fas:file-excel #4CAF50' );
        $dropdown_button_exportar->addPostAction( "PDF", new TAction(['StoreList', 'onExportPdf'],['static' => 1]), 'datagrid_'.self::$formName, 'far:file-pdf #e74c3c' );
        $dropdown_button_exportar->addPostAction( "XML", new TAction(['StoreList', 'onExportXml'],['static' => 1]), 'datagrid_'.self::$formName, 'far:file-code #95a5a6' );

        $head_right_actions->add($dropdown_button_exportar);

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Sistema","Lojas"]));
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
                $object = new Store($key, FALSE); 

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

        if (isset($data->social_name) AND ( (is_scalar($data->social_name) AND $data->social_name !== '') OR (is_array($data->social_name) AND (!empty($data->social_name)) )) )
        {

            $filters[] = new TFilter('social_name', 'like', "%{$data->social_name}%");// create the filter 
        }

        if (isset($data->abbreviation) AND ( (is_scalar($data->abbreviation) AND $data->abbreviation !== '') OR (is_array($data->abbreviation) AND (!empty($data->abbreviation)) )) )
        {

            $filters[] = new TFilter('abbreviation', 'like', "%{$data->abbreviation}%");// create the filter 
        }

        if (isset($data->cnpj) AND ( (is_scalar($data->cnpj) AND $data->cnpj !== '') OR (is_array($data->cnpj) AND (!empty($data->cnpj)) )) )
        {

            $filters[] = new TFilter('cnpj', 'like', "%{$data->cnpj}%");// create the filter 
        }

        if (isset($data->icon_url) AND ( (is_scalar($data->icon_url) AND $data->icon_url !== '') OR (is_array($data->icon_url) AND (!empty($data->icon_url)) )) )
        {

            $filters[] = new TFilter('icon_url', 'like', "%{$data->icon_url}%");// create the filter 
        }

        if (isset($data->fantasy_name) AND ( (is_scalar($data->fantasy_name) AND $data->fantasy_name !== '') OR (is_array($data->fantasy_name) AND (!empty($data->fantasy_name)) )) )
        {

            $filters[] = new TFilter('fantasy_name', 'like', "%{$data->fantasy_name}%");// create the filter 
        }

        if (isset($data->obs) AND ( (is_scalar($data->obs) AND $data->obs !== '') OR (is_array($data->obs) AND (!empty($data->obs)) )) )
        {

            $filters[] = new TFilter('obs', 'like', "%{$data->obs}%");// create the filter 
        }

        if (isset($data->state_inscription) AND ( (is_scalar($data->state_inscription) AND $data->state_inscription !== '') OR (is_array($data->state_inscription) AND (!empty($data->state_inscription)) )) )
        {

            $filters[] = new TFilter('state_inscription', 'like', "%{$data->state_inscription}%");// create the filter 
        }

        if (isset($data->minicipal_inscription) AND ( (is_scalar($data->minicipal_inscription) AND $data->minicipal_inscription !== '') OR (is_array($data->minicipal_inscription) AND (!empty($data->minicipal_inscription)) )) )
        {

            $filters[] = new TFilter('minicipal_inscription', 'like', "%{$data->minicipal_inscription}%");// create the filter 
        }

        if (isset($data->icms) AND ( (is_scalar($data->icms) AND $data->icms !== '') OR (is_array($data->icms) AND (!empty($data->icms)) )) )
        {

            $filters[] = new TFilter('icms', 'like', "%{$data->icms}%");// create the filter 
        }

        if (isset($data->tax_regime) AND ( (is_scalar($data->tax_regime) AND $data->tax_regime !== '') OR (is_array($data->tax_regime) AND (!empty($data->tax_regime)) )) )
        {

            $filters[] = new TFilter('tax_regime', 'like', "%{$data->tax_regime}%");// create the filter 
        }

        if (isset($data->invoice_type) AND ( (is_scalar($data->invoice_type) AND $data->invoice_type !== '') OR (is_array($data->invoice_type) AND (!empty($data->invoice_type)) )) )
        {

            $filters[] = new TFilter('invoice_type', '=', $data->invoice_type);// create the filter 
        }

        if (isset($data->invoice_provider_id) AND ( (is_scalar($data->invoice_provider_id) AND $data->invoice_provider_id !== '') OR (is_array($data->invoice_provider_id) AND (!empty($data->invoice_provider_id)) )) )
        {

            $filters[] = new TFilter('invoice_provider_id', 'like', "%{$data->invoice_provider_id}%");// create the filter 
        }

        if (isset($data->production_csc_number) AND ( (is_scalar($data->production_csc_number) AND $data->production_csc_number !== '') OR (is_array($data->production_csc_number) AND (!empty($data->production_csc_number)) )) )
        {

            $filters[] = new TFilter('production_csc_number', 'like', "%{$data->production_csc_number}%");// create the filter 
        }

        if (isset($data->production_csc_id) AND ( (is_scalar($data->production_csc_id) AND $data->production_csc_id !== '') OR (is_array($data->production_csc_id) AND (!empty($data->production_csc_id)) )) )
        {

            $filters[] = new TFilter('production_csc_id', 'like', "%{$data->production_csc_id}%");// create the filter 
        }

        if (isset($data->production_invoice_serie) AND ( (is_scalar($data->production_invoice_serie) AND $data->production_invoice_serie !== '') OR (is_array($data->production_invoice_serie) AND (!empty($data->production_invoice_serie)) )) )
        {

            $filters[] = new TFilter('production_invoice_serie', '=', $data->production_invoice_serie);// create the filter 
        }

        if (isset($data->production_invoice_sequence) AND ( (is_scalar($data->production_invoice_sequence) AND $data->production_invoice_sequence !== '') OR (is_array($data->production_invoice_sequence) AND (!empty($data->production_invoice_sequence)) )) )
        {

            $filters[] = new TFilter('production_invoice_sequence', '=', $data->production_invoice_sequence);// create the filter 
        }

        if (isset($data->homologation_csc_number) AND ( (is_scalar($data->homologation_csc_number) AND $data->homologation_csc_number !== '') OR (is_array($data->homologation_csc_number) AND (!empty($data->homologation_csc_number)) )) )
        {

            $filters[] = new TFilter('homologation_csc_number', 'like', "%{$data->homologation_csc_number}%");// create the filter 
        }

        if (isset($data->homologation_csc_id) AND ( (is_scalar($data->homologation_csc_id) AND $data->homologation_csc_id !== '') OR (is_array($data->homologation_csc_id) AND (!empty($data->homologation_csc_id)) )) )
        {

            $filters[] = new TFilter('homologation_csc_id', 'like', "%{$data->homologation_csc_id}%");// create the filter 
        }

        if (isset($data->homologation_invoice_serie) AND ( (is_scalar($data->homologation_invoice_serie) AND $data->homologation_invoice_serie !== '') OR (is_array($data->homologation_invoice_serie) AND (!empty($data->homologation_invoice_serie)) )) )
        {

            $filters[] = new TFilter('homologation_invoice_serie', '=', $data->homologation_invoice_serie);// create the filter 
        }

        if (isset($data->homologation_invoice_sequence) AND ( (is_scalar($data->homologation_invoice_sequence) AND $data->homologation_invoice_sequence !== '') OR (is_array($data->homologation_invoice_sequence) AND (!empty($data->homologation_invoice_sequence)) )) )
        {

            $filters[] = new TFilter('homologation_invoice_sequence', '=', $data->homologation_invoice_sequence);// create the filter 
        }

        if (isset($data->certificate_password) AND ( (is_scalar($data->certificate_password) AND $data->certificate_password !== '') OR (is_array($data->certificate_password) AND (!empty($data->certificate_password)) )) )
        {

            $filters[] = new TFilter('certificate_password', 'like', "%{$data->certificate_password}%");// create the filter 
        }

        if (isset($data->store_group) AND ( (is_scalar($data->store_group) AND $data->store_group !== '') OR (is_array($data->store_group) AND (!empty($data->store_group)) )) )
        {

            $filters[] = new TFilter('store_group', '=', $data->store_group);// create the filter 
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
            // open a transaction with database 'pos_system'
            TTransaction::open(self::$database);

            // creates a repository for Store
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

