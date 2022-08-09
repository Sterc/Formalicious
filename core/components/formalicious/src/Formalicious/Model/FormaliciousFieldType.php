<?php
namespace Sterc\Formalicious\Model;

use xPDO\xPDO;

/**
 * Class FormaliciousFieldType
 *
 * @property string $name
 * @property string $tpl
 * @property string $answertpl
 * @property boolean $values
 * @property string $validation
 * @property string $icon
 * @property string $fields
 *
 * @property \FormaliciousField[] $Fields
 *
 * @package Sterc\Formalicious\Model
 */
class FormaliciousFieldType extends \xPDO\Om\xPDOSimpleObject
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
