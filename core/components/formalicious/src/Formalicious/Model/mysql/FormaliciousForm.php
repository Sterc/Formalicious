<?php
namespace Sterc\Formalicious\Model\mysql;

use xPDO\xPDO;

class FormaliciousForm extends \Sterc\Formalicious\Model\FormaliciousForm
{

    public static $metaMap = array (
        'package' => 'Sterc\\Formalicious\\Model\\',
        'version' => NULL,
        'table' => 'formalicious_forms',
        'extends' => 'xPDOSimpleObject',
        'tableMeta' => 
        array (
            'engine' => 'InnoDB',
        ),
        'fields' => 
        array (
            'category_id' => 0,
            'name' => '',
            'published' => 0,
            'published_from' => '0000-00-00 00:00:00',
            'published_till' => '0000-00-00 00:00:00',
            'saveform' => 0,
            'redirectto' => 0,
            'email' => 0,
            'emailto' => '',
            'emailsubject' => '',
            'emailcontent' => '',
            'fiaremail' => 0,
            'fiaremailto' => 0,
            'fiaremailfrom' => '',
            'fiaremailsubject' => '',
            'fiaremailcontent' => '',
            'fiaremailattachment' => '',
            'prehooks' => '',
            'posthooks' => '',
            'parameters' => '',
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
            'published_from' => 
            array (
                'dbtype' => 'timestamp',
                'precision' => '1',
                'phptype' => 'timestamp',
                'null' => false,
                'default' => '0000-00-00 00:00:00',
            ),
            'published_till' => 
            array (
                'dbtype' => 'timestamp',
                'precision' => '1',
                'phptype' => 'timestamp',
                'null' => false,
                'default' => '0000-00-00 00:00:00',
            ),
            'saveform' => 
            array (
                'dbtype' => 'tinyint',
                'precision' => '1',
                'attributes' => 'unsigned',
                'phptype' => 'boolean',
                'null' => false,
                'default' => 0,
                'index' => 'index',
            ),
            'redirectto' => 
            array (
                'dbtype' => 'int',
                'precision' => '10',
                'attributes' => 'unsigned',
                'phptype' => 'integer',
                'null' => false,
                'default' => 0,
            ),
            'email' => 
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
                'phptype' => 'string',
                'null' => false,
                'default' => '',
            ),
            'emailsubject' => 
            array (
                'dbtype' => 'varchar',
                'precision' => '255',
                'phptype' => 'string',
                'null' => false,
                'default' => '',
            ),
            'emailcontent' => 
            array (
                'dbtype' => 'text',
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
            'fiaremailto' => 
            array (
                'dbtype' => 'int',
                'precision' => '11',
                'attributes' => 'unsigned',
                'phptype' => 'integer',
                'null' => false,
                'default' => 0,
            ),
            'fiaremailfrom' => 
            array (
                'dbtype' => 'text',
                'phptype' => 'string',
                'null' => false,
                'default' => '',
            ),
            'fiaremailsubject' => 
            array (
                'dbtype' => 'varchar',
                'precision' => '255',
                'phptype' => 'string',
                'null' => false,
                'default' => '',
            ),
            'fiaremailcontent' => 
            array (
                'dbtype' => 'text',
                'phptype' => 'string',
                'null' => false,
                'default' => '',
            ),
            'fiaremailattachment' => 
            array (
                'dbtype' => 'text',
                'phptype' => 'string',
                'null' => false,
                'default' => '',
            ),
            'prehooks' => 
            array (
                'dbtype' => 'varchar',
                'precision' => '255',
                'phptype' => 'string',
                'null' => false,
                'default' => '',
            ),
            'posthooks' => 
            array (
                'dbtype' => 'varchar',
                'precision' => '255',
                'phptype' => 'string',
                'null' => false,
                'default' => '',
            ),
            'parameters' => 
            array (
                'dbtype' => 'text',
                'phptype' => 'string',
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
        'composites' => 
        array (
            'Steps' => 
            array (
                'class' => 'FormaliciousStep',
                'local' => 'id',
                'foreign' => 'form_id',
                'cardinality' => 'many',
                'owner' => 'local',
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
        ),
    );

}
