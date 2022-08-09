<?php
namespace Sterc\Formalicious\Processors\Mgr\Fields;

use MODX\Revolution\Processors\Model\DuplicateProcessor;
use Sterc\Formalicious\Model\FormaliciousField;
use Sterc\Formalicious\Model\FormaliciousAnswer;

class Duplicate extends DuplicateProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = FormaliciousField::class;

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['formalicious:default'];

    /**
     * @access public.
     * @var String.
     */
    public $nameField = 'title';

    /**
     * @access public.
     * @return Mixed.
     */
    public function beforeSave()
    {
        $newAnswers = [];

        foreach ((array) $this->object->getMany('Answers') as $answer) {
            $newAnswer = $this->modx->newObject(FormaliciousAnswer::class);

            if ($newAnswer) {
                $newAnswer->fromArray($answer->toArray());

                $newAnswers[] = $newAnswer;
            }
        }

        $this->newObject->addMany($newAnswers);

        return parent::beforeSave();
    }
}
