<?php

 /**
  * Created by Hellux.
  * User: Zbigglord
  * Date: 2017-02-08
  * Time: 14:34
  */
 class Hellux_Slider_Block_Adminhtml_Slider_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
 {

  public function __construct()
  {
   parent::__construct();
   $this->_objectId = 'id';
   $this->_blockGroup      = 'hellux_slider';
   $this->_controller      = 'adminhtml_slider';
   $this->_mode            = 'edit';
   $this->_updateButton('save', 'label', Mage::helper('hellux_slider')->__("Zapisz"));

   $this->_formScripts[] = "
       function saveAndContinueEdit(){
           editForm.submit($('edit_form').action+'back/edit/');
       }
   ";
  } //END CONSTR

  protected function _prepareLayout()
  {
   $this->_removeButton('delete');
   $this->_removeButton('reset');
   parent::_prepareLayout();
  }

  public function getHeaderText()
  {
    return Mage::helper('hellux_slider')->__("Dodaj nowy slider");
  }

  public function getSaveUrl()
  {
   $this->setData('form_action_url', 'save');
   return $this->getFormActionUrl();
  }

 }//END CLASS