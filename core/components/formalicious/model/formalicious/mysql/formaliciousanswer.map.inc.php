<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

$xpdo_meta_map['FormaliciousAnswer'] = array(
    'package'       => 'formalicious',
    'version'       => '1.0',
    'table'         => 'formalicious_answers',
    'extends'       => 'xPDOSimpleObject',
    'tableMeta'     => array(
        'engine'        => 'MyISAM'
    ),
    'fields'        => array(
        'id'            => '',
        'field_id'      => 0,
        'name'          => '',
        'rank'          => '',
        'published'     => 0,
        'selected'      => '',
        'subfield_id'   => 0
    ),
    'fieldMeta'     =>  array(
        'id'            => array(
            'dbtype'        => 'int',
            'precision'     => '11',
            'phptype'       => 'integer',
            'null'          => false,
            'index'         => 'pk',
            'generated'     => 'native'
        ),
        'field_id'      => array(
            'dbtype'        => 'int',
            'precision'     => '10',
            'phptype'       => 'integer',
            'null'          => false,
            'default'       => 0,
            'index'         => 'index'
        ),
        'name'          => array(
            'dbtype'        => 'varchar',
            'precision'     => '255',
            'phptype'       => 'string',
            'null'          => false,
            'default'       => ''
        ),
        'rank'          => array(
            'dbtype'        => 'int',
            'precision'     => '10',
            'phptype'       => 'integer',
            'null'          => false
        ),
        'published'     => array(
            'dbtype'        => 'tinyint',
            'precision'     => '1',
            'attributes'    => 'unsigned',
            'phptype'       => 'boolean',
            'null'          => false,
            'default'       => 0,
            'index'         => 'index'
        ),
        'selected'      => array(
            'dbtype'        => 'tinyint',
            'precision'     => '1',
            'attributes'    => 'unsigned',
            'phptype'       => 'boolean',
            'null'          => false,
            'default'       => 0,
            'index'         => 'index'
        ),
        'subfield_id'   => array(
            'dbtype'        => 'int',
            'precision'     => '10',
            'phptype'       => 'integer',
            'null'          => false,
            'default'       => 0,
            'index'         => 'index'
        )
    ),
    'indexes'       => array(
        'PRIMARY'       => array(
            'alias'         => 'PRIMARY',
            'primary'       => true,
            'unique'        => true,
            'columns'       => array(
                'id'            => array(
                    'collation'     => 'A',
                    'null'          => false
                )
            )
        ),
        'field_id'      => array(
            'alias'         => 'field_id',
            'primary'       => false,
            'unique'        => false,
            'type'          => 'BTREE',
            'columns'       => array(
                'field_id'      => array(
                    'length'        => '',
                    'collation'     => 'A',
                    'null'          => false
                )
            )
        ),
        'published'     => array(
            'alias'         => 'published',
            'primary'       => false,
            'unique'        => false,
            'type'          => 'BTREE',
            'columns'       => array(
                'published'     => array(
                    'length'        => '',
                    'collation'     => 'A',
                    'null'          => false
                ),
            ),
        ),
        'selected'      => array(
            'alias'         => 'selected',
            'primary'       => false,
            'unique'        => false,
            'type'          => 'BTREE',
            'columns'       => array(
                'published'     => array(
                    'length'        => '',
                    'collation'     => 'A',
                    'null'          => false
                ),
            ),
        ),
        'rank'          => array(
            'alias'         => 'rank',
            'primary'       => false,
            'unique'        => false,
            'type'          => 'BTREE',
            'columns'       => array(
                'rank'          => array(
                    'length'        => '',
                    'collation'     => 'A',
                    'null'          => false
                )
            )
        )
    ),
    'aggregates'    => array(
        'Field'         => array(
            'class'         => 'FormaliciousField',
            'local'         => 'field_id',
            'foreign'       => 'id',
            'cardinality'   => 'one',
            'owner'         => 'foreign'
        )
    )
);
