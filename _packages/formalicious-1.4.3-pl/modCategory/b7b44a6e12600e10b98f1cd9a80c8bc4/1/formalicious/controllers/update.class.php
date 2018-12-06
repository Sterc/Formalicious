<?php

    /**
     * Loads the home page.
     *
     * @package formalicious
     * @subpackage controllers
     */

    require_once dirname(__DIR__) . '/index.class.php';

    class FormaliciousUpdateManagerController extends FormaliciousBaseManagerController
    {
        public function loadCustomCssJs()
        {
            $this->addJavascript($this->formalicious->config['jsUrl'].'mgr/extra/griddraganddrop.js');
            $this->addJavascript($this->formalicious->config['jsUrl'].'mgr/extra/DDTabPanel.js');
            $this->addJavascript($this->formalicious->config['jsUrl'].'mgr/widgets/saved.forms.grid.js');
            $this->addJavascript($this->formalicious->config['jsUrl'].'mgr/widgets/update.panel.js');
            $this->addJavascript($this->formalicious->config['jsUrl'].'mgr/widgets/manageform.panel.js');
            $this->addLastJavascript($this->formalicious->config['jsUrl'].'mgr/sections/update.js');
        }

        public function getPageTitle()
        {
            return $this->modx->lexicon('formalicious');
        }

        public function getTemplateFile()
        {
            return $this->formalicious->config['templatesPath'] . 'update.tpl';
        }
    }

?>