<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

class FormaliciousFieldSortProcessor extends modObjectProcessor
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

        return parent::initialize();
    }

    /**
     * @access public
     * @return Mixed.
     */
    public function process()
    {
        $i = 1;

        foreach (explode(',', $this->getProperty('order')) as $id) {
            $item = $this->modx->getObject($this->classKey, [
                'id' => $id
            ]);

            if ($item) {
                $item->set('rank', $i);

                if ($item->save()) {
                    $i++;
                }
            }
        }

        return $this->success('', []);
    }
}

return 'FormaliciousFieldSortProcessor';
