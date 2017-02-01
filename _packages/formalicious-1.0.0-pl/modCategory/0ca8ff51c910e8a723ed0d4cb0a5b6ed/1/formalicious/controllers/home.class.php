<?php
require_once dirname(dirname(__FILE__)) . '/index.class.php';
/**
 * Loads the home page.
 *
 * @package formalicious
 * @subpackage controllers
 */
class FormaliciousHomeManagerController extends FormaliciousBaseManagerController {
    public function process(array $scriptProperties = array()) {

    }
    public function getPageTitle() { return $this->modx->lexicon('formalicious'); }
    public function loadCustomCssJs() {
        $this->addJavascript($this->formalicious->config['jsUrl'].'mgr/extra/griddraganddrop.js');
        $this->addJavascript($this->formalicious->config['jsUrl'].'mgr/widgets/forms.grid.js');
        $this->addJavascript($this->formalicious->config['jsUrl'].'mgr/widgets/home.panel.js');
        $this->addLastJavascript($this->formalicious->config['jsUrl'].'mgr/sections/home.js');
    }
    public function getTemplateFile() { return $this->formalicious->config['templatesPath'].'home.tpl'; }
}