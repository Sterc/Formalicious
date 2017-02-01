<?php
$formit =& $hook->formit;

unset($_SESSION['Formalicious_form_' . $formit->config['formid']]);

return true;