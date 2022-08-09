<?php
namespace Sterc\Formalicious\Processors\Mgr\Forms;

use MODX\Revolution\Processors\Model\RemoveProcessor;
use Sterc\Formalicious\Model\FormaliciousForm;

class Remove extends RemoveProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = FormaliciousForm::class;

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['formalicious:default'];

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'formalicious.form';

    /**
     * @access public.
     * @return Mixed.
     */
    public function afterRemove()
    {
        foreach ($this->object->getMany('Steps') as $step) {
            foreach ($step->getMany('Fields') as $field) {
                foreach ($field->getMany('Answers') as $anwer) {
                    $anwer->remove();
                }

                $field->remove();
            }

            $step->remove();
        }

        return parent::afterRemove();
    }
}
