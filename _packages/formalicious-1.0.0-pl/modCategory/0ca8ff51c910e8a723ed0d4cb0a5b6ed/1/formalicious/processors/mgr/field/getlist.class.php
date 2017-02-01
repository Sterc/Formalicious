<?php
/**
 * Get list Items
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousFieldGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'FormaliciousField';
    public $languageTopics = array('formalicious:default');
    public $defaultSortField = 'rank';
    public $defaultSortDirection = 'ASC';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $step_id = $this->getProperty('step_id');
        if (!empty($step_id)) {
            $c->where(array(
                'step_id' => $step_id,
            ));
        }
        $form_id = $this->getProperty('form_id');
        if (!empty($form_id)) {
            $c->innerJoin('FormaliciousStep','FormaliciousStep', 'FormaliciousStep.id = FormaliciousField.step_id');
            $c->where(array(
                'FormaliciousStep.form_id' => $form_id
            ));
        }
        return $c;
    }

    public function prepareRow(xPDOObject $object) {
        $type = $object->getOne('Type');
        if($type){
            $object->set('show-values', $type->get('values'));
            $object->set('typetext', $type->get('name'));
        }
        return parent::prepareRow($object);
    }
}
return 'FormaliciousFieldGetListProcessor';