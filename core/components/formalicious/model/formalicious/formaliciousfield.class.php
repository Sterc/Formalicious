<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

class FormaliciousField extends xPDOSimpleObject
{
    /**
     * @access public.
     * @return String.
     */
    public function getName()
    {
        return 'field_' . $this->get('id');
    }

    /**
     * @access public.
     * @return String.
     */
    public function getDescription()
    {
        $content = $this->get('description');

        if (!empty($content)) {
            if (preg_match('/^<(.*?)>/si', $content)) {
                if (preg_match('/^<(i|em|b|strong|a)(.*?)>/si', $content)) {
                    return '<p>' . $content . '</p>';
                }
            } else {
                return '<p>' . $content . '</p>';
            }
        }

        return $content;
    }

    /**
     * @access public.
     * @return Mixed.
     */
    public function getDefaultValue()
    {
        $type = $this->getOne('Type');

        if ($type) {
            if ((int) $type->get('values') === 1) {
                $values = [];

                foreach ($this->getAnswers() as $answer) {
                    if ((int) $answer->get('selected') === 1) {
                        $values[] = $answer->get('name');
                    }
                }

                return $values;
            }
        }

        return '';
    }

    /**
     * @access public.
     * @return Array.
     */
    public function getAnswers()
    {
        $criteria = $this->xpdo->newQuery('FormaliciousAnswer', [
            'field_id'  => $this->get('id'),
            'published' => 1
        ]);

        $criteria->sortby('FormaliciousAnswer_rank', 'ASC');

        return $this->xpdo->getCollection('FormaliciousAnswer', $criteria);
    }

    /**
     * @access public.
     * @return Int.
     */
    public function getAnswersTotal()
    {
        $criteria = $this->xpdo->newQuery('FormaliciousAnswer', [
            'field_id'  => $this->get('id'),
            'published' => 1
        ]);

        return (int) $this->xpdo->getCount('FormaliciousAnswer', $criteria);
    }
}
