<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

class FormaliciousFormDuplicateProcessor extends modObjectDuplicateProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = 'FormaliciousForm';

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['formalicious:default'];

    /**
     * @access public.
     * @var String.
     */
    public $nameField = 'name';

    /**
     * @access public.
     * @return Mixed.
     */
    public function beforeSave()
    {
        $newSteps = [];

        foreach ((array) $this->object->getMany('Steps') as $step) {
            $newStep = $this->modx->newObject('FormaliciousStep');

            if ($newStep) {
                $newStep->fromArray($step->toArray());

                $newStepFields = [];

                foreach ((array) $step->getMany('Fields') as $field) {
                    $newField = $this->modx->newObject('FormaliciousField');

                    if ($newField) {
                        $newField->fromArray($field->toArray());
                        $newField->save();

                        if ((int) $field->get('id') === (int) $this->object->get('fiaremailto')) {
                            $this->newObject->set('fiaremailto', $newField->get('id'));
                        }

                        $newFieldAnswers = [];

                        foreach ((array) $field->getMany('Answers') as $fieldAnswer) {
                            $newFieldAnswer = $this->modx->newObject('FormaliciousAnswer');

                            if ($newFieldAnswer) {
                                $newFieldAnswer->fromArray($fieldAnswer->toArray());

                                $newFieldAnswers[] = $newFieldAnswer;
                            }
                        }

                        $newField->addMany($newFieldAnswers);

                        $newStepFields[] = $newField;
                    }
                }

                $newStep->addMany($newStepFields);

                $newSteps[] = $newStep;
            }
        }

        $this->newObject->addMany($newSteps);

        return parent::beforeSave();
    }
}

return 'FormaliciousFormDuplicateProcessor';
