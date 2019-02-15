<?php
/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

$instance = $modx->getService('FormaliciousSnippetHookRemoveForm', 'FormaliciousSnippetHookRemoveForm', $modx->getOption('formalicious.core_path', null, $modx->getOption('core_path') . 'components/formalicious/') . 'model/formalicious/snippets/');

if ($instance instanceof FormaliciousSnippetHookRemoveForm) {
    return $instance->run($hook, $errors);
}

return '';