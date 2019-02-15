<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

require_once dirname(dirname(dirname(__DIR__))) . '/config.core.php';

require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$modx->getService('formalicious', 'Formalicious', $modx->getOption('formalicious.core_path', null, $modx->getOption('core_path') . 'components/formalicious/') . 'model/formalicious/');

if ($modx->formalicious instanceof Formalicious) {
    $modx->request->handleRequest([
        'processors_path'   => $modx->formalicious->config['processors_path'],
        'location'          => ''
    ]);
}
