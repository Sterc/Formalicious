<?php
/**
 * Resolve creating db tables
 *
 * THIS RESOLVER IS AUTOMATICALLY GENERATED, NO CHANGES WILL APPLY
 *
 * @package formalicious
 * @subpackage build
 *
 * @var mixed $object
 * @var modX $modx
 * @var array $options
 */

if ($object->xpdo) {
    $modx =& $object->xpdo;
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modelPath = $modx->getOption('formalicious.core_path', null, $modx->getOption('core_path') . 'components/formalicious/') . 'model/';
            
            $modx->addPackage('formalicious', $modelPath, null);



            $manager = $modx->getManager();

            $manager->createObjectContainer('FormaliciousCategory');
            $manager->createObjectContainer('FormaliciousForm');
            $manager->createObjectContainer('FormaliciousStep');
            $manager->createObjectContainer('FormaliciousFieldType');
            $manager->createObjectContainer('FormaliciousField');
            $manager->createObjectContainer('FormaliciousSubField');
            $manager->createObjectContainer('FormaliciousAnswer');


            break;
    }
}

return true;