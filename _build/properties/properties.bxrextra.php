<?php
/**
 * Properties for the Formalicious snippet.
 *
 * @package formalicious
 * @subpackage build
 */
$properties = array(
    array(
        'name' => 'tpl',
        'desc' => 'prop_formalicious.tpl_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 'Item',
        'lexicon' => 'formalicious:properties',
    ),
    array(
        'name' => 'sortBy',
        'desc' => 'prop_formalicious.sortby_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 'name',
        'lexicon' => 'formalicious:properties',
    ),
    array(
        'name' => 'sortDir',
        'desc' => 'prop_formalicious.sortdir_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 'ASC',
        'lexicon' => 'formalicious:properties',
    ),
    array(
        'name' => 'limit',
        'desc' => 'prop_formalicious.limit_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 5,
        'lexicon' => 'formalicious:properties',
    ),
    array(
        'name' => 'outputSeparator',
        'desc' => 'prop_formalicious.outputseparator_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => 'formalicious:properties',
    ),
    array(
        'name' => 'toPlaceholder',
        'desc' => 'prop_formalicious.toplaceholder_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => true,
        'lexicon' => 'formalicious:properties',
    ),
/*
    array(
        'name' => '',
        'desc' => 'prop_formalicious.',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => 'formalicious:properties',
    ),
    */
);

return $properties;