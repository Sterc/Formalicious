<?php
/**
 * Get list Items
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousSavedFormGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'FormaliciousSavedForm';
    public $languageTopics = array('formalicious:default');
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $form_id = $this->getProperty('form_id');
        $startDate = $this->getProperty('startDate');
        $endDate = $this->getProperty('endDate');


        if (!empty($form_id)) {
            $c->where(array(
                'form_id' => $form_id
            ));
        }

        if ($startDate != '') {
            $c->andCondition(array('time:>' => strtotime($startDate.' 00:00:00')));
        }
        if ($endDate != '') {
            $c->andCondition(array('time:<' => strtotime($endDate.' 23:59:59')));
        }

        return $c;
    }
}
return 'FormaliciousSavedFormGetListProcessor';