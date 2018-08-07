<?php

/**
 * Created by Hellux.
 * User: Zbigg
 * Date: 2017-01-27
 * Time: 09:22
 */
class Hellux_Slider_Model_Resource_Slider extends Mage_Core_Model_Resource_Db_Abstract
{
 public function _construct(){
  $this->_init('hellux_slider/slider', 'id');
 }


 public static function checkSlider($slider_name){

  $exists = TRUE;
  $resource = Mage::getSingleton('core/resource');
  $readConnection = $resource->getConnection('core_read');

  if(isset($slider_name)){

   try{
    $check_query = "SELECT * FROM hellux_slider_slider WHERE slider_name = '$slider_name'";
    $results = $readConnection->fetchAll($check_query);

    if(!$results){
     $exists = FALSE;
    }else{
     $exists = TRUE;
    }
   }catch(Exception $e){
    Mage::getSingleton('adminhtml/session')->addError($e);
   }

  }else{
   Mage::getSingleton('adminhtml/session')->addError('Wystąpił nieznany błąd');
  }

  return $exists;

 }//end function checkSlider($slider_name)

 public static function insertNewSlider($data){

  $resource = Mage::getSingleton('core/resource');
  $writeConnection = $resource->getConnection('core_write');
  $slider_name = '';
  $is_active = 0;
  foreach($data as $d){
   $slider_name = $data['slider_name'];
   $is_active = $data['is_active'];
  }

  $insert_query = "INSERT INTO hellux_slider_slider (slider_name,date_added,active) VALUES('$slider_name',NOW(),'$is_active')";

  $success = $writeConnection->query($insert_query);
  if(!$success){
   throw new Exception($success->errorInfo());
  }else{
    Mage::getSingleton('adminhtml/session')->addSuccess('Nowy slider został utworzony');
  }
 }//end function insertNewSlider($slider_name)

 public static function editSlider($slider_id){

  $resource = Mage::getSingleton('core/resource');
  $readConnection = $resource->getConnection('core_read');

  if(isset($slider_id)){

   try{
    $check_query = "SELECT * FROM hellux_slider_slider WHERE id = '$slider_id'";
    $results = $readConnection->fetchAll($check_query);

    if(!$results){
     Mage::getSingleton('adminhtml/session')->addError('Błąd: taki slider nie istnieje');
    }else{

    }
   }catch(Exception $e){
    Mage::getSingleton('adminhtml/session')->addError($e);
   }

  }else{
   Mage::getSingleton('adminhtml/session')->addError('Wystąpił nieznany błąd');
  }
  return $results;
 }//end function editSlider($id)

 public static function updateSlider($data){

  $resource = Mage::getSingleton('core/resource');
  $writeConnection = $resource->getConnection('core_write');

   $slider_name = $data['slider_name'];
   $is_active = $data['is_active'];
   $slider_id = $data['slider_id'];


  $update_query = "UPDATE hellux_slider_slider SET
                       slider_name = '$slider_name',
                       date_edited = NOW(),
                       active = '$is_active'
                       WHERE id = '$slider_id'
                       ";

  $success = $writeConnection->query($update_query);

  if(!$success){

   throw new Exception($success->errorInfo());

  }else{
   Mage::getSingleton('adminhtml/session')->addSuccess('Slider edytowano poprawnie');
  }

 }//END function updateSlider($data)

}//END Slider Resource Model class