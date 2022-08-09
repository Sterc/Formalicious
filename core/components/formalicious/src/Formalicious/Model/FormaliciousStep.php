<?php
namespace Sterc\Formalicious\Model;

use xPDO\xPDO;
use Sterc\Formalicious\Model\FormaliciousField;

/**
 * Class FormaliciousStep
 *
 * @property integer $form_id
 * @property string $title
 * @property string $description
 * @property string $button
 * @property integer $rank
 * @property integer $published
 *
 * @property \FormaliciousField[] $Fields
 *
 * @package Sterc\Formalicious\Model
 */
class FormaliciousStep extends \xPDO\Om\xPDOSimpleObject
{
    /**
     * @access public.
     * @return Array.
     */
    public function getFields()
    {
        $criteria = $this->xpdo->newQuery(FormaliciousField::class, [
            'step_id'   => $this->get('id'),
            'published' => 1
        ]);

        $criteria->sortby('rank', 'ASC');

        return $this->xpdo->getCollection(FormaliciousField::class, $criteria);
    }

    /**
     * @access public.
     * @return Int.
     */
    public function getFieldsTotal()
    {
        $criteria = $this->xpdo->newQuery(FormaliciousField::class, [
            'step_id'   => $this->get('id'),
            'published' => 1
        ]);

        return (int) $this->xpdo->getCount(FormaliciousField::class, $criteria);
    }
}
