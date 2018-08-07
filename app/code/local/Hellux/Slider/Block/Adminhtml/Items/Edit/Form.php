<?php

/**
 * Created by Hellux.
 * User: Zbigglord
 * Date: 2017-02-08
 * Time: 14:34
 */

class Hellux_Slider_Block_Adminhtml_Items_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
    }

    protected function _prepareForm()
    {

        $edit_id = $this->getRequest()->getParam('edit_id');
        $slider_id = $this->getRequest()->getParam('slider_id');
        $data = array();
        $item_name = '';
        $item_header_text = '';
        $item_link = '';
        $button_text = '';
        $slider_image = '';

        if(isset($edit_id)){
            $data = Hellux_Slider_Model_Resource_Items::getPictureData($edit_id);
            foreach($data as $d){
                $slider_id = $d['slider_id'];
                $item_name = $d['item_name'];
                $item_header_text = $d['item_header_text'];
                $item_link = $d['item_link'];
                $button_text = $d['button_text'];
                $slider_image = $d['item_address'].''.$d['item_file_name'];
            }
        }
        $form   = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method'    => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $fieldset   = $form->addFieldset('base_fieldset', array(
            'legend'    => Mage::helper('hellux_slider')->__("Nowy Obrazek"),
            'class'     => 'fieldset-wide',
        ));

        if(isset($edit_id)){
            $fieldset->addField('obrazek_id', 'hidden', array(
                'name'      => 'obrazek_id',
                'required'  => true,
                'value'     => $edit_id
            ));
        }

        if(isset($slider_id)){
            $fieldset->addField('slider_id', 'hidden', array(
                'name'      => 'slider_id',
                'required'  => true,
                'value'     => $slider_id
            ));
        }else{
            $fieldset->addField('slider_id', 'text', array(
                'label'     => Mage::helper('hellux_slider')->__('ID Slidera'),
                'name'      => 'slider_id',
                'required'  => true,
                'value'     => $slider_id
            ));
        }

        $fieldset->addField('item_name', 'text', array(
            'label'     => Mage::helper('hellux_slider')->__('Tytuł obrazka'),
            'name'      => 'item_name',
            'required'  => true,
            'value'     => $item_name
        ));
        $fieldset->addField('item_header_text', 'text', array(
            'label'     => Mage::helper('hellux_slider')->__('Treść nagłówka (puste jeśli bez nagłówka)'),
            'name'      => 'item_header_text',
            'required'  => false,
            'value'     => $item_header_text
        ));
        $fieldset->addField('item_link', 'text', array(
            'label'     => Mage::helper('hellux_slider')->__('Link (puste jeśli bez linku)'),
            'name'      => 'item_link',
            'required'  => false,
            'value'     => $item_link
        ));

        $fieldset->addField('button_text', 'text', array(
            'label'     => Mage::helper('hellux_slider')->__('Przycisk (puste jeśli bez przycisku)'),
            'name'      => 'button_text',
            'required'  => false,
            'value'     => $button_text
        ));

        if(isset($edit_id)){

            $fieldset->addField('slider_image', 'file', array(
                'label'     => Mage::helper('hellux_slider')->__('Obrazek(zostaw puste aby nie zmieniać)'),
                'required'  => false,
                'name'      => 'slider_image',
                'value'     => ''
            ));

        }else{

            $fieldset->addField('slider_image', 'file', array(
                'label'     => Mage::helper('hellux_slider')->__('Obrazek'),
                'required'  => true,
                'name'      => 'slider_image',
                'value'     => ''
            ));

        }

        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}