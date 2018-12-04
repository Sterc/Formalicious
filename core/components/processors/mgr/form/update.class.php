<?php
/**
 * Update an Item
 *
 * @package formalicious
 * @subpackage processors
 */

class FormaliciousUpdateProcessor extends modObjectUpdateProcessor
{
    public $classKey = 'FormaliciousForm';
    public $languageTopics = array('formalicious:default');

    public function beforeSet()
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

        } else if ($this->modx->getCount($this->classKey, array('name' => $name)) && ($this->object->name != $name)) {
            $this->addFieldError('name',$this->modx->lexicon('formalicious.item_err_ae'));
        }
        return parent::beforeSet();
    }

    public function beforeSave()
    {
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
return 'FormaliciousUpdateProcessor';