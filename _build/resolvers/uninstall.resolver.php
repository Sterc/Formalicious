<?php
/**
 * Formalicious uninstall resolver.
 *
 * @package formalicious
 * @subpackage build
 */

switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_UNINSTALL:
        $menuItem = $object->xpdo->getObject('modMenu', 'formalicious');
        if ($menuItem) {
            $menuItem->remove();
        }
        break;
}

return true;
