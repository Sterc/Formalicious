<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

class FormaliciousStepCreateProcessor extends modObjectCreateProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = 'FormaliciousStep';

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['formalicious:default'];

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'formalicious.step';

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
     * @return Mixed.
     */
    public function beforeSave()
    {
        $query = $this->modx->newQuery($this->classKey, [
            'form_id' => $this->getProperty('form_id')
        ]);

        $query->sortby($this->classKey.'_rank', 'DESC');

        $query->limit(1);

        $object = $this->modx->getObject($this->classKey, $query);

        if ($object) {
            $this->object->set('rank', (int) $object->get('rank') + 1);
        } else {
            $this->object->set('rank', 0);
        }

        return parent::beforeSave();
    }
}

return 'FormaliciousStepCreateProcessor';
