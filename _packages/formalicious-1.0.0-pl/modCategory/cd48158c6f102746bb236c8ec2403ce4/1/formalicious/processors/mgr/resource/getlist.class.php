<?php
require_once(MODX_CORE_PATH.'model/modx/processors/resource/getlist.class.php');
/**
 * Get list Items
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousResourceGetListProcessor extends modResourceGetListProcessor {
    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                'pagetitle:LIKE' => $query.'%'
            ));
        }
        return $c;
    }

    public function prepareRow(xPDOObject $object) {
        $object->set('pagetitle', $object->get('pagetitle').' ('.$object->get('id').')');
        return parent::prepareRow($object);
    }

}

return 'FormaliciousResourceGetListProcessor';