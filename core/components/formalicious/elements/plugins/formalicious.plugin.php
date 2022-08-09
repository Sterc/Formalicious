<?php
/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */
use Sterc\Formalicious\ContentBlocks\Input\Formalicious;

if ($modx->event->name === 'ContentBlocks_RegisterInputs') {
    $modx->event->output([
        'formalicious' => new Formalicious($contentBlocks)
    ]);
}