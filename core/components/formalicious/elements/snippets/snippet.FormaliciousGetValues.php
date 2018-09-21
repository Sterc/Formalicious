<?php
/**
 * Formalicious FormIt prehook for retrieving previously posted values from session
 */
$formit =& $hook->formit;
$values = $hook->getValues();

$oldValues = $_SESSION['Formalicious_form_'.$formit->config['formid']];
if (!$oldValues) {
    $oldValues = array();
}

$_SESSION['Formalicious_form_'.$formit->config['formid']] = array_merge($oldValues, $values);
$hook->setValues($_SESSION['Formalicious_form_'.$formit->config['formid']]);

$modx->toPlaceholders(
    $_SESSION['Formalicious_form_'.$formit->config['formid']],
    'fi'
);

return true;