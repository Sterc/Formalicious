<?php
/**
 * Reorder categories
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousReorderStepUpdateProcessor extends modObjectProcessor {
    public $classKey = 'FormaliciousStep';
    public $languageTopics = array('formalicious:default');

    public function process(){
        $newOrder = $this->getProperty('newOrder');
        $form_id = $this->getProperty('form_id');
        $i = 1;
        foreach (explode(',', $newOrder) as $step_id) {
            $item = $this->modx->getObject($this->classKey, array('id' => $step_id));
            if($item){
                $item->set('rank', $i);
                $item->save();
                $i++;
            }
        }
        // $items = $this->modx->newQuery($this->classKey);
        // $items->where(array(
        //         "id:!=" => $idItem,
        //         "rank:>=" => min($oldIndex, $newIndex),
        //         "rank:<=" => max($oldIndex, $newIndex),
        //         'form_id' => $form_id
        //     ));

        // $items->sortby('rank', 'ASC');

        // $itemsCollection = $this->modx->getCollection($this->classKey, $items);

        // if(min($oldIndex, $newIndex) == $newIndex){
        //     foreach ($itemsCollection as $item) {
        //         $itemObject = $this->modx->getObject($this->classKey, $item->get('id'));
        //         $itemObject->set('rank', $itemObject->get('rank') + 1);
        //         $itemObject->save();
        //     }
        // }else{
        //     foreach ($itemsCollection as $item) {
        //         $itemObject = $this->modx->getObject($this->classKey, $item->get('id'));
        //         $itemObject->set('rank', $itemObject->get('rank') - 1);
        //         $itemObject->save();
        //     }
        // }

        // $itemObject = $this->modx->getObject($this->classKey, $idItem);
        // $itemObject->set('rank', $newIndex);
        // $itemObject->save();


        return $this->success('', array());
    }

}
return 'FormaliciousReorderStepUpdateProcessor';
