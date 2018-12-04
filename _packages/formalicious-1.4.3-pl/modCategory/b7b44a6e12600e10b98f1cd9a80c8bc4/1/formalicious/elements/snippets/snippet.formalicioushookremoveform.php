<?php

    /**
     * Formalicious FormIt hook for removing posted values to session.
     */

    $formit =& $hook->formit;
    $values = $hook->getValues();

    if (isset($_SESSION['Formalicious_form_' . $formit->config['formid']])) {
        unset($_SESSION['Formalicious_form_' . $formit->config['formid']]);
    }

    return true;

?>