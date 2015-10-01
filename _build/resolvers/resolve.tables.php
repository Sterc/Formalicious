<?php
/**
 * Resolve creating db tables
 *
 * @package formalicious
 * @subpackage build
 */
if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;
            $modelPath = $modx->getOption('formalicious.core_path',null,$modx->getOption('core_path').'components/formalicious/').'model/';
            $modx->addPackage('formalicious',$modelPath);

            $manager = $modx->getManager();
            $loglevel = $modx->setLogLevel(modX::LOG_LEVEL_ERROR);

            $manager->createObjectContainer('FormaliciousCategory');
            $manager->createObjectContainer('FormaliciousForm');
            $manager->createObjectContainer('FormaliciousStep');
            $manager->createObjectContainer('FormaliciousFieldType');
            $manager->createObjectContainer('FormaliciousField');
            $manager->createObjectContainer('FormaliciousSubField');
            $manager->createObjectContainer('FormaliciousAnswer');
            
            $manager->addField('FormaliciousForm', 'fiaremailto');
            $manager->addField('FormaliciousForm', 'saveform');
            $manager->addField('FormaliciousField', 'placeholder');

            $modx->setLogLevel($loglevel);
            break;

    }
}
return true;