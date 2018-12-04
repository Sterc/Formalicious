<?php
/**
 * Remove an Item.
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'FormaliciousField';
    public $languageTopics = array('formalicious:default');
}
return 'FormaliciousRemoveProcessor';