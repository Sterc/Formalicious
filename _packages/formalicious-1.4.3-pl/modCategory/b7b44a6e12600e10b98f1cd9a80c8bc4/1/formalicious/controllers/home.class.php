<?php

    /**
     * Loads the home page.
     *
     * @package formalicious
     * @subpackage controllers
     */

    require_once dirname(__DIR__) . '/index.class.php';

    class FormaliciousHomeManagerController extends FormaliciousBaseManagerController
    {
        public function loadCustomCssJs()
        {
            $this->addJavascript($this->formalicious->config['jsUrl'].'mgr/widgets/home.panel.js');

            $this->addJavascript($this->formalicious->config['jsUrl'].'mgr/widgets/forms.grid.js');

            $this->addLastJavascript($this->formalicious->config['jsUrl'].'mgr/sections/home.js');

            $this->addHtml('<script type="text/javascript">
                Ext.onReady(function() {
                    Formalicious.config.categories = ' . $this->modx->toJSON($this->getCategories()) . ';
                });
            </script>');
        }

        public function getPageTitle()
        {
            return $this->modx->lexicon('formalicious');
        }

        public function getTemplateFile()
        {
            return $this->formalicious->config['templatesPath'] . 'home.tpl';
        }

        public function getCategories()
        {
            $categories = [];

            $query = $this->modx->newQuery('FormaliciousCategory');
            $query->sortby('name', 'ASC');

            foreach ($this->modx->getCollection('FormaliciousCategory', $query) as $category) {
                $categories[] = $category->toArray();
            }

            return $categories;
        }
    }

?>