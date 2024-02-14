<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

class FormaliciousStep extends xPDOSimpleObject
{
    /**
     * @access public.
     * @return Array.
     */
    public function getFields()
    {
        $criteria = $this->xpdo->newQuery('FormaliciousField', [
            'step_id'   => $this->get('id'),
            'published' => 1
        ]);

        $criteria->sortby('FormaliciousField_rank', 'ASC');

        return $this->xpdo->getCollection('FormaliciousField', $criteria);
    }

    /**
     * @access public.
     * @return Int.
     */
    public function getFieldsTotal()
    {
        $criteria = $this->xpdo->newQuery('FormaliciousField', [
            'step_id'   => $this->get('id'),
            'published' => 1
        ]);

        return (int) $this->xpdo->getCount('FormaliciousField', $criteria);
    }
}
