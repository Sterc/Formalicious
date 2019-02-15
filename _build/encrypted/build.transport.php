<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

$mtime 	= explode(' ', microtime());
$tstart = $mtime[1] + $mtime[0];

if (!file_exists(dirname(__DIR__) . '/config.json')) {
    exit('Could not load config file.');
}

$config = json_decode(file_get_contents(dirname(__DIR__) . '/config.json'), true);

if (!$config || !is_array($config)) {
    exit('Could not read config file.');
}

if (!defined('MOREPROVIDER_BUILD')) {
    $version = explode('-', $config['version']);

    define('PKG_NAME',          $config['name']);
    define('PKG_NAME_LOWER',    $config['lowCaseName']);
    define('PKG_NAMESPACE',     isset($config['namespace']) ? $config['namespace'] : $config['lowCaseName']);
    define('PKG_VERSION',       $version[0]);
    define('PKG_RELEASE',       isset($version[1]) ? $version[1] : 'pl');
    define('PKG_PROVIDER_ID',   2);

    $path = __DIR__;

    for ($i = 0; $i <= 10; $i++) {
        if (file_exists($path . '/config.core.php')) {
            require_once $path . '/config.core.php' ;

            break;
        }

        $path = dirname($path);
    }

    if (!defined('MODX_CORE_PATH')) {
        exit ('Could not load config.');
    }

    require_once MODX_CORE_PATH . 'model/modx/modx.class.php';

    $modx= new modX();
    $modx->initialize('mgr');
    $modx->setLogLevel(modX::LOG_LEVEL_INFO);
    $modx->setLogTarget('ECHO');

    echo XPDO_CLI_MODE ? '' : '<pre>';

    $targetDirectory = dirname(dirname(__DIR__)) . '/_packages/';
} else {
    $targetDirectory = MOREPROVIDER_BUILD_TARGET;

    if (!defined('MODMORE_VEHICLE_PRIVATE_KEY')) {
        if (file_exists(__DIR__ . '/license.php')) {
            include __DIR__ . '/license.php';
        } else {
            exit ('You need a license and license.php file to build a package. Ask Mark.');
        }
    }
}

$root = dirname(dirname(__DIR__)) . '/';

$sources = [
    'root'                  => $root,
    'resolvers'             => $root . '_build/resolvers/',
    'source_core'           => $root . 'core/components/' . PKG_NAME_LOWER . '/',
    'source_assets'         => $root . 'assets/components/' . PKG_NAME_LOWER . '/',
    'chunks'                => $root . 'core/components/' . PKG_NAME_LOWER . '/elements/chunks/',
    'snippets'              => $root . 'core/components/' . PKG_NAME_LOWER . '/elements/snippets/',
    'plugins'               => $root . 'core/components/' . PKG_NAME_LOWER . '/elements/plugins/',
    'encryption_vehicles'   => __DIR__ . '/vehicle/',
    'encription_resolvers'  => __DIR__ . '/resolvers/'
];

$modx->loadClass('transport.modPackageBuilder','',false, true);

$builder = new modPackageBuilder($modx);

$builder->directory = $targetDirectory;

$builder->createPackage(PKG_NAME_LOWER,PKG_VERSION,PKG_RELEASE);
$builder->registerNamespace(PKG_NAME_LOWER,false,true,'{core_path}components/' . PKG_NAME_LOWER . '/');

