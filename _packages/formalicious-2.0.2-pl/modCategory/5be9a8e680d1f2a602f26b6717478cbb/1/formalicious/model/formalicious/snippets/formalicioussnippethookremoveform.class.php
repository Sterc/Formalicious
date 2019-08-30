<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

require_once dirname(__DIR__) . '/formalicioussnippets.class.php';

class FormaliciousSnippetHookRemoveForm extends FormaliciousSnippets
{
    /**
     * @access public.
     * @var Array.
     */
    public $defaultProperties = [
        'usePdoTools'           => false,
        'usePdoElementsPath'    => false
    ];

    /**
     * @access public.
     * @param Object $hook.
     * @param Array $errors.
     * @return Mixed.
     */
    public function run($hook, array $errors = [])
    {
        $this->removeFormValues($hook);

        return true;
    }
}