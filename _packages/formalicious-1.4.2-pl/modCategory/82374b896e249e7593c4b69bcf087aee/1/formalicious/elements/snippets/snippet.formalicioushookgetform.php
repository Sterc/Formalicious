<?php

    /**
     * Formalicious FormIt prehook for retrieving previously posted values from session.
     */

    $formit =& $hook->formit;
    $values = $hook->getValues();

    if (isset($_SESSION['Formalicious_form_' . $formit->config['formid']])) {
        $values = array_merge($_SESSION['Formalicious_form_' . $formit->config['formid']], $values);
    }

    $_SESSION['Formalicious_form_' . $formit->config['formid']] = $values;

    $hook->setValues($values);
    $modx->toPlaceholders(array_map(function ($v) {
        if (is_array($v)) {
            if (isset($v['name'])) {
                return $v['name'];
            }

            return implode(',', $v);
        }

        return $v;
    }, $values), rtrim($formit->config['placeholderPrefix'], '.'));

    return true;

?>