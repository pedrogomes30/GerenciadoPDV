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
        parent::addAttribute('dt_create');
        parent::addAttribute('fantasy_name');
        parent::addAttribute('icon_url');
        parent::addAttribute('email');
        parent::addAttribute('fone');
        parent::addAttribute('cep');
        parent::addAttribute('city');
        parent::addAttribute('address_complement');
        parent::addAttribute('address_number');
        parent::addAttribute('neighborhood');
        parent::addAttribute('street');
        parent::addAttribute('obs');
        parent::addAttribute('invoice_type');
        parent::addAttribute('state_inscription');
        parent::addAttribute('municipal_inscription');
        parent::addAttribute('icms');
        parent::addAttribute('tax_regime');
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
        parent::addAttribute('certificate_validate');
        parent::addAttribute('store_group');
            
    }

    /**
     * Method set_store_group
     * Sample of usage: $var->store_group = $object;
     * @param $object Instance of StoreGroup
     */
    public function set_fk_store_group(StoreGroup $object)
    {
        $this->fk_store_group = $object;
        $this->store_group = $object->id;
    }

    /**
     * Method get_fk_store_group
     * Sample of usage: $var->fk_store_group->attribute;
     * @returns StoreGroup instance
     */
    public function get_fk_store_group()
    {
    
        // loads the associated object
        if (empty($this->fk_store_group))
            $this->fk_store_group = new StoreGroup($this->store_group);
    
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
     * Method getPaymentMethodStores
     */
    public function getPaymentMethodStores()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('store', '=', $this->id));
        return PaymentMethodStore::getObjects( $criteria );
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
     * Method getUsers
     */
    public function getUsersByFkOriginStores()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('origin_store', '=', $this->id));
        return User::getObjects( $criteria );
    }
    /**
     * Method getUsers
     */
    public function getUsersByFkCurrentStores()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('current_store', '=', $this->id));
        return User::getObjects( $criteria );
    }
    /**
     * Method getProductStorages
     */
    public function getProductStorages()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('store', '=', $this->id));
        return ProductStorage::getObjects( $criteria );
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
            $values = Store::where('id', 'in', $cashier_fk_store_to_string)->getIndexedArray('fantasy_name', 'fantasy_name');
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
    
        $values = Cashier::where('store', '=', $this->id)->getIndexedArray('store','{fk_store->fantasy_name}');
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
    
        $values = PaymentMethodStore::where('store', '=', $this->id)->getIndexedArray('method','{fk_method->id}');
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
    
        $values = PaymentMethodStore::where('store', '=', $this->id)->getIndexedArray('store','{fk_store->fantasy_name}');
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
            $values = Store::where('id', 'in', $user_store_transfer_fk_store_origin_to_string)->getIndexedArray('fantasy_name', 'fantasy_name');
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
    
        $values = UserStoreTransfer::where('store_origin', '=', $this->id)->getIndexedArray('store_origin','{fk_store_origin->fantasy_name}');
        return implode(', ', $values);
    }

    public function set_user_store_transfer_fk_store_destiny_to_string($user_store_transfer_fk_store_destiny_to_string)
    {
        if(is_array($user_store_transfer_fk_store_destiny_to_string))
        {
            $values = Store::where('id', 'in', $user_store_transfer_fk_store_destiny_to_string)->getIndexedArray('fantasy_name', 'fantasy_name');
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
    
        $values = UserStoreTransfer::where('store_origin', '=', $this->id)->getIndexedArray('store_destiny','{fk_store_destiny->fantasy_name}');
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

    public function set_user_fk_origin_store_to_string($user_fk_origin_store_to_string)
    {
        if(is_array($user_fk_origin_store_to_string))
        {
            $values = Store::where('id', 'in', $user_fk_origin_store_to_string)->getIndexedArray('fantasy_name', 'fantasy_name');
            $this->user_fk_origin_store_to_string = implode(', ', $values);
        }
        else
        {
            $this->user_fk_origin_store_to_string = $user_fk_origin_store_to_string;
        }

        $this->vdata['user_fk_origin_store_to_string'] = $this->user_fk_origin_store_to_string;
    }

    public function get_user_fk_origin_store_to_string()
    {
        if(!empty($this->user_fk_origin_store_to_string))
        {
            return $this->user_fk_origin_store_to_string;
        }
    
        $values = User::where('current_store', '=', $this->id)->getIndexedArray('origin_store','{fk_origin_store->fantasy_name}');
        return implode(', ', $values);
    }

    public function set_user_fk_current_store_to_string($user_fk_current_store_to_string)
    {
        if(is_array($user_fk_current_store_to_string))
        {
            $values = Store::where('id', 'in', $user_fk_current_store_to_string)->getIndexedArray('fantasy_name', 'fantasy_name');
            $this->user_fk_current_store_to_string = implode(', ', $values);
        }
        else
        {
            $this->user_fk_current_store_to_string = $user_fk_current_store_to_string;
        }

        $this->vdata['user_fk_current_store_to_string'] = $this->user_fk_current_store_to_string;
    }

    public function get_user_fk_current_store_to_string()
    {
        if(!empty($this->user_fk_current_store_to_string))
        {
            return $this->user_fk_current_store_to_string;
        }
    
        $values = User::where('current_store', '=', $this->id)->getIndexedArray('current_store','{fk_current_store->fantasy_name}');
        return implode(', ', $values);
    }

    public function set_user_fk_profession_to_string($user_fk_profession_to_string)
    {
        if(is_array($user_fk_profession_to_string))
        {
            $values = Profession::where('id', 'in', $user_fk_profession_to_string)->getIndexedArray('id', 'id');
            $this->user_fk_profession_to_string = implode(', ', $values);
        }
        else
        {
            $this->user_fk_profession_to_string = $user_fk_profession_to_string;
        }

        $this->vdata['user_fk_profession_to_string'] = $this->user_fk_profession_to_string;
    }

    public function get_user_fk_profession_to_string()
    {
        if(!empty($this->user_fk_profession_to_string))
        {
            return $this->user_fk_profession_to_string;
        }
    
        $values = User::where('current_store', '=', $this->id)->getIndexedArray('profession','{fk_profession->id}');
        return implode(', ', $values);
    }

    public function set_product_storage_fk_deposit_to_string($product_storage_fk_deposit_to_string)
    {
        if(is_array($product_storage_fk_deposit_to_string))
        {
            $values = Deposit::where('id', 'in', $product_storage_fk_deposit_to_string)->getIndexedArray('name', 'name');
            $this->product_storage_fk_deposit_to_string = implode(', ', $values);
        }
        else
        {
            $this->product_storage_fk_deposit_to_string = $product_storage_fk_deposit_to_string;
        }

        $this->vdata['product_storage_fk_deposit_to_string'] = $this->product_storage_fk_deposit_to_string;
    }

    public function get_product_storage_fk_deposit_to_string()
    {
        if(!empty($this->product_storage_fk_deposit_to_string))
        {
            return $this->product_storage_fk_deposit_to_string;
        }
    
        $values = ProductStorage::where('store', '=', $this->id)->getIndexedArray('deposit','{fk_deposit->name}');
        return implode(', ', $values);
    }

    public function set_product_storage_fk_product_to_string($product_storage_fk_product_to_string)
    {
        if(is_array($product_storage_fk_product_to_string))
        {
            $values = Product::where('id', 'in', $product_storage_fk_product_to_string)->getIndexedArray('description', 'description');
            $this->product_storage_fk_product_to_string = implode(', ', $values);
        }
        else
        {
            $this->product_storage_fk_product_to_string = $product_storage_fk_product_to_string;
        }

        $this->vdata['product_storage_fk_product_to_string'] = $this->product_storage_fk_product_to_string;
    }

    public function get_product_storage_fk_product_to_string()
    {
        if(!empty($this->product_storage_fk_product_to_string))
        {
            return $this->product_storage_fk_product_to_string;
        }
    
        $values = ProductStorage::where('store', '=', $this->id)->getIndexedArray('product','{fk_product->description}');
        return implode(', ', $values);
    }

    
}

