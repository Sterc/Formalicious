<?php
use Sterc\Formalicious\Hooks\RenderForm;

$instance = new RenderForm($modx);

return $instance->run($hook, $errors);
