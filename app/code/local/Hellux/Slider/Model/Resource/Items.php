<?php

/**
 * Created by Hellux.
 * User: Zbigg
 * Date: 2017-01-27
 * Time: 09:22
 */
class Hellux_Slider_Model_Resource_Items extends Mage_Core_Model_Resource_Db_Abstract{

    public function _construct(){
        $this->_init('hellux_slider/items', 'id');
    }

    public static function addNewImage($data){

        $resource = Mage::getSingleton('core/resource');
        $writeConnection = $resource->getConnection('core_write');

        $slider_id = $data['slider_id'];
        $item_name = $data['item_name'];
        $item_file_name = $data['slider_image'];
        $item_address = $data['image_path'];
        $item_header_text = $data['item_header_text'];
        $item_link = $data['item_link'];
        $button_text = $data['button_text'];

        if($item_header_text != ''){
            $has_header = 1;
        }else{
            $has_header = 0;
        }

        if($item_link != ''){
            $has_link = 1;
        }else{
            $has_link = 0;
        }

        if($button_text != ''){
            $has_button = 1;
        }else{
            $has_button = 0;
        }

        $insert_query = "INSERT INTO hellux_slider_items (
                                                           slider_id,
                                                           item_name,
                                                           item_address,
                                                           has_header,
                                                           has_link,
                                                           has_button,
                                                           item_header_text,
                                                           item_link,
                                                           button_text,
                                                           item_file_name
                                                           ) VALUES(
                                                           '$slider_id',
                                                           '$item_name',
                                                           '$item_address',
                                                           '$has_header',
                                                           '$has_link',
                                                           '$has_button',
                                                           '$item_header_text',
                                                           '$item_link',
                                                           '$button_text',
                                                           '$item_file_name'
                                                           )";

        $success = $writeConnection->query($insert_query);

        if(!$success){
            throw new Exception($success->errorInfo());
        }else{
            Mage::getSingleton('adminhtml/session')->addSuccess('Obrazek został dodany');
        }

    }//END function addNewImage($data)

    public static function getPictureData($id){

        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $get_query = ("SELECT * FROM hellux_slider_items WHERE id = '$id'");
        $result = $readConnection->query($get_query);
        return $result;

    }//END getPictureData($id)

    public static function editImage($data){

        $resource = Mage::getSingleton('core/resource');
        $writeConnection = $resource->getConnection('core_write');


        $obrazek_id = $data['obrazek_id'];
        $item_name = $data['item_name'];
        if(isset($data['slider_image'])){//if is not set means we are editing without image change
            $item_file_name = $data['slider_image'];
            $item_address = $data['image_path'];
        }

        $item_header_text = $data['item_header_text'];
        $item_link = $data['item_link'];
        $button_text = $data['button_text'];

        if($item_header_text != ''){
            $has_header = 1;
        }else{
            $has_header = 0;
        }

        if($item_link != ''){
            $has_link = 1;
        }else{
            $has_link = 0;
        }

        if($button_text != ''){
            $has_button = 1;
        }else{
            $has_button = 0;
        }

        if(isset($data['slider_image'])){//we must write query to change image and path as well

            $update_query = "UPDATE hellux_slider_items SET
                       item_name = '$item_name',
                       item_address = '$item_address',
                       has_header = '$has_header',
                       has_link = '$has_link',
                       has_button = '$has_button',
                       item_header_text = '$item_header_text',
                       item_link = '$item_link',
                       button_text = '$button_text',
                       item_file_name = '$item_file_name'
                       WHERE id = '$obrazek_id'
                       ";

        }else{//we must write query to NOT change image and path

            $update_query = "UPDATE hellux_slider_items SET
                       item_name = '$item_name',
                       has_header = '$has_header',
                       has_link = '$has_link',
                       has_button = '$has_button',
                       item_header_text = '$item_header_text',
                       item_link = '$item_link',
                       button_text = '$button_text'
                       WHERE id = '$obrazek_id'
                       ";

        }

        $success = $writeConnection->query($update_query);

        if(!$success){
            throw new Exception($success->errorInfo());
        }else{
            Mage::getSingleton('adminhtml/session')->addSuccess('Obrazek edytowany poprawnie');
        }

    } //END function editImage($data)

}//END CLASS