<?php
/**
 * Get list Items
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousFieldTypeGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'FormaliciousFieldType';
    public $languageTopics = array('formalicious:default');
    public $defaultSortField = 'name';
    public $defaultSortDirection = 'ASC';
}
return 'FormaliciousFieldTypeGetListProcessor';