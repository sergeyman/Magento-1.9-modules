<?php

class Mdg_Giftregistry_Block_Edit extends Mage_Core_Block_Template
{
    public function __construct()
    {
        if($registry_id = Mage::app()->getRequest()->getParam('registry_id')){
            $registry = Mage::getModel('mdg_giftregistry/entity')->load($registry_id);
            Mage::getSingleton('customer/session')->setLoadedRegistry($registry);
        }else{
            Mage::getSingleton('customer/session')->setLoadedRegistry(false);
        }
        parent::__construct();
    }


}