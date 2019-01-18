<?php
/**
 * Get list Items
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousStepGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'FormaliciousStep';
    public $languageTopics = array('formalicious:default');
    public $defaultSortField = 'rank';
    public $defaultSortDirection = 'ASC';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $form = $this->getProperty('form');
        if (!empty($form)) {
            $c->where(array(
                'form_id' => $form
            ));
        }
        return $c;
    }
}
return 'FormaliciousStepGetListProcessor';