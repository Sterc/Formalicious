<?php
/**
 * Create an Item
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousCategoryCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'FormaliciousStep';
    public $languageTopics = array('formalicious:default');

    public function beforeSet(){
    	$form_id = $this->getProperty('form_id');
        $items = $this->modx->getCollection($this->classKey, array('form_id' => $form_id));

        $this->setProperty('rank', count($items));

        return parent::beforeSet();
    }
}
return 'FormaliciousCategoryCreateProcessor';
