<?php
namespace Sterc\Formalicious\Processors\Mgr\FieldTypes;

use MODX\Revolution\Processors\Model\RemoveProcessor;
use Sterc\Formalicious\Model\FormaliciousFieldType;

class Remove extends RemoveProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = FormaliciousFieldType::class;

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['formalicious:default'];

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'formalicious.field_type';

    /**
     * @access public.
     * @return Mixed.
     */
    public function afterRemove()
    {
        foreach ($this->object->getMany('Fields') as $field) {
            foreach ($field->getMany('Answers') as $anwer) {
                $anwer->remove();
            }

            $field->remove();
        }

        return parent::afterRemove();
    }
}
