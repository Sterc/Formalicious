<?php
/**
 * Get list Items
 *
 * @package formalicious
 * @subpackage processors
 */
class FormaliciousSavedFormExportProcessor extends modObjectGetListProcessor {
    public $classKey = 'FormaliciousSavedForm';
    public $languageTopics = array('formalicious:default');
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $form_id = $this->getProperty('form_id');
        $startDate = $this->getProperty('startDate');
        $endDate = $this->getProperty('endDate');

        if (!empty($form_id)) {
            $c->where(array(
                'form_id' => $form_id
            ));
        }

        if ($startDate != '') {
            $c->andCondition(array('time:>' => strtotime($startDate.' 00:00:00')));
        }
        if ($endDate != '') {
            $c->andCondition(array('time:<' => strtotime($endDate.' 23:59:59')));
        }

        return $c;
    }

    public function process() {
        $beforeQuery = $this->beforeQuery();
        if ($beforeQuery !== true) {
            return $this->failure($beforeQuery);
        }
        $data = $this->getData();

        $form_id = $this->getProperty('form_id');
        $f = 'form-'.$form_id.'.csv';
        if(!is_dir($this->modx->getOption('core_path',null,MODX_CORE_PATH).'export/'.$this->classKey.'/')){
            mkdir($this->modx->getOption('core_path',null,MODX_CORE_PATH).'export/'.$this->classKey.'/');
        }
        $fileName = $this->modx->getOption('core_path',null,MODX_CORE_PATH).'export/'.$this->classKey.'/'.$f;

        $list = $this->createCsv($fileName, $data);
        return $this->outputArray($list,$data['total']);
    }

    public function createCsv($file, array $data) {

        $keys = array();

        $fp = fopen($file, 'w+');

        foreach ($data['results'] as $object) {
            if ($this->checkListPermission && $object instanceof modAccessibleObject && !$object->checkPolicy('list')) continue;
            $objectArray = $this->prepareRow($object);
            if (!empty($objectArray) && is_array($objectArray)) {
                $keys = array_unique(array_merge($keys, array_keys($objectArray['data'])));
                //fputcsv($fp, $objectArray['data']);
            }
        }

        $defaultArr = array_flip($keys);
        $defaultArr = array_map(function() {}, $defaultArr);

        fputcsv($fp, $keys);
        foreach ($data['results'] as $object) {
            $objectArray = $this->prepareRow($object);
            if (!empty($objectArray) && is_array($objectArray)) {
                fputcsv($fp, array_merge($defaultArr, $objectArray['data']));
            }
        }
        fclose($fp);
        return array('file' => str_replace(MODX_BASE_PATH, MODX_SITE_URL, $file));
    }
}
return 'FormaliciousSavedFormExportProcessor';