if (defined('MOREPROVIDER_BUILD')) {
    file_put_contents($sources['source_core'] . '/.pubkey', MODMORE_VEHICLE_PUBLIC_KEY, LOCK_EX);

    require_once $sources['encryption_vehicles'] . 'formalicious_vehicle/modmorevehicle.class.php';

    $builder->package->put([
        'source'        => $sources['encryption_vehicles'] . 'formalicious_vehicle/',
        'target'        => "return MODX_CORE_PATH . 'components/';"
    ], [
        'vehicle_class' => 'xPDOFileVehicle',
        'resolve'       => [[
            'type'          => 'php',
            'source'        => $sources['encryption_vehicles'] . 'scripts/resolver.php'
        ]]
    ]);
} else {
    if ($provider = $modx->getObject('transport.modTransportProvider', PKG_PROVIDER_ID)) {
        $provider->xpdo->setOption('contentType', 'default');

        $response = $provider->request('package/encode', 'POST', [
            'package'           => PKG_NAME_LOWER,
            'version'           => PKG_VERSION . '-' . PKG_RELEASE,
            'username'          => $provider->get('username'),
            'api_key'           => $provider->get('api_key'),
            'vehicle_version'   => '2.0.0',
        ]);

        if ($response->isError()) {
            $modx->log(xPDO::LOG_LEVEL_ERROR, 'Encryption provider \'' . $provider->get('name') . '\': '. $response->getError());
        } else {
            $data = $response->toXml();

            if (!empty($data->key)) {
                define('PKG_ENCODE_KEY', $data->key);
            } else if (!empty($data->message)) {
                $modx->log(xPDO::LOG_LEVEL_ERROR, 'Encryption provider \'' . $provider->get('name') . '\': '. $data->message);
            }
        }
    }

    require_once $sources['source_core'] . 'model/encryptedvehicle.class.php';

    $builder->package->put([
        'source'        => $sources['source_core'],
        'target'        => "return MODX_CORE_PATH . 'components/';"
    ], [
        'vehicle_class' => 'xPDOFileVehicle',
        'resolve'       => [[
            'type'          => 'php',
            'source'        => $sources['encription_resolvers'] . 'resolve.encryption.php'
        ]]
    ]);
}

$category = $modx->newObject('modCategory');

$category->fromArray([
    'id'        => 1,
    'category'  => PKG_NAME
 ], '', true, true);

if (isset($config['package']['elements']['chunks'])) {
    $chunks = (array) $config['package']['elements']['chunks'];

    $modx->log(modX::LOG_LEVEL_INFO, count($chunks) . ' chunk(s) to add.');

    foreach ($chunks as $chunk) {
        $chunkObject = $modx->newObject('modChunk');

        if ($chunkObject) {
            $chunkObject->fromArray($chunk);

            if (isset($chunk['file'])) {
                $chunkObject->set('snippet', file_get_contents($sources['chunks'] . $chunk['file']));
            }

            $category->addMany($chunkObject);

            $modx->log(modX::LOG_LEVEL_INFO, 'Chunk added \'' . $chunk['name']. '\'.');
        } else {
            $modx->log(modX::LOG_LEVEL_ERROR, 'Chunk \'' . $chunk['name']. '\' could not be added.');
        }
    }
} else {
    $modx->log(modX::LOG_LEVEL_INFO, 'No chunk(s) to add.');
}

if (isset($config['package']['elements']['snippets'])) {
    $snippets = (array) $config['package']['elements']['snippets'];

    $modx->log(modX::LOG_LEVEL_INFO, count($snippets) . ' snippet(s) to add.');

    foreach ($snippets as $snippet) {
        $snippetObject = $modx->newObject('modSnippet');

        if ($snippetObject) {
            $snippetObject->fromArray($snippet);

            if (isset($snippet['file'])) {
                $snippetObject->set('snippet', file_get_contents($sources['snippets'] . $snippet['file']));
            }

            $properties = [];

            if (isset($snippet['properties'])) {
                foreach ((array) $snippet['properties'] as $property) {
                    $properties[] = array_merge([
                        'xtype'     => 'textfield',
                        'desc'      => PKG_NAME_LOWER . '.snippet_' . strtolower($property['name']). '_desc',
                        'lexicon'   => PKG_NAME_LOWER . ':properties',
                        'area'      => PKG_NAME_LOWER
                    ], $property);
                }
            }

            $snippetObject->setProperties($properties);

            $category->addMany($snippetObject);

            $modx->log(modX::LOG_LEVEL_INFO, 'Snippet added \'' . $snippet['name']. '\' with \'' . count($properties) . '\' properties.');
        } else {
            $modx->log(modX::LOG_LEVEL_ERROR, 'Snippet \'' . $snippet['name']. '\' could not be added.');
        }
    }
} else {
    $modx->log(modX::LOG_LEVEL_INFO, 'No snippets(s) to add.');
}

