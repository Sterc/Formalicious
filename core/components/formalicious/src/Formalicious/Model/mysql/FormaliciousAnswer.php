<?php
namespace Sterc\Formalicious\Model\mysql;

use xPDO\xPDO;
use Sterc\Formalicious\Model\FormaliciousField;

class FormaliciousAnswer extends \Sterc\Formalicious\Model\FormaliciousAnswer
{
    public static $metaMap = array (
        'package' => 'Sterc\\Formalicious\\Model\\',
        'version' => NULL,
        'table' => 'formalicious_answers',
        'extends' => 'xPDOSimpleObject',
        'tableMeta' =>
        array (
            'engine' => 'InnoDB',
        ),
        'fields' =>
        array (
            'field_id' => 0,
            'name' => '',
            'rank' => NULL,
            'published' => 0,
            'selected' => 0,
            'subfield_id' => 0,
        ),
        'fieldMeta' =>
        array (
            'field_id' =>
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
            'rank' =>
            array (
                'dbtype' => 'int',
                'precision' => '10',
                'phptype' => 'integer',
                'null' => false,
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
            'selected' =>
            array (
                'dbtype' => 'tinyint',
                'precision' => '1',
                'attributes' => 'unsigned',
                'phptype' => 'boolean',
                'null' => false,
                'default' => 0,
                'index' => 'index',
            ),
            'subfield_id' =>
            array (
                'dbtype' => 'int',
                'precision' => '10',
                'phptype' => 'integer',
                'null' => false,
                'default' => 0,
                'index' => 'index',
            ),
        ),
        'indexes' =>
        array (
            'field_id' =>
            array (
                'alias' => 'field_id',
                'primary' => false,
                'unique' => false,
                'type' => 'BTREE',
                'columns' =>
                array (
                    'field_id' =>
                    array (
                        'length' => '',
                        'collation' => 'A',
                        'null' => false,
                    ),
                ),
            ),
            'published' =>
            array (
                'alias' => 'selected',
                'primary' => false,
                'unique' => false,
                'type' => 'BTREE',
                'columns' =>
                array (
                    'selected' =>
                    array (
                        'length' => '',
                        'collation' => 'A',
                        'null' => false,
                    ),
                ),
            ),
            'rank' =>
            array (
                'alias' => 'rank',
                'primary' => false,
                'unique' => false,
                'type' => 'BTREE',
                'columns' =>
                array (
                    'rank' =>
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
            'Field' =>
            array (
                'class' => FormaliciousField::class,
                'local' => 'field_id',
                'foreign' => 'id',
                'cardinality' => 'one',
                'owner' => 'foreign',
            ),
        ),
    );

}
