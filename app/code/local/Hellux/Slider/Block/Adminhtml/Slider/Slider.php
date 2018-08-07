<?php

 /**
  * Created by Hellux.
  * User: Zbigglord
  * Date: 2017-01-31
  * Time: 11:43
  */
 class Hellux_Slider_Block_Adminhtml_Slider_Slider extends Mage_Adminhtml_Block_Widget_Grid_Container{

  public function __construct(){
   parent::__construct();
   $this->_blockGroup = 'hellux_slider';
   $this->_controller = 'adminhtml_slider_grid';
   $this->_headerText = Mage::helper('hellux_slider')->__('Lista istniejących sliderów');
  }

  protected function _prepareLayout()//Need to override this function to add remove button otherwise it just does not work
  {
  // $this->_removeButton('add');

   return parent::_prepareLayout();
  }

 }//END CLASS