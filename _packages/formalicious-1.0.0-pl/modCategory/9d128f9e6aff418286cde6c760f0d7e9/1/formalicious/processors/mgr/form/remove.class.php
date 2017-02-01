<?php
/**
 * Remove an Item.
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'FormaliciousForm';
    public $languageTopics = array('formalicious:default');
}
return 'FormaliciousRemoveProcessor';