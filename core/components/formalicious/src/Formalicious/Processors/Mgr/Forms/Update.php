<?php
namespace Sterc\Formalicious\Processors\Mgr\Forms;

use MODX\Revolution\Processors\Model\UpdateProcessor;
use Sterc\Formalicious\Model\FormaliciousForm;

class Update extends UpdateProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = FormaliciousForm::class;

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['formalicious:default'];

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'formalicious.form';

    /**
     * @access public.
     * @return Mixed.
     */
    public function initialize()
    {
        if (null === $this->getProperty('published')) {
            $this->setProperty('published', 0);
        }

        if (null === $this->getProperty('saveform')) {
            $this->setProperty('saveform', 0);
        }

        if (null === $this->getProperty('email')) {
            $this->setProperty('email', 0);
        }

        if (null === $this->getProperty('fiaremail')) {
            $this->setProperty('fiaremail', 0);
        }

        return parent::initialize();
    }

    /**
     * @access public.
     * @return Mixed.
     */
    public function beforeSet()
    {
        if (empty($this->getProperty('published_from'))) {
            $this->object->set('published_from', '0000-00-00 00:00:00');
        }

        if (empty($this->getProperty('published_till'))) {
            $this->object->set('published_till', '0000-00-00 00:00:00');
        }

        return parent::beforeSet();
    }

    /**
     * @access public.
     * @return Mixed.
     */
    public function beforeSave()
    {
        $name = $this->getProperty('name');

        $query = [
            'id:!=' => $this->object->get('id'),
            'name'  => $name
        ];

        if (empty($name)) {
            $this->addFieldError('name', $this->modx->lexicon('formalicious.form_err_ns_name'));
        } else if ($this->doesAlreadyExist($query)) {
            $this->addFieldError('name', $this->modx->lexicon('formalicious.form_err_ae'));
        }

        foreach (explode(',', $this->getProperty('posthooks')) as $hook) {
            if (in_array($hook, (array) $this->modx->formalicious->config['disallowed_hooks'], true)) {
                $this->addFieldError('posthooks', $this->modx->lexicon('formalicious.form_err_posthooks'));
            }
        }

        return parent::beforeSave();
    }
}
