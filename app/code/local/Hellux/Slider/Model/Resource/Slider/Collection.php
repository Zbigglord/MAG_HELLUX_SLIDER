<?php

/**
 * Created by Hellux.
 * User: BBJaga
 * Date: 2017-01-27
 * Time: 09:29
 */
class Hellux_Slider_Model_Resource_Slider_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

 public function _construct()
 {
  $this->_init('hellux_slider/slider');
  parent::_construct();
 }


}//END class Collection