<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

$xpdo_meta_map['FormaliciousCategory'] = array(
    'package'       => 'formalicious',
    'version'       => '1.0',
    'table'         => 'formalicious_categories',
    'extends'       => 'xPDOSimpleObject',
    'tableMeta'     => array(
        'engine'        => 'MyISAM'
    ),
    'fields'        => array(
        'id'            => '',
        'name'          => '',
        'description'   => '',
        'published'     => 1,
    ),
    'fieldMeta'     => array(
        'id'            => array(
            'dbtype'        => 'int',
            'precision'     => '11',
            'phptype'       => 'integer',
            'null'          => false,
            'index'         => 'pk',
            'generated'     => 'native'
        ),
        'name'          => array(
            'dbtype'        => 'varchar',
            'precision'     => '255',
            'phptype'       => 'string',
            'null'          => false,
            'default'       => ''
        ),
        'description'   => array(
            'dbtype'        => 'text',
            'phptype'       => 'string',
            'null'          => false,
            'default'       => '',
        ),
        'published'     => array(
            'dbtype'        => 'tinyint',
            'precision'     => '1',
            'attributes'    => 'unsigned',
            'phptype'       => 'boolean',
            'null'          => false,
            'default'       => 1,
            'index'         => 'index'
        ),
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
                )
            )
        )
    ),
    'aggregates'    => array(
        'Forms'         => array(
            'class'         => 'FormaliciousForm',
            'local'         => 'id',
            'foreign'       => 'category_id',
            'cardinality'   => 'many',
            'owner'         => 'local'
        )
    )
);
