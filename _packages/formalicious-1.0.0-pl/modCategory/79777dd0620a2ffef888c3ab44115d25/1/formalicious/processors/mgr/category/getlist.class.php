<?php
/**
 * Get list Items
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousCategoryGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'FormaliciousCategory';
    public $languageTopics = array('formalicious:default');
    public $defaultSortField = 'name';
    public $defaultSortDirection = 'ASC';
}
return 'FormaliciousCategoryGetListProcessor';