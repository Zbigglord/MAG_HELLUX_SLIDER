<?php
 /**
  * Created by PhpStorm.
  * User: BBJaga
  * Date: 2017-01-31
  * Time: 11:36
  */
 class Hellux_Slider_Block_Adminhtml_Slider_Grid_Grid extends Mage_Adminhtml_Block_Widget_Grid {

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
   $collection = Mage::getModel('hellux_slider/slider')->getCollection();
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
   $this->addColumn('slider_name',
       array(
           'header'=> $this->__('Nazwa slidera'),
           'align' => 'left',
           'width' => '30%',
           'index' => 'slider_name'
       )
   );
   $this->addColumn('date_added',
       array(
           'header'=> $this->__('Data dodania'),
           'align' => 'left',
           'width' => '30%',
           'index' => 'date_added'
       )
   );

   $this->addColumn('date_edited',
       array(
           'header'=> $this->__('Data edycji'),
           'align' => 'left',
           'width' => '30%',
           'index' => 'date_edited'
       )
   );

   $this->addColumn('active',
       array(
           'header'=> $this->__('Aktywny(0 = NIE)'),
           'align' => 'left',
           'width' => '30%',
           'index' => 'active'
       )
   );

   return parent::_prepareColumns();
  }

  public function getRowUrl($row)
  {
   return $this->getUrl('*/items/index', array('id' => $row->getId()));
  }

  protected function _prepareMassaction()
  {
   $modelPk = Mage::getModel('hellux_slider/slider')->getResource()->getIdFieldName();
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
