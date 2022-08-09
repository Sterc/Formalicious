<?php
namespace Sterc;

use MODX\Revolution\modX;

class Formalicious
{
    /**
     * @access public.
     * @var modX.
     */
    public $modx;

    /**
     * @access public.
     * @var Array.
     */
    public $config = [];

    /**
     * @access public.
     * @param modX $modx.
     * @param Array $config.
     */
    public function __construct(modX &$modx, array $config = [])
    {
        $this->modx =& $modx;

        $corePath   = $this->modx->getOption('formalicious.core_path', $config, $this->modx->getOption('core_path') . 'components/formalicious/');
        $assetsUrl  = $this->modx->getOption('formalicious.assets_url', $config, $this->modx->getOption('assets_url') . 'components/formalicious/');
        $assetsPath = $this->modx->getOption('formalicious.assets_path', $config, $this->modx->getOption('assets_path') . 'components/formalicious/');

        $this->config = array_merge([
            'namespace'             => 'formalicious',
            'lexicons'              => ['formalicious:default'],
            'base_path'             => $corePath,
            'core_path'             => $corePath,
            'model_path'            => $corePath . 'src/Model/',
            'processors_path'       => $corePath . 'processors/',
            'elements_path'         => $corePath . 'elements/',
            'chunks_path'           => $corePath . 'elements/chunks/',
            'plugins_path'          => $corePath . 'elements/plugins/',
            'snippets_path'         => $corePath . 'elements/snippets/',
            'templates_path'        => $corePath . 'templates/',
            'assets_path'           => $assetsPath,
            'js_url'                => $assetsUrl . 'js/',
            'css_url'               => $assetsUrl . 'css/',
            'assets_url'            => $assetsUrl,
            'connector_url'         => $assetsUrl . 'connector.php',
            'version'               => '3.0.0',
            'branding_url'          => $this->modx->getOption('formalicious.branding_url'),
            'branding_url_help'     => $this->modx->getOption('formalicious.branding_url_help'),
            'save_forms'            => $this->modx->getOption('formalicious.saveforms'),
            'save_forms_prefix'     => $this->modx->getOption('formalicious.saveforms_prefix'),
            'disallowed_hooks'      => explode(',', $this->modx->getOption('formalicious.disallowed_hooks')),
            'preview_css'           => $this->modx->getOption('formalicious.preview_css'),
            'formit_manager_link'   => $this->getFormItManagerLink(),
            'permissions'           => [
                'admin'                 => $this->modx->hasPermission('formalicious_admin'),
                'tab_fields'            => $this->modx->hasPermission('formalicious_tab_fields'),
                'tab_advanced'          => $this->modx->hasPermission('formalicious_tab_advanced')
            ]
        ], $config);

        if (is_array($this->config['lexicons'])) {
            foreach ($this->config['lexicons'] as $lexicon) {
                $this->modx->lexicon->load($lexicon);
            }
        } else {
            $this->modx->lexicon->load($this->config['lexicons']);
        }
    }

    /**
     * @access public.
     * @return String|Boolean.
     */
    public function getHelpUrl()
    {
        $url = $this->getOption('branding_url_help');

        if (!empty($url)) {
            return $url . '?v=' . $this->config['version'];
        }

        return false;
    }

    /**
     * @access public.
     * @return String|Boolean.
     */
    public function getBrandingUrl()
    {
        $url = $this->getOption('branding_url');

        if (!empty($url)) {
            return $url;
        }

        return false;
    }

    /**
     * @access public.
     * @param String $key.
     * @param Array $options.
     * @param Mixed $default.
     * @return Mixed.
     */
    public function getOption($key, array $options = [], $default = null)
    {
        if (isset($options[$key])) {
            return $options[$key];
        }

        if ($this->config[$key]) {
            return $this->config[$key];
        }

        return $this->modx->getOption($this->config['namespace'] . '.' . $key, $options, $default);
    }

    /**
     * @access public.
     * @return String.
     */
    public function getFormItManagerLink()
    {
        $menu = $this->modx->getObject('modMenu', ['text' => 'formit']);

        if ($menu) {
            return $this->modx->getOption('manager_url', null, MODX_MANAGER_URL) . '?' . http_build_query([
                'a'         => $menu->get('action'),
                'namespace' => $menu->get('namespace')
            ]);
        }

        return '';
    }
}
