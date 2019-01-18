<?php

    /**
     * The base Formalicious snippet.
     *
     * @package formalicious
     */

    $formalicious = $modx->getService(
        'formalicious',
        'Formalicious',
        $modx->getOption(
            'formalicious.core_path',
            null,
            $modx->getOption('core_path') . 'components/formalicious/'
        ) . 'model/formalicious/',
        $scriptProperties
    );

    if (!$formalicious instanceof Formalicious) {
        return '';
    }

    $emailTpl = $modx->getOption('emailTpl', $scriptProperties, 'emailFormTpl');
    $fiarTpl = $modx->getOption('fiarTpl', $scriptProperties, 'fiarTpl');

    $validation = array();
    $validate = $modx->getOption('validate', $scriptProperties, false);
    $customValidators = $modx->getOption('customValidators', $scriptProperties, '');

    $stepParam = $modx->getOption('stepParam', $scriptProperties, 'step');
    $lastStep = false;
    $currentStep = $modx->getOption($stepParam, $_GET, 1);

    $hooks = array('spam', 'FormaliciousHookSetForm');
    $preHooks = array('FormaliciousHookGetForm');
    $postHooks = array();
    $renderHooks = array('FormaliciousHookRenderForm');

    $emailOutput = array();

    if ($modx->getOption('form', $scriptProperties, false)) {
        $form = $modx->getObject('FormaliciousForm', [
            'id' => $modx->getOption('form', $scriptProperties, false)
        ]);

        if ($form) {
            if ((int) $form->get('published') === 0) {
                return $modx->lexicon('formalicious.form.notpublished', array(
                    'id' => $form->get('id'),
                    'form' => $form->get('name')
                ));
            }

            /**
             * Load the FormIt class and run the prehooks.
             * This has to be done to be able to get the correct values from $hook->getValue() calls
             */
            if ($form->get('prehooks')) {
                $modelPath = $modx->getOption(
                        'formit.core_path',
                        null,
                        $modx->getOption('core_path') . 'components/formit/'
                    ) . 'model/formit/';

                $modx->loadClass('FormIt', $modelPath, true, true);

                $fi = new FormIt($modx);
                $fi->initialize('web');
                $fi->config['preHooks'] = $form->get('prehooks');
                $request = $fi->loadRequest();
                $fields = $request->prepare();
                $request->handle($fields);
            }

            if ($form->get('posthooks')) {
                $formPostHooks = array_filter(explode(',', trim($form->get('posthooks'))));

                if (count($formPostHooks) >= 1) {
                    $hooks = array_merge($hooks, $formPostHooks);
                }
            }

            $query = $modx->newQuery('FormaliciousStep', [
                'form_id' => $form->get('id')
            ]);

            $query->sortby('rank', 'ASC');

            $steps = $modx->getCollection('FormaliciousStep', $query);
            $totalSteps = $modx->getCount('FormaliciousStep', $query);

            foreach ($steps as $step) {
                $validationStep = array();

                $query = $modx->newQuery('FormaliciousField', [
                    'step_id'   => $step->get('id'),
                    'published' => 1
                ]);

                $query->sortby('rank', 'ASC');

                foreach ($modx->getCollection('FormaliciousField', $query) as $field) {
                    $type = $field->getOne('Type');

                    if ($type) {
                        $fieldName          = 'field_' . $field->get('id');
                        $fieldValidation    = array();

                        if ((int) $field->get('required') === 1) {
                            $fieldValidation[] = 'required';
                        }

                        if ($type->get('validation') !== '') {
                            foreach (explode(',', $type->get('validation')) as $rule) {
                                $fieldValidation[] = $rule;
                            }
                        }

                        if (!empty($fieldValidation)) {
                            $validationStep[$fieldName] = $fieldValidation;
                        }

                        $fieldNames[$fieldName] = $field->get('title');

                        $emailOutput[] = '<tr>
                                <td width="30%"><strong>' . $field->get('title') . '</strong></td>
                                <td width="70%">[[!+fi.'. $fieldName . ':default=``]]</td>
                            </tr>';
                    }
                }

                $validation[] = $validationStep;
            }

            if ((int) $currentStep >= (int) $totalSteps) {
                $lastStep = true;

                $currentStep = $totalSteps;
            }

            $validation = $validation[$currentStep - 1];

            if ($lastStep) {
                if (!empty($form->get('emailto'))) {
                    $hooks[] = 'email';
                }

                if ((int) $form->get('saveform') === 1) {
                    $hooks[] = 'FormItSaveForm';
                }

                if ((int) $form->get('fiaremail') === 1) {
                    $hooks[] = 'FormItAutoResponder';
                }

                $hooks[] = 'FormaliciousHookRemoveForm';
                $hooks[] = 'redirect';

                $redirectTo     = $form->get('redirectto');
                $redirectParams = $modx->toJSON(array());

                $submitTitle    = $modx->lexicon('formalicious.submit');
            } else {
                $hooks[] = 'redirect';

                $redirectTo = $modx->resource->get('id');
                $redirectParams = $modx->toJSON(array(
                                                    $stepParam => $currentStep + 1
                                                ));

                $submitTitle    = $modx->lexicon('formalicious.next');
            }

            $placeholders = array_merge($form->toArray(), array(
                'redirectTo'        => $redirectTo,
                'redirectParams'    => $redirectParams,

                'emailTpl'          => $emailTpl,
                'fiarTpl'           => $fiarTpl,

                'hooks'             => implode(',', $hooks),
                'preHooks'          => implode(',', $preHooks),
                'postHooks'         => implode(',', $postHooks),
                'renderHooks'       => implode(',', $renderHooks),

                'fieldsemailoutput' => '',

                'validation'        => '',
                'customValidators'  => $customValidators,

                'fieldNames'        => implode(',', array_map(function ($v, $k) {
                    return $k . '==' . $v;
                }, $fieldNames, array_keys($fieldNames))),
                'formFields'        => implode(',', array_keys($fieldNames)),

                'fiarattachment'    => ''
            ));

            if (count($emailOutput) >= 1) {
                $placeholders['fieldsemailoutput'] = '<table width="100%" border="0" cellpadding="0" cellspacing="0">
                        ' . implode(PHP_EOL, $emailOutput) . '
                    </table>';
            }

            if (count($validation) >= 1) {
                $validation = array_map(function ($v, $k) {
                    return $k . ':' . implode(':', $v);
                }, $validation, array_keys($validation));

                if ($validate) {
                    $validation[] = $validate;
                }

                $placeholders['validation'] = implode(',', $validation);
            }

            if ($form->get('fiarattachment')) {
                $placeholders['fiarattachment'] = str_replace('//', '/', MODX_BASE_PATH . $form->get('fiarattachment'));
            }

            $parameters = array(
                'formid'        => $form->get('id'),
                'formTpl'       => $modx->getOption('formTpl', $scriptProperties, 'formTpl'),
                'stepTpl'       => $modx->getOption('stepTpl', $scriptProperties, 'stepTpl'),
                'stepParam'     => $stepParam,
                'currentStep'   => $currentStep,
                'submitVar'     => 'form_submit_' . $form->get('id'),
                'submitTitle'   => $submitTitle
            );

            if ($form->get('parameters')) {
                if (json_decode($form->get('parameters'), true)) {
                    $parameters = array_merge($parameters, json_decode($form->get('parameters'), true));
                }
            }

            $placeholders['parameters'] = implode(PHP_EOL, array_map(function ($v, $k) {
                return '&' . $k . '=`' . $v . '`';
            }, $parameters, array_keys($parameters)));

            return $modx->getChunk($parameters['formTpl'], array_merge($placeholders, $parameters));
        }
    }

?>