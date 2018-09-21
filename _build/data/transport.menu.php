<?php
/**
 * Adds modActions and modMenus into package
 *
 * @package formalicious
 * @subpackage build
 */

/* load action into menu */
$menu= $modx->newObject('modMenu');
$menu->fromArray(array(
    'text' => 'formalicious',
    'parent' => 'components',
    'description' => 'formalicious.menu_desc',
    'icon' => 'images/icons/plugin.gif',
    'menuindex' => 0,
    'params' => '',
    'handler' => '',
    'namespace' => 'formalicious',
    'action' => 'home'
),'',true,true);

return $menu;