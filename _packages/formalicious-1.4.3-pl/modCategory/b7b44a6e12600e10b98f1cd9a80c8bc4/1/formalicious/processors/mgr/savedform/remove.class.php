<?php
/**
 * Remove an Item.
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousSavedFormRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'FormaliciousSavedForm';
    public $languageTopics = array('formalicious:default');
}
return 'FormaliciousSavedFormRemoveProcessor';