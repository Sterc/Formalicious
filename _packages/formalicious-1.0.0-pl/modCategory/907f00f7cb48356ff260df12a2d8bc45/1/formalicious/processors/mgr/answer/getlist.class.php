<?php
/**
 * Get list Items
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousFieldGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'FormaliciousAnswer';
    public $languageTopics = array('formalicious:default');
    public $defaultSortField = 'rank';
    public $defaultSortDirection = 'ASC';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $field_id = $this->getProperty('field_id');
        if (!empty($field_id)) {
            $c->where(array(
                'field_id' => $field_id,
            ));
        }
        return $c;
    }

}
return 'FormaliciousFieldGetListProcessor';