<?php
$formit =& $hook->formit;
$values = $hook->getValues();
$modx->sendRedirect($formit->config['redirectTo']);

return true;
