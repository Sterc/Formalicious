<?php

/**
 * @var xPDOTransport $transport
 * @var array $object
 * @var array $fileMeta
 */
$transport->xpdo->loadClass('transport.xPDOObjectVehicle', XPDO_CORE_PATH, true, true);
$transport->xpdo->loadClass('modmoreVehicle', MODX_CORE_PATH . 'components/formalicious_vehicle/', true, true);
