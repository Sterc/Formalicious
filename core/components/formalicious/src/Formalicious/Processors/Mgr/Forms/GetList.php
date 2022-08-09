<?php
namespace Sterc\Formalicious\Processors\Mgr\Forms;

use MODX\Revolution\Processors\Model\GetListProcessor;
use Sterc\Formalicious\Model\FormaliciousForm;
use xPDO\Om\xPDOQuery;
use xPDO\Om\xPDOObject;

class GetList extends GetListProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = FormaliciousForm::class;

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
    public $objectType = 'formalicious.form';

    /**
     * @access public.
     * @return Mixed.
     */
    public function initialize()
    {
        $this->setDefaultProperties([
            'dateFormat' => $this->modx->getOption('manager_date_format') . ', ' . $this->modx->getOption('manager_time_format')
        ]);

        return parent::initialize();
    }

    /**
     * @access public.
     * @param xPDOQuery $criteria.
     * @return xPDOQuery.
     */
    public function prepareQueryBeforeCount(xPDOQuery $criteria)
    {
        $category = $this->getProperty('category');

        if (!empty($category)) {
            $criteria->where([
                'category_id' => $category
            ]);
        }

        $query = $this->getProperty('query');

        if (!empty($query)) {
            $criteria->where([
                'name:LIKE'             => '%' . $query . '%',
                'OR:emailto:LIKE'       => '%' . $query . '%',
                'OR:fiaremailto:LIKE'   => '%' . $query . '%'
            ]);
        }

        return $criteria;
    }

    /**
     * @access public.
     * @param xPDOObject $object
     * @return Array.
     */
    public function prepareRow(xPDOObject $object)
    {
        $array = $object->toArray();

        if (in_array($object->get('published_from'), ['-001-11-30 00:00:00', '-1-11-30 00:00:00', '0000-00-00 00:00:00', null], true)) {
            $array['published_from'] = '';
        } else {
            $array['published_from'] = date($this->getProperty('dateFormat'), strtotime($object->get('published_from')));
        }

        if (in_array($object->get('published_till'), ['-001-11-30 00:00:00', '-1-11-30 00:00:00', '0000-00-00 00:00:00', null], true)) {
            $array['published_till'] = '';
        } else {
            $array['published_till'] = date($this->getProperty('dateFormat'), strtotime($object->get('published_till')));
        }

        if (!empty($array['published_from']) && strtotime($array['published_from']) >= time()) {
            $array['published'] = 0;
        }

        if (!empty($array['published_till']) && strtotime($array['published_till']) <= time()) {
            $array['published'] = 0;
        }

        return $array;
    }
}