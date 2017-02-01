<?php
/**
 * Create an Item
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousFieldCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'FormaliciousAnswer';
    public $languageTopics = array('formalicious:default');

    public function beforeSet(){
        $items = $this->modx->getCollection($this->classKey, array('field_id' => $this->getProperty('field_id')));
        $this->setProperty('rank', count($items));
        return parent::beforeSet();
    }

    // public function beforeSave() {
    //     if(!$this->getProperty('published')) $this->setProperty('published', 'false');
    //     if(!$this->getProperty('fiaremail')) $this->setProperty('fiaremail', 'false');

    //     $this->setCheckbox('published');
    //     $this->setCheckbox('fiaremail');
        
    //     $name = $this->getProperty('name');

    //     if (empty($name)) {
    //         $this->addFieldError('name',$this->modx->lexicon('formalicious.item_err_ns_name'));
    //     } else if ($this->doesAlreadyExist(array('name' => $name))) {
    //         $this->addFieldError('name',$this->modx->lexicon('formalicious.item_err_ae'));
    //     }
    //     return parent::beforeSave();
    // }
}
return 'FormaliciousFieldCreateProcessor';
