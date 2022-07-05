<?php

class importControl extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = '';
    private static $activeRecord = '';
    private static $primaryKey = '';
    private static $formName = 'form_importControl';

    use Adianti\Base\AdiantiFileSaveTrait;

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
        $this->form->setFormTitle("Importador");


        $Provider = new TFile('Provider');
        $button_importar = new TButton('button_importar');
        $button_exportar = new TButton('button_exportar');
        $Brand = new TFile('Brand');
        $button_importar1 = new TButton('button_importar1');
        $button_exportar1 = new TButton('button_exportar1');
        $Cest = new TFile('Cest');
        $button_importar2 = new TButton('button_importar2');
        $button_exportar2 = new TButton('button_exportar2');
        $Ncm = new TFile('Ncm');
        $button_importar3 = new TButton('button_importar3');
        $button_exportar3 = new TButton('button_exportar3');
        $Category = new TFile('Category');
        $button_importar4 = new TButton('button_importar4');
        $button_exportar4 = new TButton('button_exportar4');
        $ProductStatus = new TFile('ProductStatus');
        $button_importar5 = new TButton('button_importar5');
        $button_exportar5 = new TButton('button_exportar5');
        $ProductType = new TFile('ProductType');
        $button_importar6 = new TButton('button_importar6');
        $button_exportar6 = new TButton('button_exportar6');
        $StoreGroup = new TFile('StoreGroup');
        $button_importar7 = new TButton('button_importar7');
        $button_exportar7 = new TButton('button_exportar7');
        $Product = new TFile('Product');
        $button_importar8 = new TButton('button_importar8');
        $button_exportar8 = new TButton('button_exportar8');
        $Store = new TFile('Store');
        $button_importar9 = new TButton('button_importar9');
        $button_exportar9 = new TButton('button_exportar9');
        $PriceList = new TFile('PriceList');
        $button_importar10 = new TButton('button_importar10');
        $button_exportar10 = new TButton('button_exportar10');
        $Price = new TFile('Price');
        $button_importar11 = new TButton('button_importar11');
        $button_exportar11 = new TButton('button_exportar11');
        $Deposit = new TFile('Deposit');
        $button_importar12 = new TButton('button_importar12');
        $button_exportar12 = new TButton('button_exportar12');
        $ProductStorage = new TFile('ProductStorage');
        $button_importar13 = new TButton('button_importar13');
        $button_exportar13 = new TButton('button_exportar13');
        $ProductTranfer = new TFile('ProductTranfer');
        $button_importar14 = new TButton('button_importar14');
        $button_exportar14 = new TButton('button_exportar14');


        $Product->setAllowedExtensions(["csv"]);
        $Ncm->setSize('100%');
        $Cest->setSize('100%');
        $Brand->setSize('100%');
        $Store->setSize('100%');
        $Price->setSize('100%');
        $Product->setSize('100%');
        $Deposit->setSize('100%');
        $Provider->setSize('100%');
        $Category->setSize('100%');
        $PriceList->setSize('100%');
        $StoreGroup->setSize('100%');
        $ProductType->setSize('100%');
        $ProductStatus->setSize('100%');
        $ProductStorage->setSize('100%');
        $ProductTranfer->setSize('100%');

        $Ncm->enableFileHandling();
        $Cest->enableFileHandling();
        $Brand->enableFileHandling();
        $Store->enableFileHandling();
        $Price->enableFileHandling();
        $Product->enableFileHandling();
        $Deposit->enableFileHandling();
        $Provider->enableFileHandling();
        $Category->enableFileHandling();
        $PriceList->enableFileHandling();
        $StoreGroup->enableFileHandling();
        $ProductType->enableFileHandling();
        $ProductStatus->enableFileHandling();
        $ProductStorage->enableFileHandling();
        $ProductTranfer->enableFileHandling();

        $button_importar3->setAction(new TAction([$this, 'onNcmImport']), "importar");
        $button_exportar3->setAction(new TAction([$this, 'onNcmExport']), "exportar");
        $button_importar2->setAction(new TAction([$this, 'onCestImport']), "importar");
        $button_exportar2->setAction(new TAction([$this, 'onCestExport']), "exportar");
        $button_importar9->setAction(new TAction([$this, 'onStoreImport']), "importar");
        $button_importar1->setAction(new TAction([$this, 'onBrandImport']), "importar");
        $button_exportar1->setAction(new TAction([$this, 'onBrandExport']), "exportar");
        $button_exportar9->setAction(new TAction([$this, 'onStoreExport']), "exportar");
        $button_importar11->setAction(new TAction([$this, 'onPriceImport']), "importar");
        $button_exportar11->setAction(new TAction([$this, 'onPriceExport']), "exportar");
        $button_exportar8->setAction(new TAction([$this, 'onProductExport']), "Exportar");
        $button_importar8->setAction(new TAction([$this, 'onProductImport']), "Importar");
        $button_exportar->setAction(new TAction([$this, 'onProviderExport']), "exportar");
        $button_importar->setAction(new TAction([$this, 'onProviderImport']), "importar");
        $button_exportar12->setAction(new TAction([$this, 'onDepositExport']), "exportar");
        $button_importar12->setAction(new TAction([$this, 'onDepositImport']), "importar");
        $button_importar4->setAction(new TAction([$this, 'onCategoryImport']), "importar");
        $button_exportar4->setAction(new TAction([$this, 'onCategoryExport']), "exportar");
        $button_exportar10->setAction(new TAction([$this, 'onPriceListExport']), "exportar");
        $button_exportar7->setAction(new TAction([$this, 'onStoreGroupExport']), "exportar");
        $button_importar10->setAction(new TAction([$this, 'onPriceListImport']), "importar");
        $button_importar7->setAction(new TAction([$this, 'onStoreGroupImport']), "importar");
        $button_exportar6->setAction(new TAction([$this, 'onProductTypeExport']), "exportar");
        $button_importar6->setAction(new TAction([$this, 'onProductTypeImport']), "importar");
        $button_exportar5->setAction(new TAction([$this, 'onProductStatusExport']), "exportar");
        $button_importar5->setAction(new TAction([$this, 'onProductStatusImport']), "importar");
        $button_importar13->setAction(new TAction([$this, 'onProductStorageImport']), "importar");
        $button_exportar13->setAction(new TAction([$this, 'onProductStorageExport']), "exportar");
        $button_importar14->setAction(new TAction([$this, 'onProductTransferImport']), "importar");
        $button_exportar14->setAction(new TAction([$this, 'onProductTransferExport']), "exportar");

        $button_exportar->addStyleClass('btn-default');
        $button_importar->addStyleClass('btn-default');
        $button_exportar5->addStyleClass('btn-default');
        $button_exportar9->addStyleClass('btn-default');
        $button_importar9->addStyleClass('btn-default');
        $button_exportar8->addStyleClass('btn-default');
        $button_importar8->addStyleClass('btn-default');
        $button_importar7->addStyleClass('btn-default');
        $button_exportar6->addStyleClass('btn-default');
        $button_importar6->addStyleClass('btn-default');
        $button_exportar7->addStyleClass('btn-default');
        $button_importar5->addStyleClass('btn-default');
        $button_importar4->addStyleClass('btn-default');
        $button_exportar3->addStyleClass('btn-default');
        $button_importar3->addStyleClass('btn-default');
        $button_exportar2->addStyleClass('btn-default');
        $button_importar2->addStyleClass('btn-default');
        $button_exportar1->addStyleClass('btn-default');
        $button_importar1->addStyleClass('btn-default');
        $button_exportar4->addStyleClass('btn-default');
        $button_exportar12->addStyleClass('btn-default');
        $button_importar14->addStyleClass('btn-default');
        $button_exportar13->addStyleClass('btn-default');
        $button_importar13->addStyleClass('btn-default');
        $button_importar10->addStyleClass('btn-default');
        $button_importar12->addStyleClass('btn-default');
        $button_exportar11->addStyleClass('btn-default');
        $button_importar11->addStyleClass('btn-default');
        $button_exportar10->addStyleClass('btn-default');
        $button_exportar14->addStyleClass('btn-default');

        $button_exportar->setImage('fas:angle-up #000000');
        $button_exportar7->setImage('fas:angle-up #000000');
        $button_exportar1->setImage('fas:angle-up #000000');
        $button_exportar2->setImage('fas:angle-up #000000');
        $button_exportar3->setImage('fas:angle-up #000000');
        $button_exportar4->setImage('fas:angle-up #000000');
        $button_exportar9->setImage('fas:angle-up #000000');
        $button_exportar5->setImage('fas:angle-up #000000');
        $button_exportar8->setImage('fas:angle-up #000000');
        $button_exportar6->setImage('fas:angle-up #000000');
        $button_exportar13->setImage('fas:angle-up #000000');
        $button_exportar12->setImage('fas:angle-up #000000');
        $button_exportar11->setImage('fas:angle-up #000000');
        $button_exportar10->setImage('fas:angle-up #000000');
        $button_importar->setImage('fas:angle-down #000000');
        $button_exportar14->setImage('fas:angle-up #000000');
        $button_importar7->setImage('fas:angle-down #000000');
        $button_importar8->setImage('fas:angle-down #000000');
        $button_importar6->setImage('fas:angle-down #000000');
        $button_importar9->setImage('fas:angle-down #000000');
        $button_importar5->setImage('fas:angle-down #000000');
        $button_importar4->setImage('fas:angle-down #000000');
        $button_importar3->setImage('fas:angle-down #000000');
        $button_importar2->setImage('fas:angle-down #000000');
        $button_importar1->setImage('fas:angle-down #000000');
        $button_importar10->setImage('fas:angle-down #000000');
        $button_importar11->setImage('fas:angle-down #000000');
        $button_importar12->setImage('fas:angle-down #000000');
        $button_importar13->setImage('fas:angle-down #000000');
        $button_importar14->setImage('fas:angle-down #000000');





        $this->form->appendPage("EM ORDEM:");

        $this->form->addFields([new THidden('current_tab')]);
        $this->form->setTabFunction("$('[name=current_tab]').val($(this).attr('data-current_page'));");

        $row1 = $this->form->addFields([new TLabel("Fornecedores:", null, '14px', null, '100%')],[$Provider],[$button_importar],[$button_exportar]);
        $row1->layout = [' col-sm-6 col-lg-2','col-sm-6','col-sm-2','col-sm-2'];

        $row2 = $this->form->addFields([new TLabel("Marcas", null, '14px', null, '100%')],[$Brand],[$button_importar1],[$button_exportar1]);
        $row2->layout = [' col-sm-6 col-lg-2','col-sm-6','col-sm-2','col-sm-2'];

        $row3 = $this->form->addFields([new TLabel("Cest:", null, '14px', null, '100%')],[$Cest],[$button_importar2],[$button_exportar2]);
        $row3->layout = [' col-sm-6 col-lg-2','col-sm-6','col-sm-2','col-sm-2'];

        $row4 = $this->form->addFields([new TLabel("Ncm:", null, '14px', null, '100%')],[$Ncm],[$button_importar3],[$button_exportar3]);
        $row4->layout = [' col-sm-6 col-lg-2','col-sm-6','col-sm-2','col-sm-2'];

        $row5 = $this->form->addFields([new TLabel("Categorias produto:", null, '14px', null, '100%')],[$Category],[$button_importar4],[$button_exportar4]);
        $row5->layout = [' col-sm-6 col-lg-2','col-sm-6','col-sm-2','col-sm-2'];

        $row6 = $this->form->addFields([new TLabel("Status produto:", '#F44336', '14px', null, '100%')],[$ProductStatus],[$button_importar5],[$button_exportar5]);
        $row6->layout = [' col-sm-6 col-lg-2','col-sm-6','col-sm-2','col-sm-2'];

        $row7 = $this->form->addFields([new TLabel("Tipo produto:", '#F44336', '14px', null, '100%')],[$ProductType],[$button_importar6],[$button_exportar6]);
        $row7->layout = [' col-sm-6 col-lg-2','col-sm-6','col-sm-2','col-sm-2'];

        $row8 = $this->form->addFields([new TLabel("Grupo Lojas:", '#F44336', '14px', null, '100%')],[$StoreGroup],[$button_importar7],[$button_exportar7]);
        $row8->layout = [' col-sm-6 col-lg-2','col-sm-6','col-sm-2','col-sm-2'];

        $row9 = $this->form->addFields([new TLabel("Produto:", null, '14px', null, '100%')],[$Product],[$button_importar8],[$button_exportar8]);
        $row9->layout = [' col-sm-6 col-lg-2','col-sm-6','col-sm-2','col-sm-2'];

        $row10 = $this->form->addFields([new TLabel("Loja:", null, '14px', null, '100%')],[$Store],[$button_importar9],[$button_exportar9]);
        $row10->layout = [' col-sm-6 col-lg-2','col-sm-6','col-sm-2','col-sm-2'];

        $row11 = $this->form->addFields([new TLabel("Lista de preço:", '#F44336', '14px', null, '100%')],[$PriceList],[$button_importar10],[$button_exportar10]);
        $row11->layout = [' col-sm-6 col-lg-2','col-sm-6','col-sm-2','col-sm-2'];

        $row12 = $this->form->addFields([new TLabel("Preço produto:", null, '14px', null, '100%')],[$Price],[$button_importar11],[$button_exportar11]);
        $row12->layout = [' col-sm-6 col-lg-2','col-sm-6','col-sm-2','col-sm-2'];

        $row13 = $this->form->addFields([new TLabel("Depósito:", '#000000', '14px', null, '100%')],[$Deposit],[$button_importar12],[$button_exportar12]);
        $row13->layout = [' col-sm-6 col-lg-2','col-sm-6','col-sm-2','col-sm-2'];

        $row14 = $this->form->addFields([new TLabel("Estoque:", '#000000', '14px', null, '100%')],[$ProductStorage],[$button_importar13],[$button_exportar13]);
        $row14->layout = [' col-sm-6 col-lg-2','col-sm-6','col-sm-2','col-sm-2'];

        $row15 = $this->form->addFields([new TLabel("Transferência produto:", '#F44336', '14px', null)],[$ProductTranfer],[$button_importar14],[$button_exportar14]);
        $row15->layout = [' col-sm-6 col-lg-2','col-sm-6','col-sm-2','col-sm-2'];

        // create the form actions

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Sistema","Importador"]));
        }
        $container->add($this->form);

        parent::add($container);

    }

    public  function onProviderImport($param = null) 
    {
        try 
        {
            $Tfile              = 'Provider';
            $fileName           = json_decode(urldecode($param[$Tfile]))->fileName;
            $handle             = fopen($fileName, "r");
            $count              = 0;
            $separador          = ';';
            $limite_da_linha    = 0;
            $to_remove          = array("\n","   ","<br>","\r","/\s/");
            ini_set('max_execution_time', 0);

            while (($value = fgetcsv($handle, $limite_da_linha, $separador)) !== FALSE)
            {

                TTransaction::open('pos_product');
                    $object                     = new Provider();//---------------
                    $object->id                 = $value[0];
                    $object->social_name        = $value[1];
                    $object->fantasy_name       = $value[2];
                    $object->cnpj               = $value[3];
                    $object->store();
                    $count++;
                TTransaction::close();
            }

            fclose($handle);
            $this->form->setData($this->form->getData());
            new TMessage('info', "{$count} {$Tfile} foram importados!");

        }
        catch (Exception $e) 
        {
            $this->form->setData($this->form->getData());
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onProviderExport($param = null) 
    {
        try 
        {
            TTransaction::open('pos_product');
            $objects                = Provider::getObjects();
            $class                  = "Provider";
            self::exportarCsv($objects,$class);
            TTransaction::close();

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onBrandImport($param = null) 
    {
        try 
        {
            $Tfile              = 'Brand';
            $fileName           = json_decode(urldecode($param[$Tfile]))->fileName;
            $handle             = fopen($fileName, "r");
            $count              = 0;
            $separador          = ';';
            $limite_da_linha    = 0;
            $to_remove          = array("\n","   ","<br>","\r","/\s/");
            ini_set('max_execution_time', 0);

            while (($value = fgetcsv($handle, $limite_da_linha, $separador)) !== FALSE)
            {

                TTransaction::open('pos_product');
                    $object                     = new Brand();//---------------
                    $object->id                 = $value[0];
                    $object->name               = $value[1];
                    $object->provider           = $value[2];
                    $object->store();
                    $count++;
                TTransaction::close();
            }

            fclose($handle);
            $this->form->setData($this->form->getData());
            new TMessage('info', "{$count} {$Tfile} foram importados!");

        }
        catch (Exception $e) 
        {
            $this->form->setData($this->form->getData());
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onBrandExport($param = null) 
    {
        try 
        {
            TTransaction::open('pos_product');
            $objects                = Brand::getObjects();
            $class                  = "Brand";
            self::exportarCsv($objects,$class);
            TTransaction::close();

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onCestImport($param = null) 
    {
        try 
        {
            $Tfile              = 'Cest';
            $fileName           = json_decode(urldecode($param[$Tfile]))->fileName;
            $handle             = fopen($fileName, "r");
            $count              = 0;
            $separador          = ';';
            $limite_da_linha    = 0;
            $to_remove          = array("\n","   ","<br>","\r","/\s/");
            ini_set('max_execution_time', 0);

            while (($value = fgetcsv($handle, $limite_da_linha, $separador)) !== FALSE)
            {

                TTransaction::open('pos_product');
                    $object                     = new Cest();//---------------
                    $object->id                 = $value[0];
                    $object->number             = preg_replace("/[^0-9]/", "",$value[1]);
                    $object->description        = mb_strtolower($value[2]);
                    $object->store();
                    $count++;
                TTransaction::close();
            }

            fclose($handle);
            $this->form->setData($this->form->getData());
            new TMessage('info', "{$count} {$Tfile} foram importados!");

        }
        catch (Exception $e) 
        {
            $this->form->setData($this->form->getData());
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onCestExport($param = null) 
    {
        try 
        {
            TTransaction::open('pos_product');
            $objects                = Cest::getObjects();
            $class                  = "Cest";
            self::exportarCsv($objects,$class);
            TTransaction::close();

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onNcmImport($param = null) 
    {
        try 
        {
           $Tfile              = 'Ncm';
            $fileName           = json_decode(urldecode($param[$Tfile]))->fileName;
            $handle             = fopen($fileName, "r");
            $count              = 0;
            $separador          = ';';
            $limite_da_linha    = 0;
            $to_remove          = array("\n","   ","<br>","\r","/\s/");
            ini_set('max_execution_time', 0);

            while (($value = fgetcsv($handle, $limite_da_linha, $separador)) !== FALSE)
            {

                TTransaction::open('pos_product');
                if($value[1] != ''){
                    $ncm                        = Ncm::where('number','=',$value[1])->first();
                    if($ncm){
                        $cestNcm                = CestNcm::where('cest','=',$value[2])
                                                         ->where('ncm','=',$ncm->id)
                                                         ->first();
                        if(!$cestNcm){
                            $cestNcm                = new CestNcm();
                            $cestNcm->cest          = $value[2];
                            $cestNcm->ncm           = $ncm->id;
                            $cestNcm->store();
                        }
                    }else{
                        $ncm                    = new Ncm();
                        $ncm->description       = ' - ';
                        $ncm->number            = preg_replace("/[^0-9]/", "",$value[1]);
                        $ncm->store();
                        $cestNcm                = new CestNcm();
                        $cestNcm->cest          = $value[2];
                        $cestNcm->ncm           = $ncm->id;
                        $cestNcm->store();
                    }
                }
                $count++;
                TTransaction::close();
            }

            fclose($handle);
            $this->form->setData($this->form->getData());
            new TMessage('info', "{$count} {$Tfile} foram importados!");

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onNcmExport($param = null) 
    {
        try 
        {
            TTransaction::open('pos_product');
            $objects                = Ncm::getObjects();
            $class                  = "Ncm";
            self::exportarCsv($objects,$class);
            TTransaction::close();

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onCategoryImport($param = null) 
    {
        try 
        {
            $Tfile              = 'Category';
            $fileName           = json_decode(urldecode($param[$Tfile]))->fileName;
            $handle             = fopen($fileName, "r");
            $count              = 0;
            $separador          = ';';
            $limite_da_linha    = 0;
            $to_remove          = array("\n","   ","<br>","\r","/\s/");
            ini_set('max_execution_time', 0);

            while (($value = fgetcsv($handle, $limite_da_linha, $separador)) !== FALSE)
            {

                TTransaction::open('pos_product');
                    $object                     = new Category();//---------------
                    $object->id                 = $value[0];
                    $object->name               = $value[1];
                    $object->color              = '#FD03BE';
                    $object->multiply           = 1.00;
                    $object->icon_category      = null;
                    $object->cest_ncm_default   = 1;
                    $object->store();
                    $count++;
                TTransaction::close();
            }

            fclose($handle);
            $this->form->setData($this->form->getData());
            new TMessage('info', "{$count} {$Tfile} foram importados!");

        }
        catch (Exception $e) 
        {
            $this->form->setData($this->form->getData());
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onCategoryExport($param = null) 
    {
        try 
        {
            TTransaction::open('pos_product');
            $objects                = Category::getObjects();
            $class                  = "Category";
            self::exportarCsv($objects,$class);
            TTransaction::close();

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onProductStatusImport($param = null) 
    {
        try 
        {
            //code here

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onProductStatusExport($param = null) 
    {
        try 
        {
            TTransaction::open('pos_product');
            $objects                = ProductStatus::getObjects();
            $class                  = "ProductStatus";
            self::exportarCsv($objects,$class);
            TTransaction::close();

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onProductTypeImport($param = null) 
    {
        try 
        {
            //code here

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onProductTypeExport($param = null) 
    {
        try 
        {
            TTransaction::open('pos_product');
            $objects                = ProductType::getObjects();
            $class                  = "ProductType";
            self::exportarCsv($objects,$class);
            TTransaction::close();

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onStoreGroupImport($param = null) 
    {
        try 
        {
            //code here

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onStoreGroupExport($param = null) 
    {
        try 
        {
            //code here

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onProductImport($param = null) 
    {
        try 
        {
           $Tfile              = 'Product';
            $fileName           = json_decode(urldecode($param[$Tfile]))->fileName;
            $handle             = fopen($fileName, "r");
            $count              = 0;
            $separador          = ';';
            $limite_da_linha    = 0;
            $to_remove          = array("\n","   ","<br>","\r","/\s/");
            ini_set('max_execution_time', 0);

            while (($value = fgetcsv($handle, $limite_da_linha, $separador)) !== FALSE)
            {

                TTransaction::open('pos_product');
                    $object                     = new Product();//---------------
                    $object->id                 = $value[0]; 
                    $object->description        = $value[4]; 
                    $object->sku                = isset($value[8]) && $value[8]!= "" ? $value[8] : $value[7]; 
                    $object->unity              = 'UN'; 
                    $object->dt_created         = $value[6]; 
                    $object->dt_modify          = date('Y-m-d H:i:00'); 
                    $object->description_variation = $value[5]; 
                    $object->reference          = $value[16]; 
                    //$object->barcode            = $value[8]; 
                    $object->family_id          = $value[18]; 
                    $object->obs                = $value[9]; 
                    $object->website            = $value[31]; 
                    $object->origin             = $value[30] == null || $value[30] == "" ? 0 : $value[30]; 
                    $object->tribute_situation  = $value[25] == null || $value[30] == "" ? 102 :$value[25]; 
                    $object->cfop               = $object->tribute_situation == 500 ? 5405 : 5102;
                    $object->cest               = $value[28]; 
                    $object->ncm                = $value[27]; 
                    $object->is_variation       = $value[21]==1 ? 0 : 1; 
                    $object->cest_ncm           = null; 
                    $object->provider           = $value[3]; 
                    $object->brand              = $value[15]; 
                    $object->type               = $value[18]; 
                    $object->status             = $value[32]=="correto"? 1 : 2; 
                    $object->category           = $value[2]; 
                    $object->store();
                    $count++;
                TTransaction::close();
            }

            fclose($handle);
            $this->form->setData($this->form->getData());
            new TMessage('info', "{$count} {$Tfile} foram importados!");

        }
        catch (Exception $e) 
        {
            $this->form->setData($this->form->getData());
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onProductExport($param = null) 
    {
        try 
        {
            TTransaction::open('pos_product');
            $objects                = Product::getObjects();
            $class                  = "Product";
            self::exportarCsv($objects,$class);
            TTransaction::close();

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onStoreImport($param = null) 
    {
        try 
        {
            $Tfile              = 'Store';
            $fileName           = json_decode(urldecode($param[$Tfile]))->fileName;
            $handle             = fopen($fileName, "r");
            $count              = 0;
            $separador          = ';';
            $limite_da_linha    = 0;
            $to_remove          = array("\n","   ","<br>","\r","/\s/",'Fashion','Biju');
            ini_set('max_execution_time', 0);
            $storeGroup         = [7=>2, 4=>4, 1=>1, 6=>1, 5=>3, 3=>5, 2=>6];
            while (($value = fgetcsv($handle, $limite_da_linha, $separador)) !== FALSE)
            {
                if(!$value[10]==''){
                TTransaction::open('pos_system');
                    $object                                 = new Store();//---------------
                    $object->id                             = $value[0];
                    $object->social_name                    = $value[1];
                    $object->abbreviation                   = $value[2];
                    $object->cnpj                           = preg_replace("/[^0-9]/", "",$value[4]);
                    $object->dt_create                      = $value[15];
                    $object->fantasy_name                   = str_replace($to_remove,"",$value[3]);
                    $object->icon_url                       = null;
                    $object->email                          = $value[8];
                    $object->fone                           = $value[7];
                    $object->cep                            = $value[10];
                    $object->city                           = null;
                    $object->address_complement             = $value[14];
                    $object->address_number                 = $value[12];
                    $object->neighborhood                   = $value[13];
                    $object->street                         = $value[11];
                    $object->obs                            = $value[6];
                    $object->invoice_type                   = $value[21] == 1? 0 : 1;
                    $object->state_inscription              = $value[16];
                    $object->municipal_inscription          = $value[18];
                    $object->icms                           = $value[17];
                    $object->tax_regime                     = $value[19];
                    $object->invoice_provider_id            = $value[25];
                    $object->production_csc_number          = $value[26];
                    $object->production_csc_id              = $value[27];
                    $object->production_invoice_serie       = $value[28];
                    $object->production_invoice_sequence    = $value[29];
                    $object->homologation_csc_number        = $value[30];
                    $object->homologation_csc_id            = $value[31];
                    $object->homologation_invoice_serie     = $value[32];
                    $object->homologation_invoice_sequence  = $value[33];
                    $object->certificate_password           = $value[34];
                    $object->certificate_validate           = null;
                    $object->store_group                    = $storeGroup[$value[5]];
                    $object->store();
                    $count++;
                    //create cashiers for this store
                    $addCashierQtd = 3;
                    for($i=1;$i<=$addCashierQtd;$i++){
                        $cashier                = new Cashier();
                        $cashier->name          = "$object->fantasy_name Caixa $i";
                        $cashier->cashier_type  = 0;
                        $cashier->store         = $object->id;
                        $cashier->store();
                    }
                TTransaction::close();
                //create a price list for this store
                TTransaction::open('pos_product');
                $priceList  = PriceList::where('store','=',$object->id)->first();
                if(!$priceList){
                    $priceList          = new PriceList();
                    $priceList->name    = "Tabela Preço $object->fantasy_name";
                    $priceList->store   = $object->id;
                    $priceList->store();
                }

                TTransaction::close();
                }
            }

            fclose($handle);
            $this->form->setData($this->form->getData());
            new TMessage('info', "{$count} {$Tfile} foram importados!");

        }
        catch (Exception $e) 
        {
            $this->form->setData($this->form->getData());
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onStoreExport($param = null) 
    {
        try 
        {
            TTransaction::open('pos_system');
            $objects                = Store::getObjects();
            $class                  = "Store";
            self::exportarCsv($objects,$class);
            TTransaction::close();

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onPriceListImport($param = null) 
    {
        try 
        {
            $Tfile              = 'PriceList';
            $fileName           = json_decode(urldecode($param[$Tfile]))->fileName;
            $handle             = fopen($fileName, "r");
            $count              = 0;
            $separador          = ';';
            $limite_da_linha    = 0;
            $to_remove          = array("\n","   ","<br>","\r","/\s/");
            ini_set('max_execution_time', 0);

            while (($value = fgetcsv($handle, $limite_da_linha, $separador)) !== FALSE)
            {

                TTransaction::open('pos_product');
                    $object                     = new PriceList();//---------------
                    $object->id                 = $value[0]; 
                    $object->name               = $value[2]; 
                    $object->store();
                    $count++;
                TTransaction::close();
            }

            fclose($handle);
            $this->form->setData($this->form->getData());
            new TMessage('info', "{$count} {$Tfile} foram importados!");

        }
        catch (Exception $e) 
        {
            $this->form->setData($this->form->getData());
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onPriceListExport($param = null) 
    {
        try 
        {
            TTransaction::open('pos_product');
            $objects                = PriceList::getObjects();
            $class                  = "PriceList";
            self::exportarCsv($objects,$class);
            TTransaction::close();

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onPriceImport($param = null) 
    {
        try 
        {
            $Tfile              = 'Price';
            $fileName           = json_decode(urldecode($param[$Tfile]))->fileName;
            $handle             = fopen($fileName, "r");
            $count              = 0;
            $separador          = ';';
            $limite_da_linha    = 0;
            $to_remove          = array("\n","   ","<br>","\r","/\s/");
            ini_set('max_execution_time', 0);
            $promoStore = [23,21,15,7,13,1,17,5,20,19];
            $priceLists = [];
            TTransaction::open('pos_product');
            foreach($promoStore as $idStore){
                $priceList      = PriceList::where('store','=',$idStore)->first();
                $priceLists[]   = intval($priceList->id);
            }

            while (($value = fgetcsv($handle, $limite_da_linha, $separador)) !== FALSE)
            {
                if($value[4] == 1){
                    $object                     = new Price();//---------------
                    $object->sell_price         = $value[1]; 
                    $object->cost_price         = $value[2]; 
                    $object->product            = $value[3]; 
                    $object->price_list         = $value[4]; 
                    $object->store();
                    $count++;
                }else{
                    foreach($priceLists as $idPriceList){
                        $object                     = new Price();//---------------
                        $object->sell_price         = $value[1]; 
                        $object->cost_price         = $value[2]; 
                        $object->product            = $value[3]; 
                        $object->price_list         = $idPriceList;
                        $object->store();
                    }
                    $count++;
                }
            }
            TTransaction::close();

            fclose($handle);
            $this->form->setData($this->form->getData());
            new TMessage('info', "{$count} {$Tfile} foram importados!");

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onPriceExport($param = null) 
    {
        try 
        {
            TTransaction::open('pos_product');
            $objects                = Price::getObjects();
            $class                  = "Price";
            self::exportarCsv($objects,$class);
            TTransaction::close();

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onDepositImport($param = null) 
    {
        try 
        {
            $Tfile              = 'Deposit';
            $fileName           = json_decode(urldecode($param[$Tfile]))->fileName;
            $handle             = fopen($fileName, "r");
            $count              = 0;
            $separador          = ';';
            $limite_da_linha    = 0;
            $to_remove          = array("\n","   ","<br>","\r","/\s/");
            ini_set('max_execution_time', 0);
            $promoStore = [23,21,15,7,13,1,17,5,20,19];
            $priceLists = [];
            TTransaction::open('pos_product');

            while (($value = fgetcsv($handle, $limite_da_linha, $separador)) !== FALSE)
            {
                $object                     = new Deposit();//---------------
                $object->id                 = $value[0]; 
                $object->name               = $value[1]; 
                $object->store              = $value[2]; 
                $object->store();
                $count++;
            }

            TTransaction::close();

            fclose($handle);
            $this->form->setData($this->form->getData());
            new TMessage('info', "{$count} {$Tfile} foram importados!");

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onDepositExport($param = null) 
    {
        try 
        {
            TTransaction::open('pos_product');
            $objects                = Deposit::getObjects();
            $class                  = "Deposit";
            self::exportarCsv($objects,$class);
            TTransaction::close();

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onProductStorageImport($param = null) 
    {
        try 
        {
            $Tfile              = 'ProductStorage';
            $fileName           = json_decode(urldecode($param[$Tfile]))->fileName;
            $handle             = fopen($fileName, "r");
            $count              = 0;
            $separador          = ';';
            $limite_da_linha    = 0;
            $to_remove          = array("\n","   ","<br>","\r","/\s/");
            ini_set('max_execution_time', 0);
            $promoStore = [23,21,15,7,13,1,17,5,20,19];
            $priceLists = [];
            TTransaction::open('pos_product');

            while (($value = fgetcsv($handle, $limite_da_linha, $separador)) !== FALSE)
            {
                $object                     = new ProductStorage();//---------------
                $object->id                 = $value[0]; 
                $object->quantity           = $value[1]; 
                $object->min_storage        = $value[2]; 
                $object->max_storage        = $value[3]; 
                $object->deposit            = $value[4]; 
                $object->product            = $value[5]; 
                $object->store              = null; 
                $object->store();
                $count++;
            }

            TTransaction::close();

            fclose($handle);
            $this->form->setData($this->form->getData());
            new TMessage('info', "{$count} {$Tfile} foram importados!");

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onProductStorageExport($param = null) 
    {
        try 
        {
            TTransaction::open('pos_product');
            $objects                = ProductStorage::getObjects();
            $class                  = "ProductStorage";
            self::exportarCsv($objects,$class);
            TTransaction::close();

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onProductTransferImport($param = null) 
    {
        try 
        {
            //code here

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onProductTransferExport($param = null) 
    {
        try 
        {
            TTransaction::open('pos_product');
            $objects                = ProductTransfer::getObjects();
            $class                  = "ProductTransfer";
            self::exportarCsv($objects,$class);
            TTransaction::close();

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public function onShow($param = null)
    {               

    } 

    public function exportarCsv($objects,$class){
        try{
            set_time_limit(0);
            $class      = isset($class)?$class:"";
            $file       = 'tmp/'.$class.'.csv';
            $to_remove  = array("\n","   ","<br>","\r","/\s/");
            $handle = fopen($file, 'w');
            foreach($objects as $record){
                $csvColumns =[];
                foreach($record as $atributo){
                    $csvColumns[] = str_replace($to_remove,"",$atributo);
                }
                fputcsv($handle, $csvColumns, ';');
            }
                fclose($handle);
                TPage::openFile($file);
                $this->form->setData($this->form->getData());
        }catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
            $this->form->setData($this->form->getData());
        }
    }

}

