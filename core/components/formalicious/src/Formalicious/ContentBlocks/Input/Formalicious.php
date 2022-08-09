<?php
namespace Sterc\Formalicious\ContentBlocks\Input;

use cbBaseInput;

class Formalicious extends cbBaseInput
{
    public $defaultIcon = 'form';
    public $defaultTpl = '[[!FormaliciousRenderForm? &form=`[[+value]]`]]';

    /**
     * Returns an array with lexicon topics to load when this input type is used.
     *
     * @return array
     */
    public function getLexiconTopics()
    {
        return array('formalicious:default');
    }

    public function getName()
    {
         return $this->modx->lexicon('formalicious.contentblocks_input');
    }

    public function getDescription()
    {
         return $this->modx->lexicon('formalicious.contentblocks_input.description');
    }
    /**
     * @return array
     */
    public function getJavaScripts()
    {
        $assetsUrl = $this->modx->getOption('formalicious.assets_url', null, MODX_ASSETS_URL . 'components/formalicious/');
        return array(
            $assetsUrl . 'js/inputs/formalicious.js',
        );
    }

    /**
     * @return array
     */
    public function getTemplates()
    {
        $tpls = array();

        // Grab the template from a .tpl file
        $corePath = $this->modx->getOption('formalicious.core_path', null, MODX_CORE_PATH . 'components/formalicious/');
        $template = file_get_contents($corePath . 'templates/input.tpl');

        // Wrap the template, giving the input a reference of "formalicious", and
        // add it to the returned array.
        $tpls[] = $this->contentBlocks->wrapInputTpl('formalicious', $template);
        return $tpls;
    }
}
