<?php

use MODX\Revolution\modExtraManagerController;

abstract class FormaliciousBaseManagerController extends modExtraManagerController
{
    /**
     * @access public.
     * @return Mixed.
     */
    public function initialize()
    {
        $this->modx->formalicious = $this->modx->services->get('formalicious');

        $this->addCss($this->modx->formalicious->config['css_url'] . 'mgr/formalicious.css');

        $this->addJavascript($this->modx->formalicious->config['js_url'] . 'mgr/formalicious.js');

        $this->addHtml('<script type="text/javascript">
            Ext.onReady(function() {
                MODx.config.help_url = "' . $this->modx->formalicious->getHelpUrl() . '";

                Formalicious.config = ' . $this->modx->toJSON(array_merge($this->modx->formalicious->config, [
                    'branding_url'      => $this->modx->formalicious->getBrandingUrl(),
                    'branding_url_help' => $this->modx->formalicious->getHelpUrl()
                ])) . ';
            });
        </script>');

        $this->modx->formalicious->f();

        return parent::initialize();
    }

    /**
     * @access public.
     * @return Array.
     */
    public function getLanguageTopics()
    {
        return $this->modx->formalicious->config['lexicons'];
    }

    /**
     * @access public.
     * @returns Boolean.
     */
    public function checkPermissions()
    {
        return $this->modx->hasPermission('formalicious');
    }
}
