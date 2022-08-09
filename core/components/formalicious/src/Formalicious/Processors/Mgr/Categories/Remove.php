<?php
namespace Sterc\Formalicious\Processors\Mgr\Categories;

use MODX\Revolution\Processors\Model\RemoveProcessor;
use Sterc\Formalicious\Model\FormaliciousCategory;

class Remove extends RemoveProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = FormaliciousCategory::class;

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['formalicious:default'];

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'formalicious.category';
}
