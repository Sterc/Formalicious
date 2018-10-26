<?php
/**
 * Add chunks to build
 *
 * @package formalicious
 * @subpackage build
 */
$chunks = array();

$chunks[1]= $modx->newObject('modChunk');
$chunks[1]->fromArray(array(
    'id' => 1,
    'name' => 'checkboxesTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['chunks'].'checkboxesTpl.chunk.tpl'),
));

$chunks[2]= $modx->newObject('modChunk');
$chunks[2]->fromArray(array(
    'id' => 2,
    'name' => 'checkboxInnerTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['chunks'].'checkboxInnerTpl.chunk.tpl'),
));

$chunks[3]= $modx->newObject('modChunk');
$chunks[3]->fromArray(array(
    'id' => 3,
    'name' => 'emailTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['chunks'].'emailTpl.chunk.tpl'),
));

$chunks[4]= $modx->newObject('modChunk');
$chunks[4]->fromArray(array(
    'id' => 4,
    'name' => 'fileTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['chunks'].'fileTpl.chunk.tpl'),
));


$chunks[5]= $modx->newObject('modChunk');
$chunks[5]->fromArray(array(
    'id' => 5,
    'name' => 'formTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['chunks'].'formTpl.chunk.tpl'),
));

$chunks[6]= $modx->newObject('modChunk');
$chunks[6]->fromArray(array(
    'id' => 6,
    'name' => 'radiobuttonsInnerTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['chunks'].'radiobuttonsInnerTpl.chunk.tpl'),
));

$chunks[7]= $modx->newObject('modChunk');
$chunks[7]->fromArray(array(
    'id' => 7,
    'name' => 'radiobuttonsTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['chunks'].'radiobuttonsTpl.chunk.tpl'),
));

$chunks[8]= $modx->newObject('modChunk');
$chunks[8]->fromArray(array(
    'id' => 8,
    'name' => 'selectInnerTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['chunks'].'selectInnerTpl.chunk.tpl'),
));

$chunks[9]= $modx->newObject('modChunk');
$chunks[9]->fromArray(array(
    'id' => 9,
    'name' => 'selectTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['chunks'].'selectTpl.chunk.tpl'),
));

$chunks[10]= $modx->newObject('modChunk');
$chunks[10]->fromArray(array(
    'id' => 10,
    'name' => 'stepTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['chunks'].'stepTpl.chunk.tpl'),
));

$chunks[11]= $modx->newObject('modChunk');
$chunks[11]->fromArray(array(
    'id' => 11,
    'name' => 'textareaTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['chunks'].'textareaTpl.chunk.tpl'),
));

$chunks[12]= $modx->newObject('modChunk');
$chunks[12]->fromArray(array(
    'id' => 12,
    'name' => 'textTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['chunks'].'textTpl.chunk.tpl'),
));


$chunks[13]= $modx->newObject('modChunk');
$chunks[13]->fromArray(array(
    'id' => 13,
    'name' => 'fiarTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['chunks'].'formaliciousFiarTpl.chunk.tpl'),
));


$chunks[14]= $modx->newObject('modChunk');
$chunks[14]->fromArray(array(
    'id' => 14,
    'name' => 'emailFormTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['chunks'].'formaliciousemailFormTpl.chunk.tpl'),
));

$chunks[15]= $modx->newObject('modChunk');
$chunks[15]->fromArray(array(
   'id' => 15,
   'name' => 'headingTpl',
   'description' => '',
   'snippet' => file_get_contents($sources['chunks'].'headingTpl.chunk.tpl'),
));


$chunks[16]= $modx->newObject('modChunk');
$chunks[16]->fromArray(array(
   'id' => 16,
   'name' => 'descriptionTpl',
   'description' => '',
   'snippet' => file_get_contents($sources['chunks'].'descriptionTpl.chunk.tpl'),
));

return $chunks;
