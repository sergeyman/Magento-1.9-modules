<?php
class IGN_Siteblocks_Block_List extends Mage_Core_Block_Template {

    public function getAmount() {

        return ($this->getData('amount')) ? $this->getData('amount') : 5 ;
    }

    public function getBlocks()
    {
        //die($this->getAmount());

        $categoryId = $this->getData('category_id');

        //die('List.php block = ' . $block);

        //return Mage::getResourceModel('siteblocks/block_collection');

        /*
        return Mage::getModel('siteblocks/block')->getCollection()
            ->addFieldToFilter('block_status',array('eq'=>IGN_Siteblocks_Model_Source_Status::ENABLED));
        */

/*        return Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSort('created_at', 'DESC')
            ->addAttributeToSelect('*')
            ->load($product_id);*/

        $category = Mage::getModel('catalog/category')->load($categoryId);

        $result = $category->getProductCollection()
            ->joinField('category_id', 'catalog/category_product',
                'category_id', 'product_id = entity_id', null, 'left')
            ->addAttributeToFilter('category_id', array('in' => array(1 ,2 ,3)))
            ->addAttributeToSelect(array('name', 'price'));
         $result->getSelect()->limit($this->getAmount());

         //var_dump($this->getData('amount'));
        var_dump($this->getCategoryId());
        return $result;



    }
}