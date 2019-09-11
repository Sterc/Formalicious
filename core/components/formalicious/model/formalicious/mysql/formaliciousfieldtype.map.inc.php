<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

$xpdo_meta_map['FormaliciousFieldType'] = array(
    'package'       => 'formalicious',
    'version'       => '1.0',
    'table'         => 'formalicious_fields_types',
    'extends'       => 'xPDOSimpleObject',
    'tableMeta'     => array(
        'engine'        => 'MyISAM'
    ),
    'fields'        => array(
        'id'            => '',
        'name'          => '',
        'tpl'           => '',
        'answertpl'     => '',
        'values'        => 0,
        'validation'    => '',
        'icon'          => '',
        'fields'        => ''
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
        'tpl'           => array(
            'dbtype'        => 'varchar',
            'precision'     => '255',
            'phptype'       => 'string',
            'null'          => false,
            'default'       => ''
        ),
        'answertpl'     => array(
            'dbtype'        => 'varchar',
            'precision'     => '255',
            'phptype'       => 'string',
            'null'          => false,
            'default'       => ''
        ),
        'values'        => array(
            'dbtype'        => 'tinyint',
            'precision'     => '1',
            'attributes'    => 'unsigned',
            'phptype'       => 'boolean',
            'null'          => false,
            'default'       => 0,
            'index'         => 'index'
        ),
        'validation'    => array(
            'dbtype'        => 'text',
            'phptype'       => 'string',
            'null'          => false,
            'default'       => ''
        ),
        'icon'          => array(
            'dbtype'        => 'varchar',
            'precision'     => '255',
            'phptype'       => 'string',
            'null'          => false,
            'default'       => ''
        ),
        'fields'        => array(
            'dbtype'        => 'text',
            'phptype'       => 'string',
            'null'          => false,
            'default'       => ''
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
        )
    ),
    'composites'    => array(
        'Fields'        => array(
            'class'         => 'FormaliciousField',
            'local'         => 'id',
            'foreign'       => 'type',
            'cardinality'   => 'many',
            'owner'         => 'local'
        )
    )
);
