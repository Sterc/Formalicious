<?php
use Sterc\Formalicious\Hooks\HandleForm;

$instance = new HandleForm($modx);

return $instance->run($hook, $errors);