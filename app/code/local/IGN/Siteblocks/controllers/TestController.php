<?php
class IGN_Siteblocks_TestController extends Mage_Core_Controller_Front_Action {

    //>>  example.com/siteblocks/test/mytest
    public function mytestAction()
    {
        //die('test');
        //$this->loadLayout(); #загружаем макеты
        //$this->renderLayout(); #выводим html

        //echo $this->getLayout()->createBlock('cms/block')->setBlockId('block-1')->toHtml();
    }

    //example.com/siteblocks/index/index
    public function indexAction()
    {
        //die("indexAction");

        $this->loadLayout(); #загружаем макеты

        //echo $this->getLayout()->createBlock('cms/block')->setBlockId('block-1')->toHtml();

        $this->renderLayout(); #выводим html
    }
}