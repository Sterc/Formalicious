<?php
use xPDO\Transport\xPDOTransport;

/**
 * Create tables
 *
 * THIS SCRIPT IS AUTOMATICALLY GENERATED, NO CHANGES WILL APPLY
 *
 * @package formalicious
 * @subpackage build.scripts
 *
 * @var \xPDO\Transport\xPDOTransport $transport
 * @var array $object
 * @var array $options
 */

$modx =& $transport->xpdo;

if ($options[xPDOTransport::PACKAGE_ACTION] === xPDOTransport::ACTION_UNINSTALL) return true;

$manager = $modx->getManager();

$manager->createObjectContainer(\Sterc\Formalicious\Model\FormaliciousAnswer::class);
$manager->createObjectContainer(\Sterc\Formalicious\Model\FormaliciousCategory::class);
$manager->createObjectContainer(\Sterc\Formalicious\Model\FormaliciousField::class);
$manager->createObjectContainer(\Sterc\Formalicious\Model\FormaliciousFieldType::class);
$manager->createObjectContainer(\Sterc\Formalicious\Model\FormaliciousForm::class);
$manager->createObjectContainer(\Sterc\Formalicious\Model\FormaliciousStep::class);

return true;
