<?php
/**
 * @package formalicious
 */
$xpdo_meta_map['FormaliciousForm']= array (
  'package' => 'formalicious',
  'version' => NULL,
  'table' => 'formalicious_forms',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'category_id' => 0,
    'name' => '',
    'published' => 0,
    'emailto' => '',
    'subject' => '',
    'fiaremail' => 0,
    'fiaremailfrom' => '',
    'fiarsubject' => '',
    'fiarcontent' => '',
    'fiarattachment' => '',
  ),
  'fieldMeta' => 
  array (
    'category_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'index',
    ),
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'published' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'attributes' => 'unsigned',
      'phptype' => 'boolean',
      'null' => false,
      'default' => 0,
      'index' => 'index',
    ),
    'emailto' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'text',
      'null' => false,
      'default' => '',
    ),
    'subject' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'fiaremail' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'attributes' => 'unsigned',
      'phptype' => 'boolean',
      'null' => false,
      'default' => 0,
      'index' => 'index',
    ),
    'fiaremailfrom' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'text',
      'null' => false,
      'default' => '',
    ),
    'fiarsubject' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'fiarcontent' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'fiarattachment' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'text',
      'null' => false,
      'default' => '',
    ),
  ),
  'indexes' => 
  array (
    'category_id' => 
    array (
      'alias' => 'category_id',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'category_id' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'published' => 
    array (
      'alias' => 'published',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'published' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'aggregates' => 
  array (
    'Category' => 
    array (
      'class' => 'FormaliciousCategory',
      'local' => 'category_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'Steps' => 
    array (
      'class' => 'FormaliciousStep',
      'local' => 'id',
      'foreign' => 'form_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
