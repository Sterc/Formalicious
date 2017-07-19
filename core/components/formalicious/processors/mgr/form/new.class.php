<?php
/**
 * Create an Item
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousCreateProcessor extends modObjectCreateProcessor
{
    public $classKey = 'FormaliciousForm';
    public $languageTopics = array('formalicious:default');

    public function beforeSave()
    {
        if(!$this->getProperty('published')) $this->setProperty('published', 'false');
        if(!$this->getProperty('fiaremail')) $this->setProperty('fiaremail', 'false');
        if(!$this->getProperty('saveform')) $this->setProperty('saveform', 'false');

        $this->setCheckbox('published');
        $this->setCheckbox('fiaremail');
        $this->setCheckbox('saveform');
        
        $name = $this->getProperty('name');

        if (empty($name)) {
            $this->addFieldError('name', $this->modx->lexicon('formalicious.item_err_ns_name'));
        } elseif ($this->doesAlreadyExist(array('name' => $name))) {
            $this->addFieldError('name', $this->modx->lexicon('formalicious.item_err_ae'));
        }

        $category = $this->getProperty('category_id');
        if ($category) {
            $this->setProperty('category_id', $category);
        }

        $hooks = explode(',', $this->getProperty('posthooks'));
        foreach ($hooks as $hook) {
            if (in_array($hook, $this->modx->formalicious->config['disallowedHooks'])) {
                $this->addFieldError('posthooks', $this->modx->lexicon('formalicious.advanced.posthooks.disallowed'));
                return $this->modx->lexicon('formalicious.advanced.posthooks.disallowed');
            }
        }

        return parent::beforeSave();
    }
}
return 'FormaliciousCreateProcessor';
