<?php
namespace Sterc\Formalicious\Processors\Mgr\Answers;

use MODX\Revolution\Processors\Model\RemoveProcessor;
use Sterc\Formalicious\Model\FormaliciousAnswer;

class Remove extends RemoveProcessor
{
    /**
     * @access public.
     * @var string.
     */
    public $classKey = FormaliciousAnswer::class;

    /**
     * @access public.
     * @var array.
     */
    public $languageTopics = ['formalicious:default'];

    /**
     * @access public.
     * @var string.
     */
    public $objectType = 'formalicious.field_value';
}
