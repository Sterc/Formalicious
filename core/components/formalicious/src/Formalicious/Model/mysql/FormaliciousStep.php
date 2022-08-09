<?php
namespace Sterc\Formalicious\Model\mysql;

use xPDO\xPDO;
use  Sterc\Formalicious\Model\FormaliciousForm;
use Sterc\Formalicious\Model\FormaliciousField;

class FormaliciousStep extends \Sterc\Formalicious\Model\FormaliciousStep
{

    public static $metaMap = array (
        'package' => 'Sterc\\Formalicious\\Model\\',
        'version' => NULL,
        'table' => 'formalicious_steps',
        'extends' => 'xPDOSimpleObject',
        'tableMeta' =>
        array (
            'engine' => 'InnoDB',
        ),
        'fields' =>
        array (
            'form_id' => 0,
            'title' => '',
            'description' => '',
            'button' => '',
            'rank' => NULL,
            'published' => 0,
        ),
        'fieldMeta' =>
        array (
            'form_id' =>
            array (
                'dbtype' => 'int',
                'precision' => '10',
                'phptype' => 'integer',
                'null' => false,
                'default' => 0,
                'index' => 'index',
            ),
            'title' =>
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
            'button' =>
            array (
                'dbtype' => 'varchar',
                'precision' => '75',
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
                'phptype' => 'integer',
                'null' => false,
                'default' => 0,
            ),
        ),
        'indexes' =>
        array (
            'form_id' =>
            array (
                'alias' => 'form_id',
                'primary' => false,
                'unique' => false,
                'type' => 'BTREE',
                'columns' =>
                array (
                    'form_id' =>
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
        'composites' =>
        array (
            'Fields' =>
            array (
                'class' => FormaliciousField::class,
                'local' => 'id',
                'foreign' => 'step_id',
                'cardinality' => 'many',
                'owner' => 'local',
            ),
        ),
        'aggregates' =>
        array (
            'Form' =>
            array (
                'class' => FormaliciousForm::class,
                'local' => 'form_id',
                'foreign' => 'id',
                'cardinality' => 'one',
                'owner' => 'foreign',
            ),
        ),
    );

}
