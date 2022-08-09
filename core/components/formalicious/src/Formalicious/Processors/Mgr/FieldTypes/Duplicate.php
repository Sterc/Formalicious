<?php
namespace Sterc\Formalicious\Processors\Mgr\FieldTypes;

use MODX\Revolution\Processors\Model\DuplicateProcessor;
use Sterc\Formalicious\Model\FormaliciousFieldType;

class Duplicate extends DuplicateProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = FormaliciousFieldType::class;

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
}
