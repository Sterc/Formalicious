<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

class FormaliciousCategoryCreateProcessor extends modObjectCreateProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = 'FormaliciousCategory';

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

        return parent::initialize();
    }

    /**
     * @access public.
     * @return Mixed.
     */
    public function beforeSave() {
        $name = $this->getProperty('name');

        $query = [
            'name' => $name
        ];

        if (empty($name)) {
            $this->addFieldError('name', $this->modx->lexicon('formalicious.category_err_ns_name'));
        } else if ($this->doesAlreadyExist($query)) {
            $this->addFieldError('name', $this->modx->lexicon('formalicious.category_err_ae'));
        }

        return parent::beforeSave();
    }
}

return 'FormaliciousCategoryCreateProcessor';
