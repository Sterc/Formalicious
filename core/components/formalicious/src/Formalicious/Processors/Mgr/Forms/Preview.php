<?php
namespace Sterc\Formalicious\Processors\Mgr\Forms;

use MODX\Revolution\Processors\Processor;
use Sterc\Formalicious\Model\FormaliciousStep;
use Sterc\Formalicious\Model\FormaliciousField;
use Sterc\Formalicious\Model\FormaliciousAnswer;
use MODX\Revolution\modChunk;

class Preview extends Processor
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
    public function process()
    {
        $output = [];

        $step = $this->modx->getObject(FormaliciousStep::class, ['id' => $this->getProperty('step_id')]);
        if ($step) {
            $stepOutput = [];

            $criteria = $this->modx->newQuery(FormaliciousField::class, ['published' => 1]);
            $criteria->sortby('rank', 'ASC');

            foreach ((array) $step->getMany('Fields', $criteria) as $field) {
                $answerOuter = [];

                $type = $field->getOne('Type');
                if ($type) {
                    $criteria = $this->modx->newQuery(FormaliciousAnswer::class, ['published' => 1]);
                    $criteria->sortby('rank', 'ASC');

                    foreach ((array) $field->getMany('Answers', $criteria) as $answer) {
                        $chunk = $this->modx->getObject(modChunk::class, ['name' => $type->get('answertpl')]);
                        if ($chunk) {
                            $content = str_replace('[[!', '[[', $chunk->getContent());

                            $chunk = $this->modx->newObject(modChunk::class);
                            $chunk->setCacheable(false);
                            $chunk->setContent($content);
                        }

                        $answerOuter[] = $chunk->process(array_merge($answer->toArray(), [
                            'title' => $answer->get('name'),
                            'name'  => $field->getName()
                        ]));
                    }

                    $chunk = $this->modx->getObject(modChunk::class, ['name' => $type->get('tpl')]);
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
