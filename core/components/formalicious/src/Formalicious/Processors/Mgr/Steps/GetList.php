<?php
namespace Sterc\Formalicious\Processors\Mgr\Steps;

use MODX\Revolution\Processors\Model\GetListProcessor;
use Sterc\Formalicious\Model\FormaliciousStep;
use xPDO\Om\xPDOQuery;

class GetList extends GetListProcessor
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
    public $objectType = 'formalicious.step';

    /**
     * @access public.
     * @param xPDOQuery $criteria.
     * @return xPDOQuery.
     */
    public function prepareQueryBeforeCount(xPDOQuery $criteria)
    {
        $formId = $this->getProperty('form_id');

        if (!empty($formId)) {
            $criteria->where(['form_id' => $formId]);
        }

        return $criteria;
    }
}