if (isset($config['package']['elements']['plugins'])) {
    $plugins = (array) $config['package']['elements']['plugins'];

    $modx->log(modX::LOG_LEVEL_INFO, count($plugins) . ' plugins(s) to add.');

    foreach ($plugins as $plugin) {
        $pluginObject = $modx->newObject('modPlugin');

        if ($pluginObject) {
            $pluginObject->fromArray($plugin);

            if (isset($plugin['file'])) {
                $pluginObject->set('plugincode', file_get_contents($sources['plugins'] . $plugin['file']));
            }

            $properties = [];

            if (isset($plugin['properties'])) {
                foreach ((array) $plugin['properties'] as $property) {
                    $properties[] = array_merge([
                        'xtype'     => 'textfield',
                        'desc'      => PKG_NAME_LOWER . '.snippet_' . strtolower($property['name']). '_desc',
                        'lexicon'   => PKG_NAME_LOWER . ':properties',
                        'area'      => PKG_NAME_LOWER
                    ], $property);
                }
            }

            $pluginObject->setProperties($properties);

            $events = [];

            if (isset($plugin['events'])) {
                foreach ((array) $plugin['events'] as $event) {
                    $eventObject = $modx->newObject('modPluginEvent');

                    if ($eventObject) {
                        if (is_array($event)) {
                            $eventObject->fromArray($event);
                        } else {
                            $eventObject->fromArray([
                                'event' => $event
                            ]);
                        }

                        $pluginObject->addMany($eventObject);

                        $events[] = $eventObject->get('event');
                    }
                }
            }

            $category->addMany($pluginObject);

            $modx->log(modX::LOG_LEVEL_INFO, 'Plugin added \'' . $plugin['name']. '\' with \'' . count($properties) . '\' properties and \'' . count($events) . '\' event(s).');
        } else {
            $modx->log(modX::LOG_LEVEL_ERROR, 'Plugin \'' . $plugin['name']. '\' could not be added.');
        }
    }
} else {
    $modx->log(modX::LOG_LEVEL_INFO, 'No plugins(s) to add.');
}

if (isset($config['package']['elements']['tvs'])) {
    $tvs = (array) $config['package']['elements']['tvs'];

    $modx->log(modX::LOG_LEVEL_INFO, count($tvs) . ' tv(s) to add.');

    foreach ($tvs as $tv) {
        $tvObject = $modx->newObject('modTemplateVar');

        if ($tvObject) {
            if (isset($tv['inputOptionValues'])) {
                $tv['elements'] = $tv['inputOptionValues'];
            }

            $tvObject->fromArray($tv);

            $category->addMany($tvObject);

            $modx->log(modX::LOG_LEVEL_INFO, 'TV added \'' . $tv['name']. '\'.');
        } else {
            $modx->log(modX::LOG_LEVEL_ERROR, 'TV \'' . $tv['name']. '\' could not be added.');
        }
    }
} else {
    $modx->log(modX::LOG_LEVEL_INFO, 'No tv(s) to add.');
}

if (isset($config['package']['systemSettings'])) {
    $settings = (array) $config['package']['systemSettings'];

    $modx->log(modX::LOG_LEVEL_INFO, count($settings) . ' setting(s) to add.');

    foreach ($settings as $setting) {
        $settingObject = $modx->newObject('modSystemSetting');

        if ($settingObject) {
            if (isset($setting['type'])) {
                $setting['xtype'] = $setting['type'];
            }

            $settingObject->fromArray(array_merge([
                'xtype'     => 'textfield',
                'area'      => PKG_NAME_LOWER
            ], $setting, [
                'key'       => PKG_NAME_LOWER . '.' . $setting['key'],
                'namespace' => PKG_NAME_LOWER
            ]), '', true, true);

            $builder->putVehicle($builder->createVehicle($settingObject, [
                xPDOTransport::UNIQUE_KEY       => 'key',
                xPDOTransport::PRESERVE_KEYS    => true,
                xPDOTransport::UPDATE_OBJECT    => false
            ]));

            $modx->log(modX::LOG_LEVEL_INFO, 'Setting added \'' . $setting['key']. '\'.');
        } else {
            $modx->log(modX::LOG_LEVEL_ERROR, 'Setting \'' . $setting['key']. '\' could not be added.');
        }
    }
} else {
    $modx->log(modX::LOG_LEVEL_INFO, 'No settings(s) to add.');
}

