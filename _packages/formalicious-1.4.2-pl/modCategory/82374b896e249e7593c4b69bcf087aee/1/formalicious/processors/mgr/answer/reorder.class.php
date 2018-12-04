<?php
/**
 * Reorder items
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousReorderAnswerUpdateProcessor extends modObjectProcessor {
    public $classKey = 'FormaliciousAnswer';
    public $languageTopics = array('formalicious:default');

    public function process(){
        $newOrder = $this->getProperty('newOrder');
        $field_id = $this->getProperty('field_id');
        $i = 1;
        foreach (explode(',', $newOrder) as $id) {
            $item = $this->modx->getObject($this->classKey, array('id' => $id));
            if($item){
                $item->set('rank', $i);
                $item->save();
                $i++;
            }
        }

        return $this->success('', array());

    }

}
return 'FormaliciousReorderAnswerUpdateProcessor';