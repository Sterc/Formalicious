<?php
/**
 * Formalicious uninstall resolver.
 *
 * @package formalicious
 * @subpackage build
 */

$success = true;
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_UNINSTALL:
        $menuItem = $object->xpdo->getObject('modMenu', 'formalicious');
        if ($menuItem) {
            $menuItem->remove();
        }
        $success = true;
        break;
}

return $success;
