<?php
/**
 * Created by PhpStorm.
 * User: BBJaga
 * Date: 2017-01-31
 * Time: 11:36
 */
class Hellux_Slider_Block_Adminhtml_Items_Grid_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct()
    {
        parent::__construct();
        $this->setId('id');
        $this->setDefaultSort('COLUMN_ID');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);

    }

    protected function _prepareCollection()
    {
        $edit_id = $this->getRequest()->getParam('id');
        $collection = Mage::getModel('hellux_slider/items')->getCollection()->addFieldToFilter('slider_id', $edit_id);
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('id',
            array(
                'header'=> $this->__('ID'),
                'align' => 'center',
                'width' => '10px',
                'index' => 'id'
            )
        );
        $this->addColumn('item_picture',
            array(
                'header'=> $this->__('Obrazek'),
                'align' => 'center',
                'width' => '70px',
                'index' => 'item_file_name',
                'renderer' => 'hellux_slider_block_adminhtml_items_grid_renderer_image'
            )
        );
        $this->addColumn('slider_id',
            array(
                'header'=> $this->__('Id slidera'),
                'align' => 'left',
                'width' => '10px',
                'index' => 'slider_id'
            )
        );
        $this->addColumn('item_name',
            array(
                'header'=> $this->__('Tytuł obrazka'),
                'align' => 'left',
                'width' => '70px',
                'index' => 'item_name'
            )
        );

        $this->addColumn('item_address',
            array(
                'header'=> $this->__('Adres obrazka'),
                'align' => 'left',
                'width' => '30%',
                'index' => 'item_address'
            )
        );
        $this->addColumn('item_file_name',
            array(
                'header'=> $this->__('Nazwa pliku'),
                'align' => 'left',
                'width' => '80px',
                'index' => 'item_file_name'
            )
        );

        $this->addColumn('item_header_text',
            array(
                'header'=> $this->__('Nagłówek'),
                'align' => 'left',
                'width' => '30%',
                'index' => 'item_header_text'
            )
        );

        $this->addColumn('item_link',
            array(
                'header'=> $this->__('Link'),
                'align' => 'left',
                'width' => '30%',
                'index' => 'item_link'
            )
        );

        $this->addColumn('button_text',
            array(
                'header'=> $this->__('Tekst przycisku'),
                'align' => 'left',
                'width' => '30%',
                'index' => 'button_text'
            )
        );

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/items/edit', array('edit_id' => $row->getId()));
    }

    protected function _prepareMassaction()
    {
        $modelPk = Mage::getModel('hellux_slider/items')->getResource()->getIdFieldName();
        $this->setMassactionIdField($modelPk);
        $this->getMassactionBlock()->setFormFieldName('ids');
        // $this->getMassactionBlock()->setUseSelectAll(false);

        $this->getMassactionBlock()->addItem('edit', array(
            'label'=> $this->__('edytuj'),
            'url'  => $this->getUrl('*/*/edit'),
        ));

        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> $this->__('usuń'),
            'url'  => $this->getUrl('*/*/massDelete'),
        ));
        return $this;
    }
}
