<?php
/**
 * Add tvs to build
 *
 * @package formalicious
 * @subpackage build
 */
$tvs = array();

$tvs[1]= $modx->newObject('modTemplateVar');
$tvs[1]->fromArray(array(
    'id' => 1,
    'caption' => 'Formalicious form',
    'name' => 'formalicious',
    'type' => 'listbox',
    'description' => '',
    'default_text' => '',
    'elements' => '@SELECT \'- Select a form -\' AS name, 0 AS id UNION ALL SELECT name,id FROM [[+PREFIX]]formalicious_forms WHERE published = 1',
    'input_properties' => array('allowBlank' => false)
));

return $tvs;