<?php
namespace Sterc\Formalicious\Processors\Mgr\Steps;

use MODX\Revolution\Processors\Model\UpdateProcessor;
use Sterc\Formalicious\Model\FormaliciousStep;

class Update extends UpdateProcessor
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
}
