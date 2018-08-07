<?php

 /**
  * Created by Hellux.
  * User: Zbigglord
  * Date: 2017-02-08
  * Time: 14:34
  */

 class Hellux_Slider_Block_Adminhtml_Slider_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
 {

  protected function _prepareLayout()
  {
   parent::_prepareLayout();
  }

  protected function _prepareForm()
  {
    $slider_name = '';
    $is_active = 0;
    $edit_id = $this->getRequest()->getParam('edit_id');
    if(isset($edit_id)){
     $data = Hellux_Slider_Model_Resource_Slider::editSlider($edit_id);
     if(!empty($data)){
      foreach($data as $d){
       $slider_name = $d['slider_name'];
       $is_active = $d['active'];
      }

     }
    }
   $form   = new Varien_Data_Form(array(
    'id'        => 'edit_form',
    'action'    => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
    'method'    => 'post',
    'enctype' => 'multipart/form-data'
   ));

   $fieldset   = $form->addFieldset('base_fieldset', array(
    'legend'    => Mage::helper('hellux_slider')->__("Nowy Slider"),
    'class'     => 'fieldset-wide',
   ));

   if(isset($edit_id)){
    $fieldset->addField('slider_id', 'hidden', array(
        'name'      => 'slider_id',
        'required'  => true,
        'value'     => $edit_id
    ));
   }

   $fieldset->addField('slider_name', 'text', array(
    'name'      => 'slider_name',
    'label'     => Mage::helper('hellux_slider')->__('Nazwa slidera'),
    'title'     => Mage::helper('hellux_slider')->__('Nazwa slidera'),
    'required'  => true,
    'value'     => $slider_name
   ));

   $fieldset->addField('is_active', 'select', array(
       'label'     => Mage::helper('hellux_slider')->__('Aktywny'),
       'required'  => true,
       'name'      => 'is_active',
       'onclick' => "",
       'onchange' => "",
       'value'  => $is_active,
       'values' => array('0' => 'Nieaktywny','1' => 'Aktywny'),
       'disabled' => false,
       'readonly' => false,
       'tabindex' => 1
   ));

   $form->setUseContainer(true);
   $this->setForm($form);

   return parent::_prepareForm();
  }
 }