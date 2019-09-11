<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

class FormaliciousFieldCreateProcessor extends modObjectCreateProcessor
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
    public $objectType = 'formalicious.field';

    /**
     * @access public.
     * @return Mixed.
     */
    public function initialize()
    {
        $this->modx->getService('formalicious', 'Formalicious', $this->modx->getOption('formalicious.core_path', null, $this->modx->getOption('core_path') . 'components/formalicious/') . 'model/formalicious/');

        if (null === $this->getProperty('published')) {
            $this->setProperty('published', 0);
        }

        if (null === $this->getProperty('directional')) {
            $this->setProperty('directional', 0);
        }

        if (null === $this->getProperty('required')) {
            $this->setProperty('required', 0);
        }

        return parent::initialize();
    }

    /**
     * @access public.
     * @return Mixed.
     */
    public function beforeSave()
    {
        $query = $this->modx->newQuery($this->classKey, [
            'step_id' => $this->getProperty('step_id')
        ]);
        $query->sortby('rank', 'DESC');
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

return 'FormaliciousFieldCreateProcessor';
