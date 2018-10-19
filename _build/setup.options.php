<?php
/**
 * Formalicious setup options
 *
 * @package Formalicious
 * @subpackage build
 */
$package = 'Formalicious';

$settings = [
    [
        'key' => 'user_name', 'value' => '', 'name' => 'Name',
    ], [
        'key' => 'user_email', 'value' => '', 'name' => 'E-mailaddress',
    ], [
        'key' => 'option.allow_savesubmittedforms', 'value' => '1', 'name' => 'Save submitted forms',
    ],
];

/**
 * The needed permissions.
 */
$permissions = [
    [
        'name'      => 'formalicious_advanced', 'description' => 'To view the advanced tab.',
        'templates' => ['AdministratorTemplate'],
    ],
];

switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
        foreach ($settings as $key => $setting) {
            $settingObject = $modx->getObject(
                'modSystemSetting',
                ['key' => strtolower($package) . '.' . $setting['key']]
            );
            if ($settingObject) {
                $settings[$key]['value'] = $settingObject->get('value');
            }
        }

        /**
         * Add the needed permissions.
         */
        foreach ($modx->getCollection('modAccessPolicyTemplate') as $templateObject) {
            foreach ($permissions as $permission) {
                if (!isset($permission['templates']) ||
                    in_array($templateObject->get('name'), $permission['templates'])) {
                    $permission = array_merge(
                        $permission,
                        ['template' => $templateObject->get('id'), 'value' => 1,]
                    );

                    $c = [
                        'name' => $permission['name'], 'template' => $permission['template'],
                    ];

                    if (null === $modx->getObject('modAccessPermission', $c)) {
                        if (null !== ($permissionObject = $modx->newObject('modAccessPermission'))) {
                            $permissionObject->fromArray($permission);
                            $permissionObject->save();
                        }
                    }
                }
            }
        }

        foreach ($modx->getCollection('modAccessPolicy') as $policyObject) {
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


        break;
    case xPDOTransport::ACTION_UNINSTALL:
        break;
}

/* Hide default setuptoptions text */
$output[] = '
<style type="text/css">
    #modx-setupoptions-panel { display: none; }
</style>

<script>
    var setupTitle = "Formalicious installation - a MODX Extra by Sterc";
    document.getElementsByClassName("x-window-header-text")[0].innerHTML = setupTitle;
</script>

<h2>Get free priority updates</h2>
<p>Enter your name and email address below to receive priority updates about our extras.
Be the first to know about updates and new features.
<i><b>It is NOT required to enter your name and email to use this extra.</b></i></p>';

foreach ($settings as $setting) {
    $str = '<label for="'. $setting['key'] .'">'. $setting['name'] .' (optional)</label>';
    $str .= '<input type="text" name="'. $setting['key'] .'"';
    $str .= ' id="'. $setting['key'] .'" width="300" value="'. $setting['value'] .'" />';

    $output[] = $str;
}

return implode('<br /><br />', $output);
