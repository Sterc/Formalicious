<?php
use Sterc\Formalicious\Hooks\RemoveForm;

$instance = new RemoveForm($modx);

return $instance->run($hook, $errors);