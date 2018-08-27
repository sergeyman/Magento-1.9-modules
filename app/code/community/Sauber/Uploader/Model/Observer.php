<?php
class Sauber_Uploader_Model_Observer
{    
    public function addFiles($observer)
    {
        $product = $observer->getProduct();     
        if(isset($_FILES['product']['name']) && is_array($_FILES['product']['name']))
        {
            foreach($_FILES['product']['name'] as $name => $val)
            {
                if(empty($val)) continue;

                $file = array();

                foreach($_FILES['product'] as $items => $it_val){
                    $file[$items] = $it_val[$name];
                }
                try{
                    $uploader = new Varien_File_Uploader($file);
                    //$uploader->setAllowedExtensions(array('doc', 'docx','pdf'));
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    $path = Mage::getBaseDir('media') . DS . 'sauber' . DS . 'uploader' . DS ;
                    $uploader->save($path, $val);
                    $product->setData($name, $val);
                    $product->save();
                } catch(Exception $ex) {
                   Mage::log($ex, null, 'uploader.log');
                }
            }
        }
        foreach($product->getData() as $field => $vals)
        {
            if(is_array($vals) && $vals['delete'] == 1)
            {
                $product->setData($field, false);
                $product->save();
            }
        }
    }

    public function addAttributeType($observer)
    {
        $response = $observer->getResponse(); 
        $response->setTypes(
            array(
                array(
                    'value' => 'uploader',
                    'label' => Mage::helper('catalog')->__('File'),
                )
            )
        );
    }

    public function changeBackendType($observer)
    {
        if($observer->getDataObject()->getData('frontend_input') == 'uploader')
        {
            $observer->getDataObject()->setData('backend_type', 'varchar');
        }
    }
}
