<?php
/**
 * Loads system settings into build
 *
 * @package formalicious
 * @subpackage build
 */
$settings = array();

$settings['formalicious.source'] = $modx->newObject('modSystemSetting');
$settings['formalicious.source']->fromArray(array(
    'key' => 'formalicious.source',
    'value' => '1',
    'xtype' => 'textfield',
    'namespace' => 'formalicious',
    'area' => 'Paths',
), '', true, true);

return $settings;
