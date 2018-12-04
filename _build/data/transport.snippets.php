<?php
/**
 * Add snippets to build
 *
 * @package formalicious
 * @subpackage build
 */
$snippets = array();

$snippets[0]= $modx->newObject('modSnippet');
$snippets[0]->fromArray(array(
    'id' => 0,
    'name' => 'renderForm',
    'description' => '',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/snippet.renderForm.php'),
),'',true,true);

$snippets[1]= $modx->newObject('modSnippet');
$snippets[1]->fromArray(array(
    'id' => 1,
    'name' => 'FormaliciousHookGetForm',
    'description' => '',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/snippet.formalicioushookgetform.php'),
),'',true,true);

$snippets[2]= $modx->newObject('modSnippet');
$snippets[2]->fromArray(array(
    'id' => 2,
    'name' => 'FormaliciousHookSetForm',
    'description' => '',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/snippet.formalicioushooksetform.php'),
),'',true,true);

$snippets[3]= $modx->newObject('modSnippet');
$snippets[3]->fromArray(array(
    'id' => 3,
    'name' => 'FormaliciousHookRemoveForm',
    'description' => '',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/snippet.formalicioushookremoveform.php'),
),'',true,true);

$snippets[4]= $modx->newObject('modSnippet');
$snippets[4]->fromArray(array(
    'id' => 4,
    'name' => 'FormaliciousHookRenderForm',
    'description' => '',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/snippet.formalicioushookrenderform.php'),
),'',true,true);

return $snippets;