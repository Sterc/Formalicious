<?php

    /**
     * @package formalicious
     * @subpackage controllers
     */
    require_once __DIR__ . '/model/formalicious/formalicious.class.php';

    abstract class FormaliciousBaseManagerController extends modExtraManagerController {
        public $formalicious;

        public function initialize()
        {
            $this->formalicious = new Formalicious($this->modx);
            $this->formalicious->f();

            $this->formalicious->config['permissions'] = [
                'advanced' => $this->modx->hasPermission('formalicious_advanced'),
            ];

            $this->addCss($this->formalicious->config['cssUrl'] . 'mgr/formalicious.css');

            $this->addJavascript($this->formalicious->config['jsUrl'] . 'mgr/formalicious.js');

            $this->addHtml('<script type="text/javascript">
                Ext.onReady(function() {
                    Formalicious.config = '.$this->modx->toJSON($this->formalicious->config).';
                    Formalicious.config.connector_url = "'.$this->formalicious->config['connectorUrl'].'";
                });
            </script>');

            return parent::initialize();
        }

        public function getLanguageTopics()
        {
            return array('formalicious:default');
        }

        public function checkPermissions()
        {
            return true;
        }
    }

    class IndexManagerController extends FormaliciousBaseManagerController
    {
        public static function getDefaultController()
        {
            return 'home';
        }
    }

?>