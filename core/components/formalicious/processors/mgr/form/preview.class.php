<?php
/**
 * Show form preview
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousPreviewProcessor extends modProcessor {
    public $languageTopics = array('formalicious:default');

    public function process()
    {
        $output = '';
        $form = $this->modx->getObject('FormaliciousForm', $this->getProperty('form_id'));
        if ($form) {
            $step = $this->modx->getObject('FormaliciousStep', $this->getProperty('step_id'));
            if ($step) {
                $fieldsC = $this->modx->newQuery('FormaliciousField');
                $fieldsC->where(array('published' => 1));
                $fieldsC->sortby('rank', 'ASC');
                $fields = $step->getMany('Fields', $fieldsC);
                foreach ($fields as $field) {
                    $answerOuter = array();
                    $type = $field->getOne('Type');
                    $answerC = $this->modx->newQuery('FormaliciousAnswer');
                    $answerC->where(array('published' => 1));
                    $answerC->sortby('rank', 'ASC');
                    $answers = $field->getMany('Answers', $answerC);
                    $answerIdx = 1;
                    foreach ($answers as $answer) {
                        $answerPhs = $answer->toArray();
                        $answerPhs['uniqid'] = uniqid();
                        $answerPhs['fieldname'] = 'field_'.$field->get('id');
                        $answerPhs['curval'] = '';
                        $answerPhs['idx'] = $answerIdx;
                        $aChunk = $this->modx->getObject('modChunk', array('name' => $type->get('answertpl')));
                        if ($aChunk) {
                            $content = $aChunk->getContent();
                            $content = str_replace('[[!', '[[', $content);
                            $aChunkNew = $this->modx->newObject('modChunk');
                            $aChunkNew->setCacheable(false);
                            $aChunkNew->setContent($content);
                        }
                        $answerOuter[] = $aChunkNew->process($answerPhs);
                        $answerIdx++;
                    }
                    $fieldPhs = $field->toArray();
                    $fieldPhs['values'] = implode("\n", $answerOuter);
                    if ($field->get('required')) {
                        $fieldPhs['title'] .= ' *';
                    }
                    if ($type) {
                        $fChunk = $this->modx->getObject('modChunk', array('name' => $type->get('tpl')));
                        if ($fChunk) {
                            $content = $fChunk->getContent();
                            $content = str_replace('[[!', '[[', $content);
                            $fChunkNew = $this->modx->newObject('modChunk');
                            $fChunkNew->setCacheable(false);
                            $fChunkNew->setContent($content);
                        }
                        $stepInner[] = $fChunkNew->process($fieldPhs);
//                        $stepInner[] = $this->modx->getChunk($type->get('tpl'), $fieldPhs);
                        $fieldNames['field_'.$field->get('id')] = $field->get('title');
                    }
                }
                $output .= implode("\n", $stepInner);

            } // endif($step)
            $output = preg_replace('~\\[\\[\\+(\\S+)\\]\\]+~', '', $output, -1);
//            $output = str_replace('[[+fi.field_5]]', '', $output);
        }
        return $this->success('', array('output' => $output));
    }
}
return 'FormaliciousPreviewProcessor';