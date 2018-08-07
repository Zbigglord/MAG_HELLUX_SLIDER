<?php
 /**
  * Created by Hellux.
  * User: Zbigglord
  * Date: 2017-01-26
  * Time: 15:41
  */
 /* @var $installer Mage_Core_Model_Resource_Setup */
 $installer = $this;

 $installer->startSetup();


//All Sliders

 $tableName = $installer->getTable('hellux_slider/slider');
 if ($installer->getConnection()->isTableExists($tableName) !=  TRUE){

  $table = $installer->getConnection()
   ->newTable($tableName)
   ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
    array(
     'identity' => true,
     'unsigned' => true,
     'nullable' => false,
     'primary' => true,
    ),
    'Entity Id'
   )
   ->addColumn('slider_name', Varien_Db_Ddl_Table::TYPE_TEXT, 255,
    array(),
    'Nazwa slidera'
   )
   
   ->addColumn('date_added', Varien_Db_Ddl_Table::TYPE_DATE,
    null,
    array(),
    'Data dodania'
   )
   ->addColumn('date_edited', Varien_Db_Ddl_Table::TYPE_DATE,
    null,
    array(),
    'Data zakończenia'
   )

  ->addColumn('active', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
      array(
          'unsigned' => true,
          'nullable' => false,
          'default' => '0',
      ),
      'Tak / nie'
  );


  $installer->getConnection()->createTable($table);

 }//END All Sliders
 
 //All Slider Items

 $tableName = $installer->getTable('hellux_slider/items');
 if ($installer->getConnection()->isTableExists($tableName) !=  TRUE){

  $table = $installer->getConnection()
   ->newTable($tableName)
   ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
    array(
     'identity' => true,
     'unsigned' => true,
     'nullable' => false,
     'primary' => true,
    ),
    'Entity Id'
   )
   ->addColumn('slider_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255,
    array(),
    'Id slidera'
   )
    ->addColumn('item_name', Varien_Db_Ddl_Table::TYPE_TEXT, 255,
    array(),
    'Tytuł obrazka/filmu'
   )
      ->addColumn('item_file_name', Varien_Db_Ddl_Table::TYPE_TEXT, 255,
          array(),
          'Nazwa obrazka/filmu'
      )
    ->addColumn('item_address', Varien_Db_Ddl_Table::TYPE_TEXT, 255,
    array(),
    'Adres obrazka/filmu'
   )
    ->addColumn('has_header', Varien_Db_Ddl_Table::TYPE_TEXT, 10,
    array(),
    '1 jeśli ma 0 jeśli nie'
   )
    ->addColumn('has_link', Varien_Db_Ddl_Table::TYPE_TEXT, 10,
    array(),
    '1 jeśli ma 0 jeśli nie'
   )
    ->addColumn('has_button', Varien_Db_Ddl_Table::TYPE_TEXT, 10,
    array(),
    '1 jeśli ma 0 jeśli nie'
   )
   //if has link and has button
   
    ->addColumn('item_header_text', Varien_Db_Ddl_Table::TYPE_TEXT, 255,
    array(),
    'Header text'
   )
    ->addColumn('item_link', Varien_Db_Ddl_Table::TYPE_TEXT, 255,
    array(),
    'Item link'
   )
   ->addColumn('button_text', Varien_Db_Ddl_Table::TYPE_TEXT, 255,
    array(),
    'Text na buttonie (jeśli ma button)'
   );

  $installer->getConnection()->createTable($table);

 }//END All Slider Items



 $installer->endSetup();