<?php
/**
 * Create an Item
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousFieldCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'FormaliciousField';
    public $languageTopics = array('formalicious:default');

    public function beforeSave() {
        if(!$this->getProperty('published')) $this->setProperty('published', 'false');
        if(!$this->getProperty('fiaremail')) $this->setProperty('fiaremail', 'false');

        $this->setCheckbox('published');
        $this->setCheckbox('fiaremail');
        
        $count = $this->modx->getCount('FormaliciousField', array('step_id' => $this->getProperty('step_id')));
        $this->object->set('rank', ($count+1));
        return parent::beforeSave();
    }


    public function cleanup() {
        $type = $this->object->getOne('Type');
        if($type){
            $this->object->set('show-values', $type->get('values'));
            $this->object->set('typetext', $type->get('name'));
        }
        return $this->success('',$this->object);
    }
}
return 'FormaliciousFieldCreateProcessor';
