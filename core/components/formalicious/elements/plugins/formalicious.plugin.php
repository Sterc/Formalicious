<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

if ($modx->event->name === 'ContentBlocks_RegisterInputs') {
    require_once $modx->getOption('formalicious.core_path', null, MODX_CORE_PATH . 'components/formalicious/') . 'elements/inputs/FormaliciousInput.php';

    $instance = new FormaliciousInput($contentBlocks);

    if ($instance instanceof FormaliciousInput) {
        $modx->event->output([
            'formalicious' => $instance
        ]);
    }
}