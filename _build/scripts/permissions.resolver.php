<?php

use xPDO\Transport\xPDOTransport;
use MODX\Revolution\modAccessPolicyTemplate;
use MODX\Revolution\modAccessPolicy;
use MODX\Revolution\modAccessPermission;

$package = 'Formalicious';

$permissions = [[
    'name'          => 'formalicious',
    'description'   => 'To view the formalicious package.',
    'templates'     => ['AdministratorTemplate']
], [
    'name'          => 'formalicious_admin',
    'description'   => 'To view the formalicious package, admin part.',
    'templates'     => ['AdministratorTemplate'],
    'policies'      => ['Administrator']
], [
    'name'          => 'formalicious_tab_advanced',
    'description'   => 'To view the formalicious package, advanced tab.',
    'templates'     => ['AdministratorTemplate']
], [
    'name'          => 'formalicious_tab_fields',
    'description'   => 'To view the formalicious package, fields tab.',
    'templates'     => ['AdministratorTemplate']
]];

$success = false;

if ($transport->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $transport->xpdo;

            foreach ($modx->getCollection(modAccessPolicyTemplate::class) as $accessTemplate) {
                foreach ($permissions as $permission) {
                    if (!isset($permission['templates']) || in_array($accessTemplate->get('name'), $permission['templates'])) {
                        $accessPermission = $modx->getObject(modAccessPermission::class, [
                            'name'      => $permission['name'],
                            'template'  => $accessTemplate->get('id')
                        ]);

                        if (!$accessPermission) {
                            $accessPermission = $modx->newObject(modAccessPermission::class);

                            if ($accessPermission) {
                                $accessPermission->fromArray(array_merge($permission, [
                                    'template'  => $accessTemplate->get('id'),
                                    'value'     => 1
                                ]));

                                $accessPermission->save();
                            }
                        }
                    }
                }
            }

            foreach ($modx->getCollection(modAccessPolicy::class) as $accessPolicy) {
                $data = $accessPolicy->get('data');

                foreach ($permissions as $permission) {
                    if (isset($permission['policies'])) {
                        if (in_array($accessPolicy->get('name'), $permission['policies'], true)) {
                            $data[$permission['name']] = true;
                        } else {
                            $data[$permission['name']] = false;
                        }
                    } else {
                        $data[$permission['name']] = true;
                    }
                }

                $accessPolicy->set('data', $data);
                $accessPolicy->save();
            }

            $success = true;

            break;
        case xPDOTransport::ACTION_UNINSTALL:
            $success = true;

            break;
    }
}

return $success;
