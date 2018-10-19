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
        'key' => 'user_name', 'value' => '', 'type' => 'text', 'name' => 'Name',
    ], [
        'key' => 'user_email', 'value' => '', 'type' => 'text', 'name' => 'E-mailaddress',
    ], [
        'key' => 'option.allow_savesubmittedforms', 'value' => '1', 'type' => 'checkbox', 'name' => 'Save submitted forms',
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
    $str .= '<input type="' . $setting['type'] . '" name="'. $setting['key'] .'"';
    $str .= ' id="'. $setting['key'] .'" value="'. $setting['value'] .'" />';

    $output[] = $str;
}

return implode('<br /><br />', $output);
