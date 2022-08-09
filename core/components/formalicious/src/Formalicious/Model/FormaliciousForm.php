<?php
namespace Sterc\Formalicious\Model;

use xPDO\xPDO;
use Sterc\Formalicious\Model\FormaliciousStep;

/**
 * Class FormaliciousForm
 *
 * @property integer $category_id
 * @property string $name
 * @property boolean $published
 * @property string $published_from
 * @property string $published_till
 * @property boolean $saveform
 * @property integer $redirectto
 * @property boolean $email
 * @property string $emailto
 * @property string $emailsubject
 * @property string $emailcontent
 * @property boolean $fiaremail
 * @property integer $fiaremailto
 * @property string $fiaremailfrom
 * @property string $fiaremailsubject
 * @property string $fiaremailcontent
 * @property string $fiaremailattachment
 * @property string $prehooks
 * @property string $posthooks
 * @property string $parameters
 *
 * @property \FormaliciousStep[] $Steps
 *
 * @package Sterc\Formalicious\Model
 */
class FormaliciousForm extends \xPDO\Om\xPDOSimpleObject
{
     /**
     * @access public.
     * @return Boolean.
     */
    public function isPublished()
    {
        if (!in_array($this->get('published_from'), ['-001-11-30 00:00:00', '-1-11-30 00:00:00', '0000-00-00 00:00:00', null], true)) {
            if (strtotime($this->get('published_from')) >= time()) {
                return false;
            }
        }

        if (!in_array($this->get('published_till'), ['-001-11-30 00:00:00', '-1-11-30 00:00:00', '0000-00-00 00:00:00', null], true)) {
            if (strtotime($this->get('published_till')) <= time()) {
                return false;
            }
        }

        return (int) $this->get('published') === 1;
    }

    /**
     * @access public.
     * @return Array.
     */
    public function getParameters()
    {
        $parameters = [];

        if ($this->get('parameters')) {
            foreach ((array) json_decode($this->get('parameters'), true) as $value) {
                if (isset($value['key'], $value['value'])) {
                    $parameters[$value['key']] = $value['value'];
                }
            }
        }

        return $parameters;
    }

    /**
     * @access public.
     * @return Array.
     */
    public function getSteps()
    {
        $criteria = $this->xpdo->newQuery(FormaliciousStep::class, [
            'form_id' => $this->get('id')
        ]);

        $criteria->sortby('rank', 'ASC');

        return $this->xpdo->getCollection(FormaliciousStep::class, $criteria);
    }

    /**
     * @access public.
     * @return Int.
     */
    public function getStepsTotal()
    {
        $criteria = $this->xpdo->newQuery(FormaliciousStep::class, [
            'form_id' => $this->get('id')
        ]);

        return (int) $this->xpdo->getCount(FormaliciousStep::class, $criteria);
    }
}
