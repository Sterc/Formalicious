<?php
namespace Sterc\Formalicious\Processors\Mgr\Steps;

use MODX\Revolution\Processors\Model\CreateProcessor;

use Sterc\Formalicious\Model\FormaliciousStep;

class Create extends CreateProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = FormaliciousStep::class;

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['formalicious:default'];

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'formalicious.step';

    /**
     * @access public.
     * @return Mixed.
     */
    public function beforeSave()
    {
        $query = $this->modx->newQuery($this->classKey, ['form_id' => $this->getProperty('form_id')]);

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
