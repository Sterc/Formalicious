<?php
/**
 * Remove an Item.
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'FormaliciousAnswer';
    public $languageTopics = array('formalicious:default');
}
return 'FormaliciousRemoveProcessor';