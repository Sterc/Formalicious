<?php
namespace Sterc\Formalicious\Controllers;

use Sterc\Formalicious\Model\FormaliciousForm;
use Sterc\Formalicious\Model\FormaliciousFieldType;

class Update extends Base
{
    /**
     * @access public.
     * @var Null|Object.
     */
    public $form;

    /**
     * @access public.
     */
    public function loadCustomCssJs()
    {
        $this->addHtml('<script type="text/javascript">
            Ext.onReady(function() {
                Formalicious.config.record = ' . $this->modx->toJSON($this->getForm()) . ';
            });
        </script>');

        if (!empty($this->modx->formalicious->config['preview_css'])) {
            $this->addCss($this->modx->formalicious->config['preview_css']);
        }

        $this->addJavascript($this->modx->formalicious->config['js_url'] . 'mgr/extra/DDTabPanel.js');
        $this->addJavascript($this->modx->formalicious->config['js_url'] . 'mgr/widgets/update.panel.js');
        $this->addJavascript($this->modx->formalicious->config['js_url'] . 'mgr/widgets/update.form.panel.js');
        $this->addLastJavascript($this->modx->formalicious->config['js_url'] . 'mgr/sections/update.js');

        $this->addHtml('<script type="text/javascript">
            Ext.onReady(function() {
                Formalicious.config.fieldtypes = ' . $this->modx->toJSON($this->getFieldTypes()) . ';
            });
        </script>');
    }

    /**
     * @access public.
     * @return String.
     */
    public function getPageTitle()
    {
        if ($this->form !== null) {
            return $this->modx->lexicon('formalicious') . ': ' . $this->form->get('name');
        }

        return $this->modx->lexicon('formalicious');
    }

    /**
     * @access public.
     * @return String.
     */
    public function getTemplateFile()
    {
        return $this->modx->formalicious->config['templates_path'] . 'update.tpl';
    }

    /**
     * @access public.
     * @param Array $scriptProperties.
     * @return void.
     */
    public function process(array $scriptProperties = [])
    {
        if (isset($scriptProperties['id'])) {
            $this->form = $this->modx->getObject(FormaliciousForm::class, [
                'id' => $scriptProperties['id']
            ]);
        } else {
            $this->form = $this->modx->newObject(FormaliciousForm::class);
        }

        if ($this->form === null) {
            $this->failure($this->modx->lexicon('formalicious.form_not_exists', ['id' => $scriptProperties['id']]));
        }

        $useEditor   = $this->modx->getOption('use_editor');
        $whichEditor = $this->modx->getOption('which_editor');

        if ($useEditor && !empty($whichEditor)) {
            $onRichTextEditorInit = $this->modx->invokeEvent('OnRichTextEditorInit', [
                'editor'    => $whichEditor,
                'elements'  => []
            ]);

            if (is_array($onRichTextEditorInit)) {
                $onRichTextEditorInit = implode('', $onRichTextEditorInit);
            }

            $this->setPlaceholder('onRichTextEditorInit', $onRichTextEditorInit);
        }
    }

    /**
     * @access public.
     * @return Array.
     */
    public function getForm()
    {
        if ($this->form !== null) {
            $form = $this->form->toArray();

            if (in_array($this->form->get('published_from'), ['-001-11-30 00:00:00', '-1-11-30 00:00:00', '0000-00-00 00:00:00', null], true)) {
                $form['published_from'] = '';
            }

            if (in_array($this->form->get('published_till'), ['-001-11-30 00:00:00', '-1-11-30 00:00:00', '0000-00-00 00:00:00', null], true)) {
                $form['published_till'] = '';
            }

            if (!empty($this->form->get('parameters'))) {
                $form['parameters'] = json_decode($this->form->get('parameters'), true);
            }

            return $form;
        }

        return [];
    }

    /**
     * @access public.
     * @return Array.
     */
    public function getFieldTypes()
    {
        $fieldTypes = [];

        $query = $this->modx->newQuery(FormaliciousFieldType::class);
        $query->sortby('name', 'ASC');

        foreach ($this->modx->getCollection(FormaliciousFieldType::class, $query) as $fieldType) {
            $fieldTypes[] = $fieldType->toArray();
        }

        return $fieldTypes;
    }
}
