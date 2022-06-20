<?php

class PaymentMethod extends TRecord
{
    const TABLENAME  = 'payment_method';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const pix = '1';
    const credit_card = '2';
    const debit_card = '3';
    const store_credit = '4';
    const money = '5';
    const cash_credit_card = '6';

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('method');
        parent::addAttribute('issue');
            
    }

    /**
     * Method getMethodPaymentStores
     */
    public function getMethodPaymentStores()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('method_id', '=', $this->id));
        return MethodPaymentStore::getObjects( $criteria );
    }
    /**
     * Method getClosurePaymentMethodss
     */
    public function getClosurePaymentMethodss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('payment_method', '=', $this->id));
        return ClosurePaymentMethods::getObjects( $criteria );
    }
    /**
     * Method getSales
     */
    public function getSales()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('payment_method', '=', $this->id));
        return Sale::getObjects( $criteria );
    }
    /**
     * Method getSalePayments
     */
    public function getSalePayments()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('payment_method', '=', $this->id));
        return SalePayment::getObjects( $criteria );
    }

    public function set_method_payment_store_method_to_string($method_payment_store_method_to_string)
    {
        if(is_array($method_payment_store_method_to_string))
        {
            $values = PaymentMethod::where('id', 'in', $method_payment_store_method_to_string)->getIndexedArray('id', 'id');
            $this->method_payment_store_method_to_string = implode(', ', $values);
        }
        else
        {
            $this->method_payment_store_method_to_string = $method_payment_store_method_to_string;
        }

        $this->vdata['method_payment_store_method_to_string'] = $this->method_payment_store_method_to_string;
    }

    public function get_method_payment_store_method_to_string()
    {
        if(!empty($this->method_payment_store_method_to_string))
        {
            return $this->method_payment_store_method_to_string;
        }
    
        $values = MethodPaymentStore::where('method_id', '=', $this->id)->getIndexedArray('method_id','{method->id}');
        return implode(', ', $values);
    }

    public function set_method_payment_store_store_to_string($method_payment_store_store_to_string)
    {
        if(is_array($method_payment_store_store_to_string))
        {
            $values = Store::where('id', 'in', $method_payment_store_store_to_string)->getIndexedArray('social_name', 'social_name');
            $this->method_payment_store_store_to_string = implode(', ', $values);
        }
        else
        {
            $this->method_payment_store_store_to_string = $method_payment_store_store_to_string;
        }

        $this->vdata['method_payment_store_store_to_string'] = $this->method_payment_store_store_to_string;
    }

    public function get_method_payment_store_store_to_string()
    {
        if(!empty($this->method_payment_store_store_to_string))
        {
            return $this->method_payment_store_store_to_string;
        }
    
        $values = MethodPaymentStore::where('method_id', '=', $this->id)->getIndexedArray('store_id','{store->social_name}');
        return implode(', ', $values);
    }

    public function set_closure_payment_methods_fk_closure_to_string($closure_payment_methods_fk_closure_to_string)
    {
        if(is_array($closure_payment_methods_fk_closure_to_string))
        {
            $values = Closure::where('id', 'in', $closure_payment_methods_fk_closure_to_string)->getIndexedArray('id', 'id');
            $this->closure_payment_methods_fk_closure_to_string = implode(', ', $values);
        }
        else
        {
            $this->closure_payment_methods_fk_closure_to_string = $closure_payment_methods_fk_closure_to_string;
        }

        $this->vdata['closure_payment_methods_fk_closure_to_string'] = $this->closure_payment_methods_fk_closure_to_string;
    }

    public function get_closure_payment_methods_fk_closure_to_string()
    {
        if(!empty($this->closure_payment_methods_fk_closure_to_string))
        {
            return $this->closure_payment_methods_fk_closure_to_string;
        }
    
        $values = ClosurePaymentMethods::where('payment_method', '=', $this->id)->getIndexedArray('closure','{fk_closure->id}');
        return implode(', ', $values);
    }

    public function set_sale_fk_status_to_string($sale_fk_status_to_string)
    {
        if(is_array($sale_fk_status_to_string))
        {
            $values = Status::where('id', 'in', $sale_fk_status_to_string)->getIndexedArray('id', 'id');
            $this->sale_fk_status_to_string = implode(', ', $values);
        }
        else
        {
            $this->sale_fk_status_to_string = $sale_fk_status_to_string;
        }

        $this->vdata['sale_fk_status_to_string'] = $this->sale_fk_status_to_string;
    }

    public function get_sale_fk_status_to_string()
    {
        if(!empty($this->sale_fk_status_to_string))
        {
            return $this->sale_fk_status_to_string;
        }
    
        $values = Sale::where('payment_method', '=', $this->id)->getIndexedArray('status','{fk_status->id}');
        return implode(', ', $values);
    }

    public function set_sale_payment_fk_sale_to_string($sale_payment_fk_sale_to_string)
    {
        if(is_array($sale_payment_fk_sale_to_string))
        {
            $values = Sale::where('id', 'in', $sale_payment_fk_sale_to_string)->getIndexedArray('id', 'id');
            $this->sale_payment_fk_sale_to_string = implode(', ', $values);
        }
        else
        {
            $this->sale_payment_fk_sale_to_string = $sale_payment_fk_sale_to_string;
        }

        $this->vdata['sale_payment_fk_sale_to_string'] = $this->sale_payment_fk_sale_to_string;
    }

    public function get_sale_payment_fk_sale_to_string()
    {
        if(!empty($this->sale_payment_fk_sale_to_string))
        {
            return $this->sale_payment_fk_sale_to_string;
        }
    
        $values = SalePayment::where('payment_method', '=', $this->id)->getIndexedArray('sale','{fk_sale->id}');
        return implode(', ', $values);
    }

    
}

