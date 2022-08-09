<?php
namespace Sterc\Formalicious\Processors\Mgr\Steps;

use MODX\Revolution\Processors\Model\RemoveProcessor;
use Sterc\Formalicious\Model\FormaliciousStep;

class Remove extends RemoveProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = FormaliciousStep::class;

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['formalicious:default'];

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'formalicious.step';

    /**
     * @access public.
     * @return Mixed.
     */
    public function afterRemove()
    {
        foreach ($this->object->getMany('Fields') as $field) {
            foreach ($field->getMany('Answers') as $anwer) {
                $anwer->remove();
            }

            $field->remove();
        }

        return parent::afterRemove();
    }
}
