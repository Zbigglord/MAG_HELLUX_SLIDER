<?php

/**
 * Created by Hellux.
 * User: Zbigg
 * Date: 2017-01-27
 * Time: 09:22
 */
class Hellux_Slider_Model_Slider extends Mage_Core_Model_Abstract
{

 public function _construct()
 {
  $this->_init('hellux_slider/slider');
  parent::_construct();
 }

 public static function isActive($id){

  $resource = Mage::getSingleton('core/resource');
  $readConnection = $resource->getConnection('core_read');

  $check_query = ("SELECT * FROM hellux_slider_slider WHERE id = '$id'");
  $results = $readConnection->query($check_query);

  foreach($results as $r){
   if($r['active'] == 1){
    return TRUE;
   }else{
    return FALSE;
   }
  }

 }//END function isActive($id)

 public static function getSliderData($id){

  $data = array();
  $resource = Mage::getSingleton('core/resource');
  $readConnection = $resource->getConnection('core_read');

  $is_active = self::isActive($id);

  if($is_active == FALSE){
   //return empty array
  }else{
   $check_query = ("SELECT * FROM hellux_slider_items WHERE slider_id = '$id'");
   $results = $readConnection->query($check_query);
   foreach($results as $key => $value){
    $data[$key] = $value;
   }
  }
   return $data;
 } //END  function getSliderData($id)

}//END slider model class