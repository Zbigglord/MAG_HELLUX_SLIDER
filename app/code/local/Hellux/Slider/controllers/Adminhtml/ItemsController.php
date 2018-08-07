<?php
/**
 * Created by Hellux.
 * User: Zbigglord
 * Date: 2017-01-31
 * Time: 11:29
 */
class Hellux_Slider_Adminhtml_ItemsController extends Mage_Adminhtml_Controller_Action {

    public function indexAction()
    {
        $this->_title($this->__('Slider'))->_title($this->__('Obrazki slidera'));
        $this->loadLayout();
        $this->_setActiveMenu('hellux/items');
        $this->_addContent($this->getLayout()->createBlock('hellux_slider/adminhtml_items_items'));
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('hellux_slider/adminhtml_items_grid_grid')->toHtml()
        );
    }

    public function newAction(){

        $this->_title($this->__('Slider'))->_title($this->__('Nowy obrazek'));
        $this->loadLayout();
        $this->_setActiveMenu('hellux/items');
        $this->_addContent($this->getLayout()->createBlock('hellux_slider/adminhtml_items_edit'));
        $this->renderLayout();
    }

    public function saveAction(){

        $data = $this->getRequest()->getPost();

        if(isset($_FILES['slider_image']['name']) and (file_exists($_FILES['slider_image']['tmp_name']))){

            if(isset($data['obrazek_id'])){//if we are going to edit existed record with image change

                try {

                    $uploader = new Varien_File_Uploader('slider_image');
                    $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png')); // or pdf or anything


                    $uploader->setAllowRenameFiles(false);

                    // setAllowRenameFiles(true) -> move your file in a folder the magento way
                    // setAllowRenameFiles(true) -> move your file directly in the $path folder
                    $uploader->setFilesDispersion(false);

                    $path = Mage::getBaseDir('skin') . DS . 'frontend' . DS . 'hellux' . DS . 'default' . DS . 'images' . DS .'slider' . DS ;

                    if (!is_dir($path)) {
                        mkdir($path, 0775);
                    }

                    $uploader->save($path, $_FILES['slider_image']['name']);

                    $data['slider_image'] = $_FILES['slider_image']['name'];
                    $data['image_path'] = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN) . 'frontend' . DS . 'hellux' . DS . 'default' . DS . 'images' . DS .'slider' . DS;

                    Hellux_Slider_Model_Resource_Items::editImage($data);

                }catch(Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e);
                }

            }else{//we are going to add new record

            try {

                $uploader = new Varien_File_Uploader('slider_image');
                $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png')); // or pdf or anything


                $uploader->setAllowRenameFiles(false);

                // setAllowRenameFiles(true) -> move your file in a folder the magento way
                // setAllowRenameFiles(true) -> move your file directly in the $path folder
                $uploader->setFilesDispersion(false);

                $path = Mage::getBaseDir('skin') . DS . 'frontend' . DS . 'hellux' . DS . 'default' . DS . 'images' . DS .'slider' . DS ;

                if (!is_dir($path)) {
                    mkdir($path, 0775);
                }

                $uploader->save($path, $_FILES['slider_image']['name']);

                $data['slider_image'] = $_FILES['slider_image']['name'];
                $data['image_path'] = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN) . 'frontend' . DS . 'hellux' . DS . 'default' . DS . 'images' . DS .'slider' . DS;

                Hellux_Slider_Model_Resource_Items::addNewImage($data);

            }catch(Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e);
            }
          }

        }else{//we are going to edit existed record but without image change

            Hellux_Slider_Model_Resource_Items::editImage($data);
        }

        $this->_redirect('*/*/index', array('id' => $data['slider_id']));

    }

    public function editAction(){

        $ids = $this->getRequest()->getParam('ids');
        $edit_id = $this->getRequest()->getParam('edit_id');
        if(!isset($edit_id)){//if edit was send from select edit action, not from row click

            if (!is_array($ids)) {
                $this->_getSession()->addError($this->__('Proszę wybrać (s).'));
            }elseif(count($ids) > 1){
                $this->_getSession()->addError($this->__('Proszę wybrać tylko 1 slider do edycji.'));
            }else{
                foreach($ids as $id){
                    $edit_id = $id;
                }
            }

        }else{
//all isset do nothing more
        }

        $this->_title($this->__('Slider'))->_title($this->__('Edutuj obrazek'));
        $this->loadLayout();
        $this->_setActiveMenu('hellux/items');
       $this->_addContent($this->getLayout()->createBlock('hellux_slider/adminhtml_items_edit'));
        $this->renderLayout();

    }


    public function massDeleteAction()
    {
        $data = $this->getRequest()->getPost();
        $ids = $this->getRequest()->getParam('ids');
        if (!is_array($ids)) {
            $this->_getSession()->addError($this->__('Please select (s).'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = Mage::getSingleton('hellux_slider/items')->load($id);
                    $model->delete();
                }

                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) have been deleted.', count($ids))
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('hellux_slider')->__('An error occurred while mass deleting items. Please review log and try again.')
                );
                Mage::logException($e);

                return;
            }
        }
        $this->_redirect('*/slider/index');
    }//END mass deleteAction

}//END CLASS