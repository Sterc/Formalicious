<?php
$events = array();

$events['ContentBlocks_RegisterInputs'] = $modx->newObject('modPluginEvent');
$events['ContentBlocks_RegisterInputs']->fromArray(array(
    'event' => 'ContentBlocks_RegisterInputs',
    'priority' => 0,
    'propertyset' => 0
),'',true,true);

return $events;
