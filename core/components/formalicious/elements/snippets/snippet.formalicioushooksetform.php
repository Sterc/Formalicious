<?php

    /**
     * Formalicious FormIt posthook for saving posted values to session.
     */

    $formit =& $hook->formit;
    $values = $hook->getValues();

    if (isset($_SESSION['Formalicious_form_' . $formit->config['formid']])) {
        $values = array_merge($_SESSION['Formalicious_form_' . $formit->config['formid']], $values);
    }

    $_SESSION['Formalicious_form_' . $formit->config['formid']] = $values;

    return true;

?>