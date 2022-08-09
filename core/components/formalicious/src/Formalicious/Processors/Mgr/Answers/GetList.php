<?php
namespace Sterc\Formalicious\Processors\Mgr\Answers;

use MODX\Revolution\Processors\Model\GetListProcessor;
use Sterc\Formalicious\Model\FormaliciousAnswer;
use xPDO\Om\xPDOQuery;

class GetList extends GetListProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = FormaliciousAnswer::class;

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['formalicious:default'];

    /**
     * @access public.
     * @var String.
     */
    public $defaultSortField = 'rank';

    /**
     * @access public.
     * @var String.
     */
    public $defaultSortDirection = 'ASC';

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'formalicious.field_value';

    /**
     * @access public.
     * @param xPDOQuery $criteria.
     * @return xPDOQuery.
     */
    public function prepareQueryBeforeCount(xPDOQuery $criteria)
    {
        $fieldId = $this->getProperty('field_id');

        if (!empty($fieldId)) {
            $criteria->where([
                'field_id' => $fieldId
            ]);
        }

        return $criteria;
    }
}
