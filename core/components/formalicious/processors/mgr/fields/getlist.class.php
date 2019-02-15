<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

class FormaliciousFieldGetListProcessor extends modObjectGetListProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = 'FormaliciousField';

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
     * @return Mixed.
     */
    public function initialize()
    {
        $this->modx->getService('formalicious', 'Formalicious', $this->modx->getOption('formalicious.core_path', null, $this->modx->getOption('core_path') . 'components/formalicious/') . 'model/formalicious/');

        return parent::initialize();
    }

    /**
     * @access public.
     * @param xPDOQuery $criteria.
     * @return xPDOQuery.
     */
    public function prepareQueryBeforeCount(xPDOQuery $criteria)
    {
        $criteria->setClassAlias('Field');

        $criteria->select($this->modx->getSelectColumns('FormaliciousField', 'Field'));
        $criteria->select($this->modx->getSelectColumns('FormaliciousFieldType', 'Type', 'type_', ['name', 'values']));

        $criteria->leftJoin('FormaliciousFieldType', 'Type');

        $stepId = $this->getProperty('step_id');

        if (!empty($stepId)) {
            $criteria->where([
                'Field.step_id' => $stepId
            ]);
        }

        $formId = $this->getProperty('form_id');

        if (!empty($formId)) {
            $criteria->leftJoin('FormaliciousStep', 'Step');

            $criteria->where([
                'Step.form_id' => $formId
            ]);
        }

        $query = $this->getProperty('query');

        if (!empty($query)) {
            $criteria->where([
                'Field.title:LIKE' => '%' . $query . '%'
            ]);
        }

        return $criteria;
    }
}

return 'FormaliciousFieldGetListProcessor';
