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
            /* Get and duplicate all the fields from this step */
            $formFields = $step->getMany('Fields');
            $newFields = array();
            foreach($formFields as $field) {
                $newField = $this->modx->newObject('FormaliciousField');
                $newField->fromArray($field->toArray());
                $newFields[] = $newField;
            }
            $newStep->addMany($newFields);
        }
        $this->newObject->addMany($newSteps);

        return parent::beforeSave();
    }
}

return 'FormaliciousDuplicateProcessor';
