<?php

/**
 * Created by Hellux.
 * User: Zbigglord
 * Date: 2017-01-31
 * Time: 11:43
 */
class Hellux_Slider_Block_Adminhtml_Items_Items extends Mage_Adminhtml_Block_Widget_Grid_Container{

    public function __construct(){
        parent::__construct();
        $this->_blockGroup = 'hellux_slider';
        $this->_controller = 'adminhtml_items_grid';
        $this->_headerText = Mage::helper('hellux_slider')->__('Lista istniejących obrazków slajdera');
    }

    protected function _prepareLayout()//Need to override this function to add remove button otherwise it just does not work
    {
        $this->_removeButton('add');

        $this->_addButton('module_controller', array(
            'label' => $this->__('Dodaj nowy obrazek'),
            'onclick' => "setLocation('{$this->getUrl('*/items/new', array('slider_id' => $this->getRequest()->getParam('id')))}')",
        ));

        return parent::_prepareLayout();
    }

}//END CLASS