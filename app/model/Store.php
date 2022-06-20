<?php

class Store extends TRecord
{
    const TABLENAME  = 'store';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fk_store_group;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('social_name');
        parent::addAttribute('abbreviation');
        parent::addAttribute('cnpj');
        parent::addAttribute('icon_url');
        parent::addAttribute('fantasy_name');
        parent::addAttribute('obs');
        parent::addAttribute('state_inscription');
        parent::addAttribute('minicipal_inscription');
        parent::addAttribute('icms');
        parent::addAttribute('tax_regime');
        parent::addAttribute('invoice_type');
        parent::addAttribute('invoice_provider_id');
        parent::addAttribute('production_csc_number');
        parent::addAttribute('production_csc_id');
        parent::addAttribute('production_invoice_serie');
        parent::addAttribute('production_invoice_sequence');
        parent::addAttribute('homologation_csc_number');
        parent::addAttribute('homologation_csc_id');
        parent::addAttribute('homologation_invoice_serie');
        parent::addAttribute('homologation_invoice_sequence');
        parent::addAttribute('certificate_password');
        parent::addAttribute('store_group');
            
    }

    /**
     * Method set_group_store
     * Sample of usage: $var->group_store = $object;
     * @param $object Instance of GroupStore
     */
    public function set_fk_store_group(GroupStore $object)
    {
        $this->fk_store_group = $object;
        $this->store_group = $object->id;
    }

    /**
     * Method get_fk_store_group
     * Sample of usage: $var->fk_store_group->attribute;
     * @returns GroupStore instance
     */
    public function get_fk_store_group()
    {
    
        // loads the associated object
        if (empty($this->fk_store_group))
            $this->fk_store_group = new GroupStore($this->store_group);
    
        // returns the associated object
        return $this->fk_store_group;
    }

    /**
     * Method getCashiers
     */
    public function getCashiers()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('store', '=', $this->id));
        return Cashier::getObjects( $criteria );
    }
    /**
     * Method getUsers
     */
    public function getUsers()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('store', '=', $this->id));
        return User::getObjects( $criteria );
    }
    /**
     * Method getDeposits
     */
    public function getDeposits()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('store', '=', $this->id));
        return Deposit::getObjects( $criteria );
    }
    /**
     * Method getSales
     */
    public function getSales()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('store', '=', $this->id));
        return Sale::getObjects( $criteria );
    }
    /**
     * Method getMethodPaymentStores
     */
    public function getMethodPaymentStores()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('store_id', '=', $this->id));
        return MethodPaymentStore::getObjects( $criteria );
    }
    /**
     * Method getClosures
     */
    public function getClosures()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('store', '=', $this->id));
        return Closure::getObjects( $criteria );
    }
    /**
     * Method getWithdrawals
     */
    public function getWithdrawals()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('store', '=', $this->id));
        return Withdrawal::getObjects( $criteria );
    }
    /**
     * Method getUserStoreTransfers
     */
    public function getUserStoreTransfersByFkStoreDestinys()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('store_destiny', '=', $this->id));
        return UserStoreTransfer::getObjects( $criteria );
    }
    /**
     * Method getUserStoreTransfers
     */
    public function getUserStoreTransfersByFkStoreOrigins()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('store_origin', '=', $this->id));
        return UserStoreTransfer::getObjects( $criteria );
    }
    /**
     * Method getSaleItems
     */
    public function getSaleItems()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('store', '=', $this->id));
        return SaleItem::getObjects( $criteria );
    }
    /**
     * Method getPriceLists
     */
    public function getPriceLists()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('store', '=', $this->id));
        return PriceList::getObjects( $criteria );
    }

    public function set_cashier_fk_user_authenticated_to_string($cashier_fk_user_authenticated_to_string)
    {
        if(is_array($cashier_fk_user_authenticated_to_string))
        {
            $values = User::where('id', 'in', $cashier_fk_user_authenticated_to_string)->getIndexedArray('id', 'id');
            $this->cashier_fk_user_authenticated_to_string = implode(', ', $values);
        }
        else
        {
            $this->cashier_fk_user_authenticated_to_string = $cashier_fk_user_authenticated_to_string;
        }

        $this->vdata['cashier_fk_user_authenticated_to_string'] = $this->cashier_fk_user_authenticated_to_string;
    }

    public function get_cashier_fk_user_authenticated_to_string()
    {
        if(!empty($this->cashier_fk_user_authenticated_to_string))
        {
            return $this->cashier_fk_user_authenticated_to_string;
        }
    
        $values = Cashier::where('store', '=', $this->id)->getIndexedArray('user_authenticated','{fk_user_authenticated->id}');
        return implode(', ', $values);
    }

    public function set_cashier_fk_store_to_string($cashier_fk_store_to_string)
    {
        if(is_array($cashier_fk_store_to_string))
        {
            $values = Store::where('id', 'in', $cashier_fk_store_to_string)->getIndexedArray('social_name', 'social_name');
            $this->cashier_fk_store_to_string = implode(', ', $values);
        }
        else
        {
            $this->cashier_fk_store_to_string = $cashier_fk_store_to_string;
        }

        $this->vdata['cashier_fk_store_to_string'] = $this->cashier_fk_store_to_string;
    }

    public function get_cashier_fk_store_to_string()
    {
        if(!empty($this->cashier_fk_store_to_string))
        {
            return $this->cashier_fk_store_to_string;
        }
    
        $values = Cashier::where('store', '=', $this->id)->getIndexedArray('store','{fk_store->social_name}');
        return implode(', ', $values);
    }

    public function set_user_fk_store_to_string($user_fk_store_to_string)
    {
        if(is_array($user_fk_store_to_string))
        {
            $values = Store::where('id', 'in', $user_fk_store_to_string)->getIndexedArray('social_name', 'social_name');
            $this->user_fk_store_to_string = implode(', ', $values);
        }
        else
        {
            $this->user_fk_store_to_string = $user_fk_store_to_string;
        }

        $this->vdata['user_fk_store_to_string'] = $this->user_fk_store_to_string;
    }

    public function get_user_fk_store_to_string()
    {
        if(!empty($this->user_fk_store_to_string))
        {
            return $this->user_fk_store_to_string;
        }
    
        $values = User::where('store', '=', $this->id)->getIndexedArray('store','{fk_store->social_name}');
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
    
        $values = Sale::where('store', '=', $this->id)->getIndexedArray('status','{fk_status->id}');
        return implode(', ', $values);
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
    
        $values = MethodPaymentStore::where('store_id', '=', $this->id)->getIndexedArray('method_id','{method->id}');
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
    
        $values = MethodPaymentStore::where('store_id', '=', $this->id)->getIndexedArray('store_id','{store->social_name}');
        return implode(', ', $values);
    }

    public function set_withdrawal_fk_closure_to_string($withdrawal_fk_closure_to_string)
    {
        if(is_array($withdrawal_fk_closure_to_string))
        {
            $values = Closure::where('id', 'in', $withdrawal_fk_closure_to_string)->getIndexedArray('id', 'id');
            $this->withdrawal_fk_closure_to_string = implode(', ', $values);
        }
        else
        {
            $this->withdrawal_fk_closure_to_string = $withdrawal_fk_closure_to_string;
        }

        $this->vdata['withdrawal_fk_closure_to_string'] = $this->withdrawal_fk_closure_to_string;
    }

    public function get_withdrawal_fk_closure_to_string()
    {
        if(!empty($this->withdrawal_fk_closure_to_string))
        {
            return $this->withdrawal_fk_closure_to_string;
        }
    
        $values = Withdrawal::where('store', '=', $this->id)->getIndexedArray('closure','{fk_closure->id}');
        return implode(', ', $values);
    }

    public function set_withdrawal_fk_withdrawal_account_to_string($withdrawal_fk_withdrawal_account_to_string)
    {
        if(is_array($withdrawal_fk_withdrawal_account_to_string))
        {
            $values = WithdrawalAccount::where('id', 'in', $withdrawal_fk_withdrawal_account_to_string)->getIndexedArray('id', 'id');
            $this->withdrawal_fk_withdrawal_account_to_string = implode(', ', $values);
        }
        else
        {
            $this->withdrawal_fk_withdrawal_account_to_string = $withdrawal_fk_withdrawal_account_to_string;
        }

        $this->vdata['withdrawal_fk_withdrawal_account_to_string'] = $this->withdrawal_fk_withdrawal_account_to_string;
    }

    public function get_withdrawal_fk_withdrawal_account_to_string()
    {
        if(!empty($this->withdrawal_fk_withdrawal_account_to_string))
        {
            return $this->withdrawal_fk_withdrawal_account_to_string;
        }
    
        $values = Withdrawal::where('store', '=', $this->id)->getIndexedArray('withdrawal_account','{fk_withdrawal_account->id}');
        return implode(', ', $values);
    }

    public function set_user_store_transfer_fk_user_to_string($user_store_transfer_fk_user_to_string)
    {
        if(is_array($user_store_transfer_fk_user_to_string))
        {
            $values = User::where('id', 'in', $user_store_transfer_fk_user_to_string)->getIndexedArray('id', 'id');
            $this->user_store_transfer_fk_user_to_string = implode(', ', $values);
        }
        else
        {
            $this->user_store_transfer_fk_user_to_string = $user_store_transfer_fk_user_to_string;
        }

        $this->vdata['user_store_transfer_fk_user_to_string'] = $this->user_store_transfer_fk_user_to_string;
    }

    public function get_user_store_transfer_fk_user_to_string()
    {
        if(!empty($this->user_store_transfer_fk_user_to_string))
        {
            return $this->user_store_transfer_fk_user_to_string;
        }
    
        $values = UserStoreTransfer::where('store_origin', '=', $this->id)->getIndexedArray('user','{fk_user->id}');
        return implode(', ', $values);
    }

    public function set_user_store_transfer_fk_store_origin_to_string($user_store_transfer_fk_store_origin_to_string)
    {
        if(is_array($user_store_transfer_fk_store_origin_to_string))
        {
            $values = Store::where('id', 'in', $user_store_transfer_fk_store_origin_to_string)->getIndexedArray('social_name', 'social_name');
            $this->user_store_transfer_fk_store_origin_to_string = implode(', ', $values);
        }
        else
        {
            $this->user_store_transfer_fk_store_origin_to_string = $user_store_transfer_fk_store_origin_to_string;
        }

        $this->vdata['user_store_transfer_fk_store_origin_to_string'] = $this->user_store_transfer_fk_store_origin_to_string;
    }

    public function get_user_store_transfer_fk_store_origin_to_string()
    {
        if(!empty($this->user_store_transfer_fk_store_origin_to_string))
        {
            return $this->user_store_transfer_fk_store_origin_to_string;
        }
    
        $values = UserStoreTransfer::where('store_origin', '=', $this->id)->getIndexedArray('store_origin','{fk_store_origin->social_name}');
        return implode(', ', $values);
    }

    public function set_user_store_transfer_fk_store_destiny_to_string($user_store_transfer_fk_store_destiny_to_string)
    {
        if(is_array($user_store_transfer_fk_store_destiny_to_string))
        {
            $values = Store::where('id', 'in', $user_store_transfer_fk_store_destiny_to_string)->getIndexedArray('social_name', 'social_name');
            $this->user_store_transfer_fk_store_destiny_to_string = implode(', ', $values);
        }
        else
        {
            $this->user_store_transfer_fk_store_destiny_to_string = $user_store_transfer_fk_store_destiny_to_string;
        }

        $this->vdata['user_store_transfer_fk_store_destiny_to_string'] = $this->user_store_transfer_fk_store_destiny_to_string;
    }

    public function get_user_store_transfer_fk_store_destiny_to_string()
    {
        if(!empty($this->user_store_transfer_fk_store_destiny_to_string))
        {
            return $this->user_store_transfer_fk_store_destiny_to_string;
        }
    
        $values = UserStoreTransfer::where('store_origin', '=', $this->id)->getIndexedArray('store_destiny','{fk_store_destiny->social_name}');
        return implode(', ', $values);
    }

    public function set_sale_item_fk_sale_to_string($sale_item_fk_sale_to_string)
    {
        if(is_array($sale_item_fk_sale_to_string))
        {
            $values = Sale::where('id', 'in', $sale_item_fk_sale_to_string)->getIndexedArray('id', 'id');
            $this->sale_item_fk_sale_to_string = implode(', ', $values);
        }
        else
        {
            $this->sale_item_fk_sale_to_string = $sale_item_fk_sale_to_string;
        }

        $this->vdata['sale_item_fk_sale_to_string'] = $this->sale_item_fk_sale_to_string;
    }

    public function get_sale_item_fk_sale_to_string()
    {
        if(!empty($this->sale_item_fk_sale_to_string))
        {
            return $this->sale_item_fk_sale_to_string;
        }
    
        $values = SaleItem::where('store', '=', $this->id)->getIndexedArray('sale','{fk_sale->id}');
        return implode(', ', $values);
    }

    
}

