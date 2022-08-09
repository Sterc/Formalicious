<?php
namespace Sterc\Formalicious\Processors\Mgr\Answers;

use MODX\Revolution\Processors\Processor;
use Sterc\Formalicious\Model\FormaliciousAnswer;

class Sort extends Processor
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
     * @access public
     * @return Mixed.
     */
    public function process()
    {
        $i = 1;

        foreach (explode(',', $this->getProperty('order')) as $id) {
            $item = $this->modx->getObject($this->classKey, ['id' => $id]);
            if ($item) {
                $item->set('rank', $i);

                if ($item->save()) {
                    $i++;
                }
            }
        }

        return $this->success('', []);
    }
}
