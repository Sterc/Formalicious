<?php
use xPDO\Transport\xPDOTransport;
use MODX\Revolution\modTemplateVar;
use MODX\Revolution\modCategory;

$tvs = [
    'formalicious' => [
        'caption'           => 'Formalicious form',
        'type'              => 'listbox',
        'description'       => '',
        'defaultValue'      => '',
        'elements'          => "@SELECT '- Select a form -' AS name, 0 AS id UNION ALL SELECT name,id FROM [[+PREFIX]]formalicious_forms WHERE published = 1",
        'inputProperties'   => [
            'allowBlank' => false
        ]
    ]
];

$success = false;
if ($transport->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $transport->xpdo;

            foreach ($tvs as $name => $data) {
                if (!$modx->getObject(modTemplateVar::class, ['name' => $name])) {
                    if ($category = $modx->getObject(modCategory::class, ['category' => 'Formalicious'])) {
                        $data['category'] = $category->get('id');

                        $tv = $modx->newObject(modTemplateVar::class, ['name' => $name]);
                        $tv->fromArray($data);
                        $tv->save();
                    }
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
