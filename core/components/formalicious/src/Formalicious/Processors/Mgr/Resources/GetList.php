<?php
namespace Sterc\Formalicious\Processors\Mgr\Resources;

use MODX\Revolution\Processors\Model\GetListProcessor;
use MODX\Revolution\modResource;
use xPDO\Om\xPDOQuery;
use xPDO\Om\xPDOObject;

class GetList extends GetListProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = modResource::class;

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['formalicious:default'];

    /**
     * @access public.
     * @var String.
     */
    public $defaultSortField = 'Resource.pagetitle';

    /**
     * @access public.
     * @var String.
     */
    public $defaultSortDirection = 'ASC';

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'formalicious.resource';

    /**
     * @access public.
     * @param xPDOQuery $criteria.
     * @return xPDOQuery.
     */
    public function prepareQueryBeforeCount(xPDOQuery $criteria)
    {
        $criteria->setClassAlias('Resource');

        $criteria->select($this->modx->getSelectColumns('modResource', 'Resource'));
        $criteria->select($this->modx->getSelectColumns('modContext', 'Context', 'context_', ['name']));

        $criteria->innerJoin('modContext', 'Context');

        $query = $this->getProperty('query');

        if (!empty($query)) {
            $criteria->where([
                'Resource.pagetitle:LIKE' => $query . '%'
            ]);
        }

        $criteria->sortby('context_key', 'ASC');

        return $criteria;
    }

    /**
     * @access public.
     * @param xPDOObject $object
     * @return Array.
     */
    public function prepareRow(xPDOObject $object)
    {
        return [
            'id'            => $object->get('id'),
            'pagetitle'     => $object->get('pagetitle') . ($this->modx->hasPermission('tree_show_resource_ids') ? ' (' . $object->get('id') . ')' : ''),
            'context_key'   => $object->get('context_key'),
            'context_name'  => $object->get('context_name')
        ];
    }
}
