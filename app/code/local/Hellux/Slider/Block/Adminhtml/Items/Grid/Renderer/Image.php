<?php

/**
 * Created by Hellux.
 * User: Zbigglord
 * Date: 2017-02-04
 * Time: 06:54
 */
class Hellux_Slider_Block_Adminhtml_Items_Grid_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        return $this->_getValue($row);
    }
    protected function _getValue(Varien_Object $row)
    {
        $val = $row->getData($this->getColumn()->getIndex());
        $val = str_replace("no_selection", "", $val);
        $url = Mage::getBaseUrl('skin') . 'frontend' . DS . 'hellux' . DS . 'default' . DS . 'images' . DS .'slider'. DS . '' . $val;
        $out = "<img src=". $url ." style='vertical-align: middle;' width='128px'/>";
        return $out;
    }
}