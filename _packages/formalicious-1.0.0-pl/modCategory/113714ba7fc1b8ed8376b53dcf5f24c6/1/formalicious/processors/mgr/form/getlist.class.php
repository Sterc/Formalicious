<?php
/**
 * Get list Items
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'FormaliciousForm';
    public $languageTopics = array('formalicious:default');
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'ASC';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $category = $this->getProperty('category');
        if (!empty($category)) {
            $c->where(array(
                    'category_id' => $category,
                ));
        }
        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                'name:LIKE' => '%'.$query.'%'
            ));
        }
        return $c;
    }
}
return 'FormaliciousGetListProcessor';