<?php
/**
 * Update an Item
 *
 * @package formalicious
 * @subpackage processors
 */

class FormaliciousFieldTypeUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'FormaliciousFieldType';
    public $languageTopics = array('formalicious:default');

    public function beforeSet() {
        $name = $this->getProperty('name');

        if (empty($name)) {
            $this->addFieldError('name',$this->modx->lexicon('formalicious.category_err_ns_name'));

        } else if ($this->modx->getCount($this->classKey, array('name' => $name)) && ($this->object->name != $name)) {
            $this->addFieldError('name',$this->modx->lexicon('formalicious.category_err_ae'));
        }
        return parent::beforeSet();
    }

}
return 'FormaliciousFieldTypeUpdateProcessor';