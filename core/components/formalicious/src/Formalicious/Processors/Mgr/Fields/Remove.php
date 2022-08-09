<?php
namespace Sterc\Formalicious\Processors\Mgr\Fields;

use MODX\Revolution\Processors\Model\RemoveProcessor;
use Sterc\Formalicious\Model\FormaliciousField;

class Remove extends RemoveProcessor
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
    public $objectType = 'formalicious.step';

    /**
     * @access public.
     * @return Mixed.
     */
    public function afterRemove()
    {
        foreach ($this->object->getMany('Answers') as $anwer) {
            $anwer->remove();
        }

        return parent::afterRemove();
    }
}
