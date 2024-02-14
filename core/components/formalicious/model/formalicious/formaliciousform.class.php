<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

class FormaliciousForm extends xPDOSimpleObject
{
    /**
     * @access public.
     * @return Boolean.
     */
    public function isPublished()
    {
        if (!in_array($this->get('published_from'), ['-001-11-30 00:00:00', '-1-11-30 00:00:00', '0000-00-00 00:00:00', null], true)) {
            if (strtotime($this->get('published_from')) >= time()) {
                return false;
            }
        }

        if (!in_array($this->get('published_till'), ['-001-11-30 00:00:00', '-1-11-30 00:00:00', '0000-00-00 00:00:00', null], true)) {
            if (strtotime($this->get('published_till')) <= time()) {
                return false;
            }
        }

        return (int) $this->get('published') === 1;
    }

    /**
     * @access public.
     * @return Array.
     */
    public function getParameters()
    {
        $parameters = [];

        if ($this->get('parameters')) {
            foreach ((array) json_decode($this->get('parameters'), true) as $value) {
                if (isset($value['key'], $value['value'])) {
                    $parameters[$value['key']] = $value['value'];
                }
            }
        }

        return $parameters;
    }

    /**
     * @access public.
     * @return Array.
     */
    public function getSteps()
    {
        $criteria = $this->xpdo->newQuery('FormaliciousStep', [
            'form_id' => $this->get('id')
        ]);

        $criteria->sortby('FormaliciousStep_rank', 'ASC');

        return $this->xpdo->getCollection('FormaliciousStep', $criteria);
    }

    /**
     * @access public.
     * @return Int.
     */
    public function getStepsTotal()
    {
        $criteria = $this->xpdo->newQuery('FormaliciousStep', [
            'form_id' => $this->get('id')
        ]);

        return (int) $this->xpdo->getCount('FormaliciousStep', $criteria);
    }
}
