<?php
namespace Sterc\Formalicious\Model\mysql;

use xPDO\xPDO;
use Sterc\Formalicious\Model\FormaliciousForm;

class FormaliciousCategory extends \Sterc\Formalicious\Model\FormaliciousCategory
{

    public static $metaMap = array (
        'package' => 'Sterc\\Formalicious\\Model\\',
        'version' => NULL,
        'table' => 'formalicious_categories',
        'extends' => 'xPDOSimpleObject',
        'tableMeta' =>
        array (
            'engine' => 'InnoDB',
        ),
        'fields' =>
        array (
            'name' => '',
            'description' => '',
            'published' => 0,
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
            'description' =>
            array (
                'dbtype' => 'text',
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
        ),
        'indexes' =>
        array (
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
            'Forms' =>
            array (
                'class' => FormaliciousForm::class,
                'local' => 'id',
                'foreign' => 'category_id',
                'cardinality' => 'many',
                'owner' => 'local',
            ),
        ),
    );

}
