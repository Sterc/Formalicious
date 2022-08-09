<?php
namespace Sterc\Formalicious\Hooks;

use Sterc\Formalicious\Snippets\Base;

class RemoveForm extends Base
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
