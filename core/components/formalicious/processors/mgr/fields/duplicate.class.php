<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

class FormaliciousFieldDuplicateProcessor extends modObjectDuplicateProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = 'FormaliciousField';

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
            $newAnswer = $this->modx->newObject('FormaliciousAnswer');

            if ($newAnswer) {
                $newAnswer->fromArray($answer->toArray());

                $newAnswers[] = $newAnswer;
            }
        }

        $this->newObject->addMany($newAnswers);

        return parent::beforeSave();
    }
}

return 'FormaliciousFieldDuplicateProcessor';
