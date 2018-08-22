<?php
class Asv_Test_IndexController extends Mage_Core_Controller_Front_Action
{
    ///helloworld/index/hello
    public function indexAction()
    {
        $this->loadLayout(); #загружаем макеты

        //echo 'Action <b>index</b> in Asv_Test IndexController';

        $this->renderLayout(); #выводим html

    }

    public function helloAction()
    {
        $id = $this->getRequest()->getParam('id');

        $this->loadLayout();

        echo 'Action <b>hello</b> in Asv_Test IndexController';
        if(!$id) {
            echo "<p>You haven't passed id parameter in adress</p>";
        }
        echo "<h2>" . $id . "</h2>";

        $productCollection = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->load($id);
           /* ->load($id)->getCollection()
            ->addAttributeToSelect('*')
            ->load($id);*/

        $category = Mage::getModel('catalog/category')->load($id);
        $collection = $category->getProductCollection()
            ->joinField('category_id', 'catalog/category_product',
                'category_id', 'product_id = entity_id', null, 'left')
            ->addAttributeToFilter('category_id', array('in' => array(1 ,2 ,3)))
            ->addAttributeToSelect(array('name', 'price'));

        foreach($collection as $p) {
            echo $p->getId() . '&nbsp $' . $p->getName() . '&nbsp $' . $p->getPrice() . '<br />';
        }

        echo '<hr />';
        $model = Mage::getModel('catalog/product')->load(3);
        echo $model->getName();

        foreach($productCollection as $product) {
            //echo $product->getName() . '&nbsp $' . $product->getPrice() . '<br />';
            //var_dump($product->getData());
        }


        $block = $this->getLayout()->createBlock('adminhtml/system_account_edit');
        $this->getLayout()->getBlock('content')->append($block);

        $this->renderLayout();
    }

    public function handlesAction()
    {
        $this->loadLayout();
        $layoutHandles = $this->getLayout()->getUpdate()->getHandles();
        echo '<pre>' . print_r($layoutHandles, true) . '</pre>';
    }
}