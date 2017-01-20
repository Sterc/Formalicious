<?php
require_once dirname(__FILE__) . '/model/formalicious/formalicious.class.php';
/**
 * @package formalicious
 */

abstract class FormaliciousBaseManagerController extends modExtraManagerController {
    /** @var Formalicious $formalicious */
    public $formalicious;
    public function initialize() {
        $this->formalicious = new Formalicious($this->modx);

        $this->addCss($this->formalicious->config['cssUrl'].'mgr.css');
        $this->addJavascript($this->formalicious->config['jsUrl'].'mgr/formalicious.js');
        $this->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            Formalicious.config = '.$this->modx->toJSON($this->formalicious->config).';
            Formalicious.config.connector_url = "'.$this->formalicious->config['connectorUrl'].'";
        });
        </script>');
        return parent::initialize();
    }
    public function getLanguageTopics() {
        return array('formalicious:default');
    }
    public function checkPermissions() { return true;}
}

class IndexManagerController extends FormaliciousBaseManagerController {
    public static function getDefaultController() { return 'home'; }
}