<?php

require_once(MODX_CORE_PATH.'model/modx/processors/resource/getlist.class.php');

/**
 * Get list Items
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousResourceGetListProcessor extends modResourceGetListProcessor {
    public $defaultSortField = 'context_key';
    private $contextNames = array();

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
        if (!isset($this->contextNames[$object->get('context_key')])) {
            $modContext = $this->modx->getObject('modContext', $object->get('context_key'));

            if ($modContext) {
                $this->contextNames[$object->get('context_key')] = $modContext->get('name');
            }
        }

        $contextName = isset($this->contextNames[$object->get('context_key')]) ?
            $this->contextNames[$object->get('context_key')] :
            '';

        $object->set('pagetitle', $object->get('pagetitle').' ('.$object->get('id').') - ' . $contextName);
        return parent::prepareRow($object);
    }

}

return 'FormaliciousResourceGetListProcessor';