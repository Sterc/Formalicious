<?php
require_once dirname(dirname(__FILE__)) . '/index.class.php';
/**
 * Loads the home page.
 *
 * @package formalicious
 * @subpackage controllers
 */
class FormaliciousAdminManagerController extends FormaliciousBaseManagerController {
    public function process(array $scriptProperties = array()) {

    }
    public function getPageTitle() { return $this->modx->lexicon('formalicious'); }
    public function loadCustomCssJs() {
        $this->addJavascript($this->formalicious->config['jsUrl'].'mgr/extra/griddraganddrop.js');
        $this->addJavascript($this->formalicious->config['jsUrl'].'mgr/widgets/categories.grid.js');
        $this->addJavascript($this->formalicious->config['jsUrl'].'mgr/widgets/field_types.grid.js');
        $this->addJavascript($this->formalicious->config['jsUrl'].'mgr/widgets/admin.panel.js');
        $this->addLastJavascript($this->formalicious->config['jsUrl'].'mgr/sections/admin.js');
    }
    public function getTemplateFile() { return $this->formalicious->config['templatesPath'].'admin.tpl'; }
}