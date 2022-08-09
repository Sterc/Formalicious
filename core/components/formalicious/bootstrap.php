<?php
require_once __DIR__ . '/vendor/autoload.php';

// Add your classes to modx's autoloader
$modx->addPackage('Sterc\Formalicious\Model', $namespace['path'] . 'src/', null, 'Sterc\\Formalicious\\');

// Register base class in the service container
$modx->services->add('formalicious', function() use ($modx) {
    return new \Sterc\Formalicious($modx);
});
