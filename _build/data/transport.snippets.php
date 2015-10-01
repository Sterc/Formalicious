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
//$properties = include $sources['build'].'properties/properties.formalicious.php';
// $snippets[0]->setProperties($properties);
// unset($properties);

$snippets[1]= $modx->newObject('modSnippet');
$snippets[1]->fromArray(array(
    'id' => 1,
    'name' => 'FormaliciousGetValues',
    'description' => '',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/snippet.FormaliciousGetValues.php'),
),'',true,true);
//$properties = include $sources['build'].'properties/properties.formalicious.php';
// $snippets[1]->setProperties($properties);
// unset($properties);


$snippets[2]= $modx->newObject('modSnippet');
$snippets[2]->fromArray(array(
    'id' => 2,
    'name' => 'FormaliciousSaveValues',
    'description' => '',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/snippet.FormaliciousSaveValues.php'),
),'',true,true);
return $snippets;