if (isset($config['package']['menus'])) {
    $menus = (array) $config['package']['menus'];

    $modx->log(modX::LOG_LEVEL_INFO, count($menus) . ' menu(s) to add.');

    foreach ($menus as $menu) {
        $menuObject = $modx->newObject('modMenu');

        if ($menuObject) {
            $menuObject->fromArray(array_merge($menu, [
                'namespace' => PKG_NAME_LOWER
            ]), '', true, true);

            $builder->putVehicle($builder->createVehicle($menuObject, [
                xPDOTransport::PRESERVE_KEYS    => true,
                xPDOTransport::UPDATE_OBJECT    => true,
                xPDOTransport::UNIQUE_KEY       => 'text'
            ]));

            $modx->log(modX::LOG_LEVEL_INFO, 'Menu added \'' . $menu['text']. '\'.');
        } else {
            $modx->log(modX::LOG_LEVEL_ERROR, 'Menu \'' . $menu['text']. '\' could not be added.');
        }
    }
} else {
    $modx->log(modX::LOG_LEVEL_INFO, 'No menu(s) to add.');
}

$attributes = [
    xPDOTransport::UNIQUE_KEY                   => 'category',
    xPDOTransport::PRESERVE_KEYS                => false,
    xPDOTransport::UPDATE_OBJECT                => true,
    xPDOTransport::RELATED_OBJECTS              => true,
    xPDOTransport::RELATED_OBJECT_ATTRIBUTES    => [
        'Snippets'                                  => [
            xPDOTransport::PRESERVE_KEYS                => false,
            xPDOTransport::UPDATE_OBJECT                => true,
            xPDOTransport::UNIQUE_KEY                   => 'name'
        ],
        'Chunks'                                    => [
            xPDOTransport::PRESERVE_KEYS                => false,
            xPDOTransport::UPDATE_OBJECT                => true,
            xPDOTransport::UNIQUE_KEY                   => 'name'
        ],
        'Plugins'                                   => [
            xPDOTransport::PRESERVE_KEYS                => true,
            xPDOTransport::UPDATE_OBJECT                => true,
            xPDOTransport::UNIQUE_KEY                   => 'name',
            xPDOTransport::RELATED_OBJECTS              => true,
            xPDOTransport::RELATED_OBJECT_ATTRIBUTES    => [
                'PluginEvents'                              => [
                    xPDOTransport::PRESERVE_KEYS                => true,
                    xPDOTransport::UPDATE_OBJECT                => false,
                    xPDOTransport::UNIQUE_KEY                   => ['pluginid', 'event'],
                ]
            ]
        ],
        'TemplateVars'                              => [
            xPDOTransport::PRESERVE_KEYS                => false,
            xPDOTransport::UPDATE_OBJECT                => true,
            xPDOTransport::UNIQUE_KEY                   => 'name'
        ]
    ]
];

if (defined('MOREPROVIDER_BUILD')) {
    $attributes['vehicle_class']      = 'modmoreVehicle';
    $attributes['modmore_public_key'] = MODMORE_VEHICLE_PUBLIC_KEY;
    $attributes['modmore_package']    = MODMORE_PACKAGE_ID;
} else {
    $attributes['vehicle_class']      = 'encryptedVehicle';
}

$vehicle = $builder->createVehicle($category, $attributes);

$modx->log(modX::LOG_LEVEL_INFO,'Adding file resolvers to category.');

$modx->log(modX::LOG_LEVEL_INFO, 'Added \'assets\' file resolvers.');

