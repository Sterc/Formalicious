<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

$xpdo_meta_map['FormaliciousStep'] = array (
    'package'       => 'formalicious',
    'version'       => '1.0',
    'table'         => 'formalicious_steps',
    'extends'       => 'xPDOSimpleObject',
    'tableMeta'     => array(
        'engine' => 'MyISAM'
    ),
    'fields'        => array(
        'id'            => '',
        'form_id'       => '',
        'title'         => '',
        'description'   => '',
        'button'        => '',
        'rank'          => '',
        'published'     => 1,
    ),
    'fieldMeta'     => array (
        'id'            => array(
            'dbtype'        => 'int',
            'precision'     => '11',
            'phptype'       => 'integer',
            'null'          => false,
            'index'         => 'pk',
            'generated'     => 'native'
        ),
        'form_id'       => array(
            'dbtype'        => 'int',
            'precision'     => '10',
            'phptype'       => 'integer',
            'null'          => false,
            'default'       => 0,
            'index'         => 'index',
        ),
        'title'         => array(
            'dbtype'        => 'varchar',
            'precision'     => '255',
            'phptype'       => 'string',
            'null'          => false,
            'default'       => '',
        ),
        'description'   => array(
            'dbtype'        => 'text',
            'phptype'       => 'string',
            'null'          => false,
            'default'       => '',
        ),
        'button'        => array(
            'dbtype'        => 'varchar',
            'precision'     => '75',
            'phptype'       => 'string',
            'null'          => false,
            'default'       => '',
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
        'form_id'       => array(
            'alias'         => 'form_id',
            'primary'       => false,
            'unique'        => false,
            'type'          => 'BTREE',
            'columns'       => array(
                'form_id'       => array(
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
                )
            )
        ),
        'rank'          => array (
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
    'composites'    => array(
        'Fields'        => array(
            'class'         => 'FormaliciousField',
            'local'         => 'id',
            'foreign'       => 'step_id',
            'cardinality'   => 'many',
            'owner'         => 'local'
        )
    ),
    'aggregates'    => array(
        'Form'          => array(
            'class'         => 'FormaliciousForm',
            'local'         => 'form_id',
            'foreign'       => 'id',
            'cardinality'   => 'one',
            'owner'         => 'foreign'
        )
    )
);
