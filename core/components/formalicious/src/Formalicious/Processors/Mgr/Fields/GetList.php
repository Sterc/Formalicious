<?php
namespace Sterc\Formalicious\Processors\Mgr\Fields;

use MODX\Revolution\Processors\Model\GetListProcessor;
use Sterc\Formalicious\Model\FormaliciousField;
use Sterc\Formalicious\Model\FormaliciousFieldType;
use Sterc\Formalicious\Model\FormaliciousStep;
use xPDO\Om\xPDOQuery;

class GetList extends GetListProcessor
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
    public $defaultSortField = 'Field.rank';

    /**
     * @access public.
     * @var String.
     */
    public $defaultSortDirection = 'ASC';

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'formalicious.field';

    /**
     * @access public.
     * @param xPDOQuery $criteria.
     * @return xPDOQuery.
     */
    public function prepareQueryBeforeCount(xPDOQuery $criteria)
    {
        $criteria->setClassAlias('Field');
        $criteria->select($this->modx->getSelectColumns(FormaliciousField::class, 'Field'));
        $criteria->select($this->modx->getSelectColumns(FormaliciousFieldType::class, 'Type', 'type_', ['name', 'values']));
        $criteria->leftJoin(FormaliciousFieldType::class, 'Type');

        $stepId = $this->getProperty('step_id');
        if (!empty($stepId)) {
            $criteria->where(['Field.step_id' => $stepId]);
        }

        $formId = $this->getProperty('form_id');
        if (!empty($formId)) {
            $criteria->leftJoin(FormaliciousStep::class, 'Step');

            $criteria->where(['Step.form_id' => $formId]);
        }

        $query = $this->getProperty('query');
        if (!empty($query)) {
            $criteria->where(['Field.title:LIKE' => '%' . $query . '%']);
        }

        return $criteria;
    }
}
