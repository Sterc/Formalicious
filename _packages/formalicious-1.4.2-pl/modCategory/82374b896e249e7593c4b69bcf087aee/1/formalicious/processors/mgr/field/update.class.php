<?php
/**
 * Update a form field
 *
 * @package formalicious
 * @subpackage processors
 */

class FormaliciousUpdateProcessor extends modObjectUpdateProcessor
{
    public $classKey = 'FormaliciousField';
    public $languageTopics = array('formalicious:default');

    public function beforeSet()
    {
        $this->setProperty('hidden', 'false');
        if (!$this->getProperty('published')) {
            $this->setProperty('published', 'false');
        }
        if (!$this->getProperty('required')) {
            $this->setProperty('required', 'false');
        }
        $this->setCheckbox('published');
        $this->setCheckbox('required');

        if ($this->object->type == 10) {
            $this->setProperty('hidden', 'true');
        }

        return parent::beforeSet();
    }

    public function beforeSave()
    {
        /* If field type is set to a non-multiple values type (text, email etc.)
        remove previously saved answers to prevent redundant data in DB */
        $fieldType = $this->object->getOne('Type');
        if ($fieldType) {
            $enableValues = $fieldType->get('values');
            if (!$enableValues) {
                $formFieldAnswers = $this->object->getMany('Answers');
                foreach ($formFieldAnswers as $answer) {
                    $answer->remove();
                }
            }
        }
        return parent::beforeSave();
    }

}
return 'FormaliciousUpdateProcessor';