<?php

class PaymentMethod extends TRecord
{
    const TABLENAME  = 'payment_method';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const pix = '1';
    const credit_card = '2';
    const debit_card = '4';
    const store_credit = '5';
    const money = '6';
    const mix = '7';
    const date_credit_card = '3';
    const wallet_digital = '8';
    const cashback = '9';

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('method');
        parent::addAttribute('alias');
        parent::addAttribute('issue');
            
    }

    /**
     * Method getPaymentMethodStores
     */
    public function getPaymentMethodStores()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('method', '=', $this->id));
        return PaymentMethodStore::getObjects( $criteria );
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

    public function set_payment_method_store_fk_method_to_string($payment_method_store_fk_method_to_string)
    {
        if(is_array($payment_method_store_fk_method_to_string))
        {
            $values = PaymentMethod::where('id', 'in', $payment_method_store_fk_method_to_string)->getIndexedArray('id', 'id');
            $this->payment_method_store_fk_method_to_string = implode(', ', $values);
        }
        else
        {
            $this->payment_method_store_fk_method_to_string = $payment_method_store_fk_method_to_string;
        }

        $this->vdata['payment_method_store_fk_method_to_string'] = $this->payment_method_store_fk_method_to_string;
    }

    public function get_payment_method_store_fk_method_to_string()
    {
        if(!empty($this->payment_method_store_fk_method_to_string))
        {
            return $this->payment_method_store_fk_method_to_string;
        }
    
        $values = PaymentMethodStore::where('method', '=', $this->id)->getIndexedArray('method','{fk_method->id}');
        return implode(', ', $values);
    }

    public function set_payment_method_store_fk_store_to_string($payment_method_store_fk_store_to_string)
    {
        if(is_array($payment_method_store_fk_store_to_string))
        {
            $values = Store::where('id', 'in', $payment_method_store_fk_store_to_string)->getIndexedArray('fantasy_name', 'fantasy_name');
            $this->payment_method_store_fk_store_to_string = implode(', ', $values);
        }
        else
        {
            $this->payment_method_store_fk_store_to_string = $payment_method_store_fk_store_to_string;
        }

        $this->vdata['payment_method_store_fk_store_to_string'] = $this->payment_method_store_fk_store_to_string;
    }

    public function get_payment_method_store_fk_store_to_string()
    {
        if(!empty($this->payment_method_store_fk_store_to_string))
        {
            return $this->payment_method_store_fk_store_to_string;
        }
    
        $values = PaymentMethodStore::where('method', '=', $this->id)->getIndexedArray('store','{fk_store->fantasy_name}');
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

