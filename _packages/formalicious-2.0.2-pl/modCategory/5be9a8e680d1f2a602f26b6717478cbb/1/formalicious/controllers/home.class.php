<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

require_once dirname(__DIR__) . '/index.class.php';

class FormaliciousHomeManagerController extends FormaliciousBaseManagerController
{
    /**
     * @access public.
     */
    public function loadCustomCssJs()
    {
        $this->addJavascript($this->modx->formalicious->config['js_url'] . 'mgr/widgets/home.panel.js');

        $this->addJavascript($this->modx->formalicious->config['js_url'] . 'mgr/widgets/forms.grid.js');

        $this->addLastJavascript($this->modx->formalicious->config['js_url'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
            Ext.onReady(function() {
                Formalicious.config.categories = ' . $this->modx->toJSON($this->getCategories()) . ';
            });
        </script>');
    }

    /**
     * @access public.
     * @return String.
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('formalicious');
    }

    /**
     * @access public.
     * @return String.
     */
    public function getTemplateFile()
    {
        return $this->modx->formalicious->config['templates_path'] . 'home.tpl';
    }

    /**
     * @access public.
     * @return Array.
     */
    public function getCategories()
    {
        $categories = [];

        $query = $this->modx->newQuery('FormaliciousCategory');
        $query->where([
            'published' => 1
        ]);
        $query->sortby('name', 'ASC');

        foreach ($this->modx->getCollection('FormaliciousCategory', $query) as $category) {
            $categories[] = $category->toArray();
        }

        return $categories;
    }
}
