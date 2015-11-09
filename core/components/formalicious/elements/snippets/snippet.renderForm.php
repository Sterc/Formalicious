<?php
/**
 * The base Formalicious snippet.
 *
 * @package formalicious
 */
$Formalicious = $modx->getService('formalicious','Formalicious',$modx->getOption('formalicious.core_path',null,$modx->getOption('core_path').'components/formalicious/').'model/formalicious/',$scriptProperties);
if (!($Formalicious instanceof Formalicious)) return '';

$form = $modx->getOption('form',$scriptProperties, false);
// $preHooks = $modx->getOption('preHooks',$scriptProperties,'');
// $postHooks = $modx->getOption('postHooks',$scriptProperties,'');
$fieldsemailoutput = '';
$fieldSeparator = $modx->getOption('fieldSeparator',$scriptProperties,"\n");
$answerSeparator = $modx->getOption('fieldSeparator',$scriptProperties,"\n");
$stepSeparator = $modx->getOption('stepSeparator',$scriptProperties,"\n");
$formTpl = $modx->getOption('formTpl',$scriptProperties,"formTpl");
$stepTpl = $modx->getOption('stepTpl',$scriptProperties,"stepTpl");
$stepParam = $modx->getOption('stepParam',$scriptProperties,"step");
$currentStep = $modx->getOption($stepParam,$_GET,1);
$finishStep = false;
$validation = array();
$output = array();
$hooks = array('spam', 'FormaliciousSaveValues');
$preHooks = array('FormaliciousGetValues');
$requestArr = $_REQUEST;
/* Get form */
if($form){
	$form = $modx->getObject('FormaliciousForm', $form);
	if($form){
		if(!$form->get('published')) return '';
		$phs = $form->toArray();
		$stepsC = $modx->newQuery('FormaliciousStep');
		$stepsC->sortby('rank','ASC');
		$steps = $form->getMany('Steps', $stepsC);
		$totalSteps = count($steps);
		if($currentStep == $totalSteps){
			$finishStep = true;
		}
		foreach ($steps as $step) {
			$stepInner = array();
			$validationStep = array();
			$fieldsC = $modx->newQuery('FormaliciousField');
			$fieldsC->where(array('published' => 1));
			$fieldsC->sortby('rank','ASC');
			$fields = $step->getMany('Fields', $fieldsC);
			foreach ($fields as $field) {
			    $fieldsemailoutput .= '<strong>' . $field->get('title') . '</strong>: [[+' . 'field_' . $field->get('id') . ']]<br/>';
				$validationStep['field_'.$field->get('id')] = array();
				$answerOuter = array();
				$type = $field->getOne('Type');
				$answerC = $modx->newQuery('FormaliciousAnswer');
				$answerC->where(array('published' => 1));
				$answerC->sortby('rank','ASC');
				$answers = $field->getMany('Answers', $answerC);
				$answerIdx = 1;
				foreach ($answers as $answer) {
					$answerPhs = $answer->toArray();
					$answerPhs['uniqid'] = uniqid();
					$answerPhs['fieldname'] = 'field_'.$field->get('id');
					//Dirty fix for output filters on checkboxes, radio buttons and selects.
					$answerPhs['curval'] = (is_array($requestArr['field_'.$field->get('id')]))? $modx->toJSON($requestArr['field_'.$field->get('id')]) : $requestArr['field_'.$field->get('id')];
					$answerPhs['idx'] = $answerIdx;
					$answerOuter[] = $modx->getChunk($type->get('answertpl'), $answerPhs);
					$answerIdx++;
				}
				//print_r($requestArr);exit;
				$fieldPhs = $field->toArray();
				$fieldPhs['uniqid'] = uniqid();
				$fieldPhs['values'] = implode($answerSeparator, $answerOuter);
				if($field->get('required')){
					$validationStep['field_'.$field->get('id')][] = 'required';
    				$fieldPhs['title'] = $fieldPhs['title'].' *';
				}
				if($type){
					$stepInner[] = $modx->getChunk($type->get('tpl'), $fieldPhs);
					if($type->get('validation') != ''){
						foreach (explode(',', $type->get('validation')) as $validate) {
							$validationStep['field_'.$field->get('id')][] = $validate;
						}
					}
					$fieldNames['field_'.$field->get('id')] = $field->get('title');
					//$stepInner[] = $field->get('name');
				}else{
					//error type doesn't exists 
				}
				if(count($validationStep['field_'.$field->get('id')]) == 0){
					unset($validationStep['field_'.$field->get('id')]);
				}
			}
			
			$stepPhs = $step->toArray();
			$stepPhs['fields'] = implode($fieldSeparator, $stepInner);
			if($stepTpl){
			    $stepPhs['totalSteps'] = $totalSteps;
				$output[] = $modx->getChunk($stepTpl, $stepPhs);
			}else{
				$output[] = $stepPhs['fields'];
			}
			$validation[] = $validationStep;
		}
		if(!$form->get('onepage')){
			$forminner = $output[($currentStep-1)];
			$validationCurrent = $validation[($currentStep-1)];
		}else{
			$finishStep = true;
			$forminner = implode($stepSeparator, $output);
			$validationCurrent = implode('', $validation);
		}

		$formPhs = $form->toArray();

		if($finishStep){
			$hooks[] = 'email';
			if($form->get('saveform')) $hooks[] = 'FormItSaveForm';

			if($form->get('fiaremailto') && $form->get('fiaremailto')){
				$hooks[] = 'FormItAutoResponder';
			}
			$hooks[] = 'redirect';
			$redirectTo = $form->get('redirectto');
			$redirectParams = '';
			$formPhs['submitTitle'] = $modx->lexicon('formalicious.submit');
		}else{
			$hooks[] = 'redirect';

			$redirectTo = $modx->resource->get('id');
			$redirectParams = $modx->toJSON(array('step' => ($currentStep+1)));
			$formPhs['submitTitle'] = $modx->lexicon('formalicious.next');
		}


        $formPhs['fieldsemailoutput'] = $fieldsemailoutput;
		$formPhs['form'] = $forminner;
		$formPhs['redirectTo'] = $redirectTo;
		$formPhs['redirectParams'] = $redirectParams;
		$formPhs['currentStep'] = $currentStep;
		$formPhs['hooks'] = implode(',', $hooks);
		$formPhs['preHooks'] = implode(',', $preHooks);
		$formPhs['validation'] = implode(',', array_map(function ($v, $k) { return sprintf("%s:%s", $k, implode(':',$v)); }, $validationCurrent, array_keys($validationCurrent)));
		$formPhs['formName'] = $form->get('name');
		$formPhs['fieldNames'] = implode(',', array_map(function ($v, $k) { return $k.'=='.$v; }, $fieldNames, array_keys($fieldNames)));
		$formPhs['formFields'] = implode(',', array_keys($fieldNames));
		$formPhs['fiarattachment'] = (!empty($formPhs['fiarattachment'])) ? MODX_BASE_PATH.$formPhs['fiarattachment'] : '';
		// print_r($modx->placeholders);
		// 	exit($modx->getChunk($formTpl, $formPhs));

		return $modx->getChunk($formTpl, $formPhs);
	}
}
