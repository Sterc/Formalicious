<?php
/**
 * Reorder steps
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousReorderStepUpdateProcessor extends modObjectProcessor
{
    public $classKey = 'FormaliciousStep';
    public $languageTopics = array('formalicious:default');

    public function process()
    {
        $newOrder = $this->getProperty('newOrder');
        $i = 1;
        foreach (explode(',', $newOrder) as $step_id) {
            $item = $this->modx->getObject($this->classKey, array('id' => $step_id));
            if ($item) {
                $item->set('rank', $i);
                $item->save();
                $i++;
            }
        }
        return $this->success('', array());
    }

}
return 'FormaliciousReorderStepUpdateProcessor';
