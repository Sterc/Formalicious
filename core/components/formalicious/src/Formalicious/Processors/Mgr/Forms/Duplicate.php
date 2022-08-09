<?php
namespace Sterc\Formalicious\Processors\Mgr\Forms;

use MODX\Revolution\Processors\Model\DuplicateProcessor;
use Sterc\Formalicious\Model\FormaliciousForm;
use Sterc\Formalicious\Model\FormaliciousField;
use Sterc\Formalicious\Model\FormaliciousStep;
use Sterc\Formalicious\Model\FormaliciousAnswer;

class Duplicate extends DuplicateProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = FormaliciousForm::class;

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
            $newStep = $this->modx->newObject(FormaliciousStep::class);

            if ($newStep) {
                $newStep->fromArray($step->toArray());

                $newStepFields = [];

                foreach ((array) $step->getMany('Fields') as $field) {
                    $newField = $this->modx->newObject(FormaliciousField::class);

                    if ($newField) {
                        $newField->fromArray($field->toArray());
                        $newField->save();

                        if ((int) $field->get('id') === (int) $this->object->get('fiaremailto')) {
                            $this->newObject->set('fiaremailto', $newField->get('id'));
                        }

                        $newFieldAnswers = [];

                        foreach ((array) $field->getMany('Answers') as $fieldAnswer) {
                            $newFieldAnswer = $this->modx->newObject(FormaliciousAnswer::class);

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
