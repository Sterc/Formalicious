<?php
/**
 * Formalicious Connector
 *
 * @package formalicious
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';

$corePath = $modx->getOption('formalicious.core_path',null,$modx->getOption('core_path').'components/formalicious/');
require_once $corePath.'model/formalicious/formalicious.class.php';
$modx->formalicious = new Formalicious($modx);

$modx->lexicon->load('formalicious:default');

/* handle request */
$path = $modx->getOption('processorsPath',$modx->formalicious->config,$corePath.'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));