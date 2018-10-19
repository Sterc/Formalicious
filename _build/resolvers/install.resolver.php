<?php
/**
 * Formalicious install resolver.
 * Creates the default types and adds the default category.
 *
 * @package formalicious
 * @subpackage build
 */
function createType(&$modx, $data)
{
    $ct = $modx->getCount('FormaliciousFieldType',array(
        'name' => $data['name'],
    ));
    if (empty($ct)) {
        $type = $modx->newObject('FormaliciousFieldType');
        $type->fromArray($data);
        $type->save();
    }
}
function createCategory(&$modx, $data)
{
    $ct = $modx->getCount('FormaliciousCategory',array(
        'name' => $data['name'],
        'published' => 1
    ));
    if (empty($ct)) {
        $category = $modx->newObject('FormaliciousCategory');
        $category->fromArray($data);
        $category->save();
    }
}
if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        // case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;
            $iconBaseUrl = trim(MODX_BASE_URL, '/') . '/assets/components/formalicious/img/';

            /* setup default types */
            createType($modx,array(
                'name' => 'Text',
                'tpl' => 'textTpl',
                'answertpl' => '',
                'values' => 0,
                'validation' => '',
                'icon' => ''
            ));

            createType($modx,array(
                'name' => 'Dropdown',
                'tpl' => 'selectTpl',
                'answertpl' => 'selectInnerTpl',
                'values' => 1,
                'validation' => '',
                'icon' => ''
            ));

            createType($modx,array(
                'name' => 'Radiobuttons',
                'tpl' => 'radiobuttonsTpl',
                'answertpl' => 'radiobuttonsInnerTpl',
                'values' => 1,
                'validation' => '',
                'icon' => ''
            ));

            createType($modx,array(
                'name' => 'Checkboxes',
                'tpl' => 'checkboxesTpl',
                'answertpl' => 'checkboxInnerTpl',
                'values' => 1,
                'validation' => '',
                'icon' => ''
            ));

            createType($modx,array(
                'name' => 'Number',
                'tpl' => 'textTpl',
                'answertpl' => '',
                'values' => 0,
                'validation' => 'isNumber',
                'icon' => ''
            ));

            createType($modx,array(
                'name' => 'Email',
                'tpl' => 'emailTpl',
                'answertpl' => '',
                'values' => 0,
                'validation' => 'email',
                'icon' => ''
            ));

            createType($modx,array(
                'name' => 'Textarea',
                'tpl' => 'textareaTpl',
                'answertpl' => '',
                'values' => 0,
                'validation' => '',
                'icon' => ''
            ));

            createType($modx,array(
                'name' => 'File',
                'tpl' => 'fileTpl',
                'answertpl' => '',
                'values' => 0,
                'validation' => '',
                'icon' => ''
            ));

            createType($modx,array(
                'name' => 'Heading',
                'tpl' => 'headingTpl',
                'answertpl' => '',
                'values' => 0,
                'validation' => '',
                'icon' => ''
            ));

            createType($modx,array(
                'name' => 'Description',
                'tpl' => 'descriptionTpl',
                'answertpl' => '',
                'values' => 0,
                'validation' => '',
                'icon' => ''
            ));

            createCategory($modx,array(
                'name' => 'Default',
                'description' => 'This is the default category to store your forms.',
                'published' => 1,
            ));
        break;
    }
}
return true;