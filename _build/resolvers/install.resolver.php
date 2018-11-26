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

/**
 * Resolve changes to db model on install and upgrade.
 *
 * @package goodnews
 * @subpackage build
 */

/**
 * Checks if a field in a specified database table exist
 *
 * @param mixed &$modx A reference to the MODX object
 * @param string $xpdoTableClass xPDO schema class name for the database table
 * @param string $field Name of the field to check
 * @return boolean
 */
if (!function_exists('existsField')) {
    function existsField(&$modx, $xpdoTableClass, $field) {

        $existsField = true;

        $table = $modx->getTableName($xpdoTableClass);
        $sql = "SHOW COLUMNS FROM {$table} LIKE '".$field."'";
        $stmt = $modx->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        $stmt->closeCursor();

        if ($count < 1) {
            $existsField = false;
        }
        return $existsField;
    }
}

/**
 * Checks if a field in a specified database table exist and creates it if not.
 * (this prevents the annoying erro messages in MODX install log)
 *
 * @param mixed &$modx A reference to the MODX object
 * @param mixed &$manager A reference to the Manager object
 * @param string $xpdoTableClass xPDO schema class name for the database table
 * @param string $field Name of the field to create
 * @param string $after Name of the field after which the new field should be placed (Optional)
 * @return void
 */
if (!function_exists('checkAddField')) {
    function checkAddField(&$modx, &$manager, $xpdoTableClass, $field, $after = '') {

        if (existsField($modx, $xpdoTableClass, $field)) { return; }

        $options = array();
        if (!empty($after)) $options['after'] = $after;
        $manager->addField($xpdoTableClass, $field, $options);
    }
}

if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx        =& $object->xpdo;
            $iconBaseUrl = trim(MODX_BASE_URL, '/') . '/assets/components/formalicious/img/';

            /* setup default types */
            createType(
                $modx, [
                'name' => 'Text', 'tpl' => 'textTpl', 'answertpl' => '', 'values' => 0, 'validation' => '', 'icon' => ''
            ]
            );

            createType(
                $modx, [
                'name'       => 'Dropdown', 'tpl' => 'selectTpl', 'answertpl' => 'selectInnerTpl', 'values' => 1,
                'validation' => '', 'icon' => ''
            ]
            );

            createType(
                $modx, [
                'name'   => 'Radiobuttons', 'tpl' => 'radiobuttonsTpl', 'answertpl' => 'radiobuttonsInnerTpl',
                'values' => 1, 'validation' => '', 'icon' => ''
            ]
            );

            createType(
                $modx, [
                'name'       => 'Checkboxes', 'tpl' => 'checkboxesTpl', 'answertpl' => 'checkboxInnerTpl',
                'values'     => 1, 'validation' => '', 'icon' => ''
            ]
            );

            createType(
                $modx, [
                'name' => 'Number', 'tpl' => 'textTpl', 'answertpl' => '', 'values' => 0, 'validation' => 'isNumber',
                'icon' => ''
            ]
            );

            createType(
                $modx, [
                'name' => 'Email', 'tpl' => 'emailTpl', 'answertpl' => '', 'values' => 0, 'validation' => 'email',
                'icon' => ''
            ]
            );

            createType(
                $modx, [
                'name' => 'Textarea', 'tpl' => 'textareaTpl', 'answertpl' => '', 'values' => 0, 'validation' => '',
                'icon' => ''
            ]
            );

            createType(
                $modx, [
                'name' => 'File', 'tpl' => 'fileTpl', 'answertpl' => '', 'values' => 0, 'validation' => '', 'icon' => ''
            ]
            );

            createType(
                $modx, [
                'name' => 'Heading', 'tpl' => 'headingTpl', 'answertpl' => '', 'values' => 0, 'validation' => '',
                'icon' => ''
            ]
            );

            createType(
                $modx, [
                'name'       => 'Description', 'tpl' => 'descriptionTpl', 'answertpl' => '', 'values' => 0,
                'validation' => '', 'icon' => ''
            ]
            );

            createCategory(
                $modx, [
                'name'      => 'Default', 'description' => 'This is the default category to store your forms.',
                'published' => 1,
            ]
            );

            $table = $modx->getTableName('FormaliciousForm');
            $c     = $modx->prepare("SHOW COLUMNS IN {$table} WHERE Field = 'fiarcontent';");
            if ($c->execute() && $data = $c->fetch(PDO::FETCH_ASSOC)) {
                if (stripos($data['Type'], 'varchar') === 0) {
                    $c = $modx->prepare("ALTER TABLE {$table} CHANGE `fiarcontent` `fiarcontent` TEXT;");
                    $c->execute();
                }
            }
            break;

            $modx->addPackage('formalicious', $modelPath, null);

            $manager = $modx->getManager();
            // First add the new field
            checkAddField($modx, $manager, 'FormaliciousStep', 'description');
            checkAddField($modx, $manager, 'FormaliciousField', 'description');
            checkAddField($modx, $manager, 'FormaliciousField', 'property');

    }
}

return true;
