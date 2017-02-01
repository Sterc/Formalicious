<?php
/**
 * Update an Item
 *
 * @package formalicious
 * @subpackage processors
 */

class FormaliciousAnswerUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'FormaliciousAnswer';
    public $languageTopics = array('formalicious:default');

    public function beforeSet() {
        if(!$this->getProperty('published')) $this->setProperty('published', 'false');

        $this->setCheckbox('published');
        return parent::beforeSet();
    }
}
return 'FormaliciousAnswerUpdateProcessor';