<?php

    /**
     * Formalicious FormIt renderHook for rendering the form.
     */

    $formit =& $hook->formit;
    $values = $hook->getValues();

    $stepTpl = $modx->getOption('stepTpl', $scriptProperties, 'stepTpl');
    $stepParam = $modx->getOption('stepParam', $scriptProperties, 'step');
    $currentStep = $modx->getOption($stepParam, $_GET, 1);

    $form = $modx->getObject('FormaliciousForm', [
        'id'        => $formit->config['formid'],
        'published' => 1
    ]);

    if ($form) {
        if (isset($_SESSION['Formalicious_form_' . $formit->config['formid']])) {
            $values = array_merge($_SESSION['Formalicious_form_' . $formit->config['formid']], $values);
        }

        $hook->setValues($values);

        $output = [];

        $query = $modx->newQuery('FormaliciousStep', [
            'form_id' => $form->get('id')
        ]);

        $query->sortby('rank', 'ASC');

        $steps = $modx->getCollection('FormaliciousStep', $query);
        $totalSteps = $modx->getCount('FormaliciousStep', $query);

        foreach ($steps as $step) {
            $stepOutput = [];

            $query = $modx->newQuery('FormaliciousField', [
                'step_id'   => $step->get('id'),
                'published' => 1
            ]);

            $query->sortby('rank', 'ASC');

            foreach ($modx->getCollection('FormaliciousField', $query) as $field) {
                $type = $field->getOne('Type');

                if ($type) {
                    $fieldOutput = [];
                    $fieldName   = 'field_' . $field->get('id');
                    $fieldValue  = '';

                    if (isset($values[$fieldName])) {
                        $fieldValue = $values[$fieldName];
                    }

                    if ((int) $type->get('values') === 1) {
                        $query = $modx->newQuery('FormaliciousAnswer', [
                            'field_id'  => $field->get('id'),
                            'published' => 1
                        ]);

                        $query->sortby('rank', 'ASC');

                        foreach ($modx->getCollection('FormaliciousAnswer', $query) as $key => $answer) {
                            $fieldOutput[] = $modx->getChunk($type->get('answertpl'), array_merge($answer->toArray(), array(
                                'uniqid'    => uniqid(),
                                'fieldname' => $fieldName,
                                'value'     => is_array($fieldValue) ? $modx->toJSON($fieldValue) : $fieldValue,
                                'idx'       => $key
                            )));
                        }
                    }

                    $stepOutput[] = $modx->getChunk($type->get('tpl'), array_merge($field->toArray(), array(
                        'uniqid'    => uniqid(),
                        'fieldname' => $fieldName,
                        'value'     => $fieldValue,
                        'values'    => implode(PHP_EOL, $fieldOutput),
                        'error'     => isset($errors[$fieldName]) ? $errors[$fieldName] : ''
                    )));
                }
            }

            if ($stepTpl) {
                $output[] = $modx->getChunk($stepTpl, array_merge($step->toArray(), array(
                    'totalSteps'    => $totalSteps,
                    'fields'        => implode(PHP_EOL, $stepOutput)
                )));
            } else {
                $output[] = implode(PHP_EOL, $stepOutput);
            }
        }

        if ((int) $currentStep >= (int) $totalSteps) {
            $currentStep = $totalSteps;
        }

        $modx->toPlaceholders(array(
            'form'          => $output[$currentStep - 1],
            'step'          => $currentStep,
            'prevUrl'       => $modx->makeUrl($modx->resource->get('id'), null, array(
                $stepParam      => $currentStep - 1
            )),
            'currentUrl'    => $modx->makeUrl($modx->resource->get('id'), null, array(
                $stepParam      => $currentStep
            ))
        ), 'formalicious');
    }

?>