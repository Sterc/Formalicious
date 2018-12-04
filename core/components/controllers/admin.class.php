<?php

    /**
     * Loads the home page.
     *
     * @package formalicious
     * @subpackage controllers
     */
    require_once dirname(__DIR__) . '/index.class.php';

    class FormaliciousAdminManagerController extends FormaliciousBaseManagerController
    {
        public function loadCustomCssJs()
        {
            $this->addJavascript($this->formalicious->config['jsUrl'] . 'mgr/widgets/admin.panel.js');

            $this->addJavascript($this->formalicious->config['jsUrl'] . 'mgr/widgets/categories.grid.js');
            $this->addJavascript($this->formalicious->config['jsUrl'] . 'mgr/widgets/fieldtypes.grid.js');

            $this->addLastJavascript($this->formalicious->config['jsUrl'] . 'mgr/sections/admin.js');
        }

        public function getPageTitle()
        {
            return $this->modx->lexicon('formalicious');
        }

        public function getTemplateFile()
        {
            return $this->formalicious->config['templatesPath'] . 'admin.tpl';
        }
    }

?>