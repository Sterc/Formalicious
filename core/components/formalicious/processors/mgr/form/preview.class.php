<?php
/**
 * Show form preview
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousPreviewProcessor extends modProcessor {
    public $languageTopics = array('formalicious:default');

    public function process()
    {
        $output = $this->modx->runSnippet('renderForm', array('form' => 1));
        return $this->success('', array('output' => $output));
    }
}
return 'FormaliciousPreviewProcessor';