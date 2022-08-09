<?php
namespace Sterc\Formalicious\Processors\Mgr\Answers;

use MODX\Revolution\Processors\Model\CreateProcessor;
use Sterc\Formalicious\Model\FormaliciousAnswer;

class Create extends CreateProcessor
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

    /**
     * @access public.
     * @return Mixed.
     */
    public function beforeSave()
    {
        $query = $this->modx->newQuery($this->classKey, ['field_id' => $this->getProperty('field_id')]);
        $query->sortby('rank', 'DESC');
        $query->limit(1);

        $object = $this->modx->getObject($this->classKey, $query);
        if ($object) {
            $this->object->set('rank', (int) $object->get('rank') + 1);
        } else {
            $this->object->set('rank', 0);
        }

        return parent::beforeSave();
    }
}
