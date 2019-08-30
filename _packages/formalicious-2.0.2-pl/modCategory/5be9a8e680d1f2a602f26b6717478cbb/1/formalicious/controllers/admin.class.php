<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

require_once dirname(__DIR__) . '/index.class.php';

class FormaliciousAdminManagerController extends FormaliciousBaseManagerController
{
    /**
     * @access public.
     */
    public function loadCustomCssJs()
    {
        $this->addJavascript($this->modx->formalicious->config['js_url'] . 'mgr/widgets/admin.panel.js');

        $this->addJavascript($this->modx->formalicious->config['js_url'] . 'mgr/widgets/categories.grid.js');
        $this->addJavascript($this->modx->formalicious->config['js_url'] . 'mgr/widgets/fieldtypes.grid.js');

        $this->addLastJavascript($this->modx->formalicious->config['js_url'] . 'mgr/sections/admin.js');
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
        return $this->modx->formalicious->config['templates_path'] . 'admin.tpl';
    }

    /**
     * @access public.
     * @returns Boolean.
     */
    public function checkPermissions()
    {
        return $this->modx->hasPermission('formalicious_admin');
    }
}
