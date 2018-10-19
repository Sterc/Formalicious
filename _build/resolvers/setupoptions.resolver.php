<?php
/**
 * Formalicious setup options resolver
 *
 * @package Formalicious
 * @subpackage build
 */
$package = 'Formalicious';

$success = false;
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
        $settings = array(
            'user_name',
            'user_email',
            'option.allow_savesubmittedforms'
        );

        /**
         * The needed permissions.
         */
        $permissions = [
            [
                'name'          => 'formalicious_advanced',
                'description'   => 'To view the advanced tab.',
                'templates'     => ['AdministratorTemplate']
            ]
        ];

        /**
         * Add the needed permissions.
         */
        foreach ($object->xpdo->getCollection('modAccessPolicyTemplate') as $templateObject) {
            foreach ($permissions as $permission) {
                if (!isset($permission['templates']) || in_array($templateObject->get('name'), $permission['templates'])) {
                    $permission = array_merge($permission, [
                        'template'  => $templateObject->get('id'),
                        'value'     => 1
                    ]);

                    $c = array(
                        'name'      => $permission['name'],
                        'template'  => $permission['template']
                    );

                    if (null === $object->xpdo->getObject('modAccessPermission', $c)) {
                        if (null !== ($permissionObject = $object->xpdo->newObject('modAccessPermission'))) {
                            $permissionObject->fromArray($permission);
                            $permissionObject->save();
                        }
                    }
                }
            }
        }

        foreach ($object->xpdo->getCollection('modAccessPolicy') as $policyObject) {
            $data = $policyObject->get('data');

            foreach ($permissions as $permission) {
                if (isset($permission['policies'])) {
                    if (in_array($policyObject->get('name'), $permission['policies'])) {
                        $data[$permission['name']] = true;
                    } else {
                        $data[$permission['name']] = false;
                    }
                } else {
                    $data[$permission['name']] = true;
                }
            }

            $policyObject->set('data', $data);
            $policyObject->save();
        }


        foreach ($settings as $key) {
            if (isset($options[$key])) {
                $settingObject = $object->xpdo->getObject(
                    'modSystemSetting',
                    array('key' => strtolower($package) . '.' . $key)
                );

                if ($settingObject) {
                    $settingObject->set('value', $options[$key]);
                    $settingObject->save();
                } else {
                    $error = '[' . $package . '] ' . strtolower($package) . '.' . $key . ' setting could not be found,';
                    $error .= ' so the setting could not be changed.';

                    $object->xpdo->log(
                        xPDO::LOG_LEVEL_ERROR,
                        $error
                    );
                }
            }
        }

        $success = true;
        break;
    case xPDOTransport::ACTION_UNINSTALL:
        $success = true;
        break;
}

return $success;
