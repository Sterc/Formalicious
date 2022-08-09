<?php
namespace Sterc\Formalicious\Processors\Mgr\Categories;

use MODX\Revolution\Processors\Model\GetListProcessor;
use Sterc\Formalicious\Model\FormaliciousCategory;

class GetList extends GetListProcessor
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
    public $defaultSortField = 'name';

    /**
     * @access public.
     * @var String.
     */
    public $defaultSortDirection = 'ASC';

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'formalicious.category';
}
