<?php
/**
 * Created by Hellux.
 * User: Zbigglord
 * Date: 2017-01-31
 * Time: 11:29
 */
class Hellux_Slider_Adminhtml_SliderController extends Mage_Adminhtml_Controller_Action {

 public function indexAction()
 {
  $this->_title($this->__('Slider'))->_title($this->__('Hellux Slider'));
  $this->loadLayout();
  $this->_setActiveMenu('hellux/slider');
  $this->_addContent($this->getLayout()->createBlock('hellux_slider/adminhtml_slider_slider'));
  $this->renderLayout();
 }

 public function gridAction()
 {
  $this->loadLayout();
  $this->getResponse()->setBody(
   $this->getLayout()->createBlock('hellux_slider/adminhtml_slider_grid_grid')->toHtml()
  );
 }

 public function newAction(){
  $this->_title($this->__('Slider'))->_title($this->__('Dodaj nowy slider'));
  $this->loadLayout();
  $this->_setActiveMenu('hellux/slider');
  $this->_addContent($this->getLayout()->createBlock('hellux_slider/adminhtml_slider_edit'));
  $this->renderLayout();
 }

 public function saveAction(){

  $data = array();
  if(isset($_POST)){

   if(isset($_POST['slider_id'])){

    $data['slider_id'] = $_POST['slider_id'];
    $data['slider_name'] = $_POST['slider_name'];
    $data['is_active'] = $_POST['is_active'];

    Hellux_Slider_Model_Resource_Slider::updateSlider($data);

   }else{
    $data['slider_name'] = $_POST['slider_name'];
    $data['is_active'] = $_POST['is_active'];
    $exists = Hellux_Slider_Model_Resource_Slider::checkSlider($_POST['slider_name']);

    if($exists != TRUE){

     Hellux_Slider_Model_Resource_Slider::insertNewSlider($data);

    }else{

     $this->_getSession()->addError('Slider o takiej nazwie już istnieje. Slider nie został utworzony');
    }

   }

  }else{
   $this->_getSession()->addError($this->__('Wystąpił nieznany błąd'));
  }

 if ($this->getRequest()->getParam('back')) {
   $this->_redirect('*/*/index');
  }else{
   $this->_redirect('*/*/index');
  }

 }//END newAction()

 public function editAction(){

  $one_id = '';
  $ids = $this->getRequest()->getParam('ids');
  if (!is_array($ids)) {
   $this->_getSession()->addError($this->__('Proszę wybrać (s).'));
  }elseif(count($ids) > 1){
   $this->_getSession()->addError($this->__('Proszę wybrać tylko 1 slider do edycji.'));
  }else{
   foreach($ids as $id){
    $one_id = $id;
   }
  }

  $this->getRequest()->setParam('edit_id',$one_id);
  $this->_title($this->__('Slider'))->_title($this->__('Edytuj slider'));
  $this->loadLayout();
  $this->_setActiveMenu('hellux/slider');
  $this->_addContent($this->getLayout()->createBlock('hellux_slider/adminhtml_slider_edit'));
  $this->renderLayout();

 }//END editAction()

 public function massDeleteAction()
 {
  $ids = $this->getRequest()->getParam('ids');
  if (!is_array($ids)) {
   $this->_getSession()->addError($this->__('Please select (s).'));
  } else {
   try {
    foreach ($ids as $id) {
     $model = Mage::getSingleton('hellux_slider/slider')->load($id);
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
  $this->_redirect('*/*/index');
 }//END mass deleteAction

}//END CLASS