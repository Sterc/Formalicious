<?php
namespace Sterc\Formalicious\Processors\Mgr\Answers;

use MODX\Revolution\Processors\Model\UpdateProcessor;
use Sterc\Formalicious\Model\FormaliciousAnswer;

class Update extends UpdateProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = FormaliciousAnswer::class;

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['formalicious:default'];

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'formalicious.field_value';

    /**
     * @access public.
     * @return Mixed.
     */
    public function initialize()
    {
        if (null === $this->getProperty('selected')) {
            $this->setProperty('selected', 0);
        }

        if (null === $this->getProperty('published')) {
            $this->setProperty('published', 0);
        }

        return parent::initialize();
    }
}
