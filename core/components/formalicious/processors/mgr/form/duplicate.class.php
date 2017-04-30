<?php
/**
 * Duplicates a Formalicious form.
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousDuplicateProcessor extends modObjectDuplicateProcessor
{
    public $classKey = 'FormaliciousForm';
    public $languageTopics = array('formalicious:default');
    public $nameField = 'name';

    public function beforeSave()
    {
        /* copy form steps */
        $formSteps = $this->object->getMany('Steps');
        $newSteps = array();
        foreach ($formSteps as $step) {
            $newStep = $this->modx->newObject('FormaliciousStep');
            $newStep->fromArray($step->toArray());
            $newSteps[] = $newStep;
            /* Duplicate all the fields from this step */
            $formFields = $step->getMany('Fields');
            $newFields = array();
            foreach ($formFields as $field) {
                $newField = $this->modx->newObject('FormaliciousField');
                $newField->fromArray($field->toArray());
                $newFields[] = $newField;
                /* Duplicate all the field answers */
                $formFieldAnswers = $field->getMany('Answers');
                $newFieldAnswers = array();
                foreach ($formFieldAnswers as $fieldAnswer) {
                    $newFieldAnswer = $this->modx->newObject('FormaliciousAnswer');
                    $newFieldAnswer->fromArray($fieldAnswer->toArray());
                    $newFieldAnswers[] = $newFieldAnswer;
                }
                $newField->addMany($newFieldAnswers);
            }
            $newStep->addMany($newFields);
        }
        $this->newObject->addMany($newSteps);
        $this->newObject->set('fiaremailto', 0);

        return parent::beforeSave();
    }
}

return 'FormaliciousDuplicateProcessor';
