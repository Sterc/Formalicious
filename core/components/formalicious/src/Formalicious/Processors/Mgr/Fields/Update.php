<?php
namespace Sterc\Formalicious\Processors\Mgr\Fields;

use MODX\Revolution\Processors\Model\UpdateProcessor;
use Sterc\Formalicious\Model\FormaliciousField;

class Update extends UpdateProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = FormaliciousField::class;

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['formalicious:default'];

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'formalicious.field';

    /**
     * @access public.
     * @return Mixed.
     */
    public function initialize()
    {
        if (null === $this->getProperty('published')) {
            $this->setProperty('published', 0);
        }

        if (null === $this->getProperty('required')) {
            $this->setProperty('required', 0);
        }

        return parent::initialize();
    }

    /**
     * @access public.
     * @return Mixed.
     */
    public function beforeSave()
    {
        $fieldType = $this->object->getOne('Type');

        if ($fieldType) {
            if ((int) $fieldType->get('values') === 0) {
                foreach ($this->object->getMany('Answers') as $answer) {
                    $answer->remove();
                }
            }
        }

        return parent::beforeSave();
    }
}
