<?php
/**
 * @package formalicious
 */
$xpdo_meta_map['FormaliciousFieldType']= array (
  'package' => 'formalicious',
  'version' => NULL,
  'table' => 'formalicious_fields_types',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'name' => '',
    'tpl' => '',
    'values' => 0,
    'validation' => '',
  ),
  'fieldMeta' => 
  array (
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'tpl' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'values' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'phptype' => 'int',
      'null' => false,
      'default' => 0,
    ),
    'validation' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'text',
      'null' => false,
      'default' => '',
    ),
  ),
);
