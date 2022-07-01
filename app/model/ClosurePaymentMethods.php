<?php

class ClosurePaymentMethods extends TRecord
{
    const TABLENAME  = 'closure_payment_methods';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_closure;
    private $fk_payment_method;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('closure');
        parent::addAttribute('payment_method');
        parent::addAttribute('value');
            
    }

    /**
     * Method set_closure
     * Sample of usage: $var->closure = $object;
     * @param $object Instance of Closure
     */
    public function set_fk_closure(Closure $object)
    {
        $this->fk_closure = $object;
        $this->closure = $object->id;
    }

    /**
     * Method get_fk_closure
     * Sample of usage: $var->fk_closure->attribute;
     * @returns Closure instance
     */
    public function get_fk_closure()
    {
    
        // loads the associated object
        if (empty($this->fk_closure))
            $this->fk_closure = new Closure($this->closure);
    
        // returns the associated object
        return $this->fk_closure;
    }
    /**
     * Method set_payment_method
     * Sample of usage: $var->payment_method = $object;
     * @param $object Instance of PaymentMethod
     */
    public function set_fk_payment_method(PaymentMethod $object)
    {
        $this->fk_payment_method = $object;
        $this->payment_method = $object->id;
    }

    /**
     * Method get_fk_payment_method
     * Sample of usage: $var->fk_payment_method->attribute;
     * @returns PaymentMethod instance
     */
    public function get_fk_payment_method()
    {
        TTransaction::open('pos_system');
        // loads the associated object
        if (empty($this->fk_payment_method))
            $this->fk_payment_method = new PaymentMethod($this->payment_method);
        TTransaction::close();
        // returns the associated object
        return $this->fk_payment_method;
    }

    /**
     * Method getAdjustClosures
     */
    public function getAdjustClosures()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('cashier_method', '=', $this->id));
        return AdjustClosure::getObjects( $criteria );
    }

    public function set_adjust_closure_fk_closure_to_string($adjust_closure_fk_closure_to_string)
    {
        if(is_array($adjust_closure_fk_closure_to_string))
        {
            $values = Closure::where('id', 'in', $adjust_closure_fk_closure_to_string)->getIndexedArray('id', 'id');
            $this->adjust_closure_fk_closure_to_string = implode(', ', $values);
        }
        else
        {
            $this->adjust_closure_fk_closure_to_string = $adjust_closure_fk_closure_to_string;
        }

        $this->vdata['adjust_closure_fk_closure_to_string'] = $this->adjust_closure_fk_closure_to_string;
    }

    public function get_adjust_closure_fk_closure_to_string()
    {
        if(!empty($this->adjust_closure_fk_closure_to_string))
        {
            return $this->adjust_closure_fk_closure_to_string;
        }
    
        $values = AdjustClosure::where('cashier_method', '=', $this->id)->getIndexedArray('closure','{fk_closure->id}');
        return implode(', ', $values);
    }

    public function set_adjust_closure_fk_cashier_method_to_string($adjust_closure_fk_cashier_method_to_string)
    {
        if(is_array($adjust_closure_fk_cashier_method_to_string))
        {
            $values = ClosurePaymentMethods::where('id', 'in', $adjust_closure_fk_cashier_method_to_string)->getIndexedArray('id', 'id');
            $this->adjust_closure_fk_cashier_method_to_string = implode(', ', $values);
        }
        else
        {
            $this->adjust_closure_fk_cashier_method_to_string = $adjust_closure_fk_cashier_method_to_string;
        }

        $this->vdata['adjust_closure_fk_cashier_method_to_string'] = $this->adjust_closure_fk_cashier_method_to_string;
    }

    public function get_adjust_closure_fk_cashier_method_to_string()
    {
        if(!empty($this->adjust_closure_fk_cashier_method_to_string))
        {
            return $this->adjust_closure_fk_cashier_method_to_string;
        }
    
        $values = AdjustClosure::where('cashier_method', '=', $this->id)->getIndexedArray('cashier_method','{fk_cashier_method->id}');
        return implode(', ', $values);
    }

    
}

