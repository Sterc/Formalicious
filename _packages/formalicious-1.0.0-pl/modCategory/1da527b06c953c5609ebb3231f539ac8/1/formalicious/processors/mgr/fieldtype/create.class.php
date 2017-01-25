<?php
/**
 * Create an Item
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousFieldTypeCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'FormaliciousFieldType';
    public $languageTopics = array('formalicious:default');

    public function beforeSave() {
        $name = $this->getProperty('name');

        if (empty($name)) {
            $this->addFieldError('name',$this->modx->lexicon('formalicious.category_err_ns_name'));
        } else if ($this->doesAlreadyExist(array('name' => $name))) {
            $this->addFieldError('name',$this->modx->lexicon('formalicious.category_err_ae'));
        }
        return parent::beforeSave();
    }
}
return 'FormaliciousFieldTypeCreateProcessor';
