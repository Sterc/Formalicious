<?php
namespace Sterc\Formalicious\Model\mysql;

use xPDO\xPDO;

class FormaliciousFieldType extends \Sterc\Formalicious\Model\FormaliciousFieldType
{

    public static $metaMap = array (
        'package' => 'Sterc\\Formalicious\\Model\\',
        'version' => NULL,
        'table' => 'formalicious_fields_types',
        'extends' => 'xPDOSimpleObject',
        'tableMeta' => 
        array (
            'engine' => 'InnoDB',
        ),
        'fields' => 
        array (
            'name' => '',
            'tpl' => '',
            'answertpl' => '',
            'values' => 0,
            'validation' => '',
            'icon' => '',
            'fields' => '',
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
            'answertpl' => 
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
                'attributes' => 'unsigned',
                'phptype' => 'boolean',
                'null' => false,
                'default' => 0,
                'index' => 'index',
            ),
            'validation' => 
            array (
                'dbtype' => 'text',
                'phptype' => 'string',
                'null' => false,
                'default' => '',
            ),
            'icon' => 
            array (
                'dbtype' => 'varchar',
                'precision' => '255',
                'phptype' => 'string',
                'null' => false,
                'default' => '',
            ),
            'fields' => 
            array (
                'dbtype' => 'text',
                'phptype' => 'string',
                'null' => false,
                'default' => '',
            ),
        ),
        'composites' => 
        array (
            'Fields' => 
            array (
                'class' => 'FormaliciousField',
                'local' => 'id',
                'foreign' => 'type',
                'cardinality' => 'many',
                'owner' => 'local',
            ),
        ),
    );

}
