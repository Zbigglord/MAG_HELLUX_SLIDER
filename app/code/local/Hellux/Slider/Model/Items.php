<?php

/**
 * Created by Hellux.
 * User: Zbigg
 * Date: 2017-01-27
 * Time: 09:22
 */
class Hellux_Slider_Model_Items extends Mage_Core_Model_Abstract
{

    public function _construct()
    {
        $this->_init('hellux_slider/items');
        parent::_construct();
    }

}//END slider model class