<?php

class productsRest extends AdiantiRecordService
{
    const DATABASE      = 'pos_product';
    const ACTIVE_RECORD = 'Product';
    
    public function handle($param)
    {
            $method = strtoupper($_SERVER['REQUEST_METHOD']);
            unset($param['class']);
            unset($param['method']);
            //seletor de redirecionamento de função
            switch($method)
        {
            case 'POST':
                return "indisponível";
                break;
            case 'PUT':
                return "indisponível";
                break;
            case 'GET':
                return self::getProducts($param);
                break;
            default:
                return "indisponível";
        }
    }
    public function getProducts($param){
        try{
            $store_id               = $param['store_id'];
            ttransaction::open(static::DATABASE);
            $products               = Product::getObjects();
            $categorys              = Category::getObjects();
            $priceList              = PriceList::where('store','=',$store_id)->first();
            $return                 = array();
            $categorysArray         = array();
            $productsArray          = array();
            foreach($categorys as $category){
                $categoryArray           = array();
                $categoryArray['id']     = $category->id;
                $categoryArray['name']   = $category->name;
                $categoryArray['color']  = $category->color;
                $categoryArray['icon']   = $category->icon_category;
                $categorysArray[] = $categoryArray;
            }
            var_dump($return);
            $return['category']     = $categorysArray;
            foreach($products as $product){
                $productArray                   = array();
                $productArray['id']             = $product->id;
                $productArray['description']    = $product->description.' '.$product->description_variation.' '.$product->reference;
                $productArray['sku']            = $product->sku;
                $productArray['category']       = $product->category;
                $productArray['website']        = $product->website;
                $brand                          = $product->fk_brand->name;
                $provider                       = $product->fk_provider->social_name;
                $productArray['provider']       = $brand ? $brand : $provider;
                //price
                $price                          = null;
                if($priceList){
                    $price                          = Price::where('price_list','=',$priceList->id)
                                                          ->where('product','=',$product->id)
                                                          ->first();
                    if(!$price){
                        $price                      = Price::where('price_list','=',1)
                                                          ->where('product','=',$product->id)
                                                          ->first();
                    }
                }else{
                    $price                      = Price::where('price_list','=',1)
                                                      ->where('product','=',$product->id)
                                                      ->first();
                    
                }
                $productArray['price']          = $price->sell_price ? $price->sell_price : 0;
                $productsArray[]    = $productArray;
            }
            $return['products']         = $productsArray;
            TTransaction::close();
            return $return;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}
