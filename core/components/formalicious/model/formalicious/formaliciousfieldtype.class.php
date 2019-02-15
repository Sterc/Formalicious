<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

class FormaliciousFieldType extends xPDOSimpleObject
{
    /**
     * @access public.
     * @param Boolean $required.
     * @return Array.
     */
    public function getValidation($required)
    {
        $validation = [];

        if ($required) {
            $validation[] = 'required';
        }

        if ($this->get('validation')) {
            foreach (array_filter(explode(',', $this->get('validation'))) as $rule) {
                $validation[] = trim($rule);
            }
        }

        return $validation;
    }
}
