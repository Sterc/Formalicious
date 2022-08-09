<?php

use xPDO\Transport\xPDOTransport;
use Sterc\Formalicious\Model\FormaliciousFieldType;
use Sterc\Formalicious\Model\FormaliciousCategory;

$package = 'Formalicious';

$fieldtypes = [[
    'name'          => 'Text',
    'tpl'           => 'formaliciousFieldTextTpl',
    'fields'        => 'placeholder,required,description'
], [
    'name'          => 'Select',
    'tpl'           => 'formaliciousFieldSelectTpl',
    'answertpl'     => 'formaliciousFieldSelectItemTpl',
    'fields'        => 'placeholder,required,description'
], [
    'name'          => 'Radiobuttons',
    'tpl'           => 'formaliciousFieldRadiobuttonsTpl',
    'answertpl'     => 'formaliciousFieldRadiobuttonsItemTpl',
    'fields'        => 'required,description'
], [
    'name'          => 'Checkboxes',
    'tpl'           => 'formaliciousFieldCheckboxesTpl',
    'answertpl'     => 'formaliciousFieldCheckboxesItemTpl',
    'fields'        => 'required,description'
], [
    'name'          => 'Number',
    'tpl'           => 'formaliciousFieldNumberTpl',
    'validation'    => 'isNumber',
    'fields'        => 'placeholder,required,description'
], [
    'name'          => 'Email',
    'tpl'           => 'formaliciousFieldEmailTpl',
    'validation'    => 'email',
    'fields'        => 'placeholder,required,description'
], [
    'name'          => 'Textarea',
    'tpl'           => 'formaliciousFieldTextareaTpl',
    'fields'        => 'placeholder,required,description'
], [
    'name'          => 'File',
    'tpl'           => 'formaliciousFieldFileTpl',
    'fields'        => 'placeholder,required,description'
], [
   'name'          => 'Heading',
   'tpl'           => 'formaliciousFieldHeadingTpl',
   'fields'        => 'description,property'
], [
   'name'          => 'Description',
   'tpl'           => 'formaliciousFieldDescriptionTpl',
   'fields'        => 'description'
]];

$categories = [[
    'name'          => 'Default',
    'description'   => 'This is the default category to store your forms.',
    'published'     => 1
]];

$success = false;

if ($transport->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $transport->xpdo;

            foreach ($fieldtypes as $fieldType) {
                if (isset($fieldType['name'])) {
                    $object = $modx->getObject(FormaliciousFieldType::class, ['name' => $fieldType['name']]);
                    if (!$object) {
                        $object = $modx->newObject(FormaliciousFieldType::class);
                    }

                    if (isset($fieldType['answertpl']) && !empty($fieldType['answertpl'])) {
                        $fieldType['values'] = 1;
                    }

                    $object->fromArray($fieldType);
                    $object->save();
                }
            }

            foreach ($categories as $category) {
                if (isset($category['name'])) {
                    $object = $modx->getObject(FormaliciousCategory::class, ['name' => $category['name']]);

                    if (!$object) {
                        $object = $modx->newObject(FormaliciousCategory::class);
                    }

                    $object->fromArray($category);
                    $object->save();
                }
            }

            $success = true;

            break;
        case xPDOTransport::ACTION_UNINSTALL:
            $success = true;

            break;
    }
}

return $success;
