<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

class FormaliciousFormPreviewProcessor extends modProcessor
{
    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['formalicious:default'];

    /**
     * @access public.
     * @return Mixed.
     */
    public function initialize()
    {
        $this->modx->getService('formalicious', 'Formalicious', $this->modx->getOption('formalicious.core_path', null, $this->modx->getOption('core_path') . 'components/formalicious/') . 'model/formalicious/');

        return parent::initialize();
    }

    /**
     * @access public.
     * @return Mixed.
     */
    public function process()
    {
        $output = [];

        $step = $this->modx->getObject('FormaliciousStep', [
            'id' => $this->getProperty('step_id')
        ]);

        if ($step) {
            $stepOutput = [];

            $criteria = $this->modx->newQuery('FormaliciousField', [
                'published' => 1
            ]);

            $criteria->sortby('FormaliciousField_rank', 'ASC');

            foreach ((array) $step->getMany('Fields', $criteria) as $field) {
                $answerOuter = [];

                $type = $field->getOne('Type');

                if ($type) {
                    $criteria = $this->modx->newQuery('FormaliciousAnswer', [
                        'published' => 1
                    ]);

                    $criteria->sortby('FormaliciousAnswer_rank', 'ASC');

                    foreach ((array) $field->getMany('Answers', $criteria) as $answer) {
                        $chunk = $this->modx->getObject('modChunk', [
                            'name' => $type->get('answertpl')
                        ]);

                        if ($chunk) {
                            $content = str_replace('[[!', '[[', $chunk->getContent());

                            $chunk = $this->modx->newObject('modChunk');
                            $chunk->setCacheable(false);
                            $chunk->setContent($content);
                        }

                        $answerOuter[] = $chunk->process(array_merge($answer->toArray(), [
                            'title' => $answer->get('name'),
                            'name'  => $field->getName()
                        ]));
                    }

                    $chunk = $this->modx->getObject('modChunk', [
                        'name' => $type->get('tpl')
                    ]);

                    if ($chunk) {
                        $content = str_replace('[[!', '[[', $chunk->getContent());

                        $chunk = $this->modx->newObject('modChunk');
                        $chunk->setCacheable(false);
                        $chunk->setContent($content);
                    }

                    $stepOutput[] = $chunk->process(array_merge($field->toArray(), [
                        'name'          => $field->getName(),
                        'values'        => implode(PHP_EOL, $answerOuter),
                        'valuesCount'   => count($answerOuter)
                    ]));
                }
            }

            $output[] = implode(PHP_EOL, $stepOutput);

        }

        return $this->success('', [
            'output' => preg_replace('~\\[\\[\\+(\\S+)\\]\\]+~', '', implode(PHP_EOL, $output), -1)
        ]);
    }
}

return 'FormaliciousFormPreviewProcessor';
