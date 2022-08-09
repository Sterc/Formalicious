<?php
use xPDO\Transport\xPDOTransport;
use MODX\Revolution\modSystemSetting;

$package  = 'Formalicious';
$settings = ['user_name', 'user_email'];
$success  = false;

switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
        foreach ($settings as $key) {
            if (isset($options[$key])) {
                $settingObject = $transport->xpdo->getObject(modSystemSetting::class, ['key' => strtolower($package) . '.' . $key]);
                if (!$settingObject) {
                    $settingObject = $transport->xpdo->newObject(modSystemSetting::class);
                    $settingObject->set('key', strtolower($package) . '.' . $key);
                }

                $settingObject->set('value', $options[$key]);
                $settingObject->save();
            }
        }

        $success = true;
        break;
    case xPDOTransport::ACTION_UNINSTALL:
        $success = true;

        break;
}

return $success;
