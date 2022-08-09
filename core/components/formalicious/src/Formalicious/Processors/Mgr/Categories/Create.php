<?php
namespace Sterc\Formalicious\Processors\Mgr\Categories;

use MODX\Revolution\Processors\Model\CreateProcessor;
use Sterc\Formalicious\Model\FormaliciousCategory;

class Create extends CreateProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = FormaliciousCategory::class;

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['formalicious:default'];

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'formalicious.category';

    /**
     * @access public.
     * @return Mixed.
     */
    public function initialize()
    {
        if (null === $this->getProperty('published')) {
            $this->setProperty('published', 0);
        }

        return parent::initialize();
    }

    /**
     * @access public.
     * @return Mixed.
     */
    public function beforeSave()
    {
        $name  = $this->getProperty('name');
        $query = ['name' => $name];

        if (empty($name)) {
            $this->addFieldError('name', $this->modx->lexicon('formalicious.category_err_ns_name'));
        } else if ($this->doesAlreadyExist($query)) {
            $this->addFieldError('name', $this->modx->lexicon('formalicious.category_err_ae'));
        }

        return parent::beforeSave();
    }
}