$vehicle->resolve('file', [
    'source' => $sources['source_assets'],
    'target' => "return MODX_ASSETS_PATH . 'components/';",
]);

$modx->log(modX::LOG_LEVEL_INFO, 'Added \'core\' file resolvers.');

//$vehicle->resolve('file', [
//    'source' => $sources['source_core'],
//    'target' => "return MODX_CORE_PATH . 'components/';",
//]);

if (isset($config['build']['resolver']['after'])) {
    foreach ((array) $config['build']['resolver']['after'] as $resolver) {
        $modx->log(modX::LOG_LEVEL_INFO, 'Added \'' . $resolver . '\' file resolvers.');

        $vehicle->resolve('php', [
            'source' =>  $sources['resolvers'] . $resolver
        ]);
    }
}

$builder->putVehicle($vehicle);

$attributes = [];

$modx->log(modX::LOG_LEVEL_INFO, 'Add file resolvers to the build.');

if (isset($config['build']['readme'])) {
    $modx->log(modX::LOG_LEVEL_INFO, 'Added \'readme\' file resolvers.');

    $attributes['readme'] = file_get_contents($sources['source_core'] . $config['build']['readme']);
} else {
    $modx->log(modX::LOG_LEVEL_INFO, 'No \'readme\' file resolvers to add.');
}

if (isset($config['build']['license'])) {
    $modx->log(modX::LOG_LEVEL_INFO, 'Added \'license\' file resolvers.');

    $attributes['license'] = file_get_contents($sources['source_core'] . $config['build']['license']);
} else {
    $modx->log(modX::LOG_LEVEL_INFO, 'No \'license\' file resolvers to add.');
}

if (isset($config['build']['changelog'])) {
    $modx->log(modX::LOG_LEVEL_INFO, 'Added \'changelog\' file resolvers.');

    $attributes['changelog'] = file_get_contents($sources['source_core'] . $config['build']['changelog']);
} else {
    $modx->log(modX::LOG_LEVEL_INFO, 'No \'changelog\' file resolvers to add.');
}

if (isset($config['build']['setupOptions']['source'])) {
    $modx->log(modX::LOG_LEVEL_INFO, 'Added \'setup options\' file resolvers.');

    $attributes['setup-options'] = [
        'source' => dirname(__DIR__) . '/' . $config['build']['setupOptions']['source']
    ];
} else {
    $modx->log(modX::LOG_LEVEL_INFO, 'No \'setup options\' file resolvers to add.');
}

if (isset($config['dependencies'])) {
    $attributes['requires'] = [];

    foreach ((array) $config['dependencies'] as $dependency) {
        $modx->log(modX::LOG_LEVEL_INFO, 'Added \'' . $dependency['name'] . ' dependency\' file resolvers.');

        $attributes['requires'][$dependency['name']] = $dependency['version'];
    }
} else {
    $modx->log(modX::LOG_LEVEL_INFO, 'No \'dependencies\' resolvers to add.');
}

$builder->setPackageAttributes($attributes);

if (defined('MOREPROVIDER_BUILD')) {
    $builder->putVehicle($builder->createVehicle([
        'source'        => $sources['encription_resolvers'] . 'modmorevehicle.resolver.php'
    ], [
        'vehicle_class' => 'xPDOScriptVehicle',
    ]));
} else {
    $builder->putVehicle($builder->createVehicle([
        'source'        => $sources['encription_resolvers'] . 'resolve.encryption.php'
    ], [
        'vehicle_class' => 'xPDOScriptVehicle',
    ]));
}

$modx->log(modX::LOG_LEVEL_INFO, 'Packing up transport package zip.');

$builder->pack();

$mtime      = explode(' ', microtime());
$tend       = $mtime[1] + $mtime[0];
$totalTime  = ($tend - $tstart);
$totalTime  = sprintf("%2.4f s", $totalTime);

$modx->log(modX::LOG_LEVEL_INFO, 'Package Built: Execution time: {'.$totalTime.'}');

echo XPDO_CLI_MODE ? '' : '</pre>';

exit();
