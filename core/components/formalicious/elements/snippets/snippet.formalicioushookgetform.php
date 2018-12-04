<?php

    /**
     * Formalicious FormIt prehook for retrieving previously posted values from session.
     */

    $formit =& $hook->formit;
    $values = $hook->getValues();

    if (isset($_SESSION['Formalicious_form_' . $formit->config['formid']])) {
        $values = array_merge($_SESSION['Formalicious_form_' . $formit->config['formid']], $values);
    }

    $hook->setValues($values);

    return true;

?>