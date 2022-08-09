<?php
namespace Sterc\Formalicious\Snippets;

use Sterc\Formalicious;
use MODX\Revolution\modX;

class Base extends Formalicious
{
    /**
     * @access public.
     * @var Array.
     */
    public $properties = [];

    /**
     * @access public.
     * @param String $key.
     * @param Mixed $default.
     * @return Mixed.
     */
    public function getProperty($key, $default = null)
    {
        $deprecated = [
            'tplForm'       => 'formTpl',
            'tplStep'       => 'stepTpl',
            'tplEmail'      => 'emailTpl',
            'tplFiarEmail'  => 'fiarTpl'
        ];

        if (isset($deprecated[$key])) {
            if (isset($this->properties[$deprecated[$key]])) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, '[Formalicious] Deprecated FormaliciousRenderForm snippet property \'' . $deprecated[$key] . '\' use \'' . $key . '\' instead.');

                return $this->properties[$deprecated[$key]];
            }
        }

        if (isset($this->properties[$key])) {
            return $this->properties[$key];
        }

        return $default;
    }

    /**
     * @access public.
     * @param String $name.
     * @param Array $properties.
     * @return String.
     */
    public function getChunk($name, array $properties = [])
    {
        if (class_exists('pdoTools') && $pdo = $this->modx->getService('pdoTools')) {
            if ((bool) $this->getProperty('usePdoTools')) {
                if ((bool) $this->getProperty('usePdoElementsPath')) {
                    $elementsPath = $this->modx->getOption('pdotools_elements_path');
                } else {
                    $elementsPath = $this->getProperty('elementsPath', $this->config['core_path']);
                }

                return $pdo->getChunk($name, array_merge([
                    'elementsPath' => $elementsPath
                ], $properties));
            }
        }

        $type = 'CHUNK';

        if (strpos($name, '@') === 0) {
            $type = substr($name, 1, strpos($name, ' ') - 1);
            $name = ltrim(substr($name, strpos($name, ' ') + 1, strlen($name)));
        }

        switch (strtoupper($type)) {
            case 'FILE':
                if (false !== strrpos($name, '.')) {
                    $name = $this->config['core_path'] . $name;
                } else {
                    $name = $this->config['core_path'] . $name . '.chunk.tpl';
                }

                if (file_exists($name)) {
                    $chunk = $this->modx->newObject('modChunk', [
                        'name' => $this->config['namespace'] . uniqid()
                    ]);

                    if ($chunk) {
                        $chunk->setCacheable(false);

                        return $chunk->process($properties, file_get_contents($name));
                    }
                }

                break;
            case 'INLINE':
                $chunk = $this->modx->newObject('modChunk', [
                    'name' => $this->config['namespace'] . uniqid()
                ]);

                if ($chunk) {
                    $chunk->setCacheable(false);

                    return $chunk->process($properties, $name);
                }

                break;
        }

        return $this->modx->getChunk($name, $properties);
    }

    /**
     * @access public.
     * @param String $content.
     * @return String.
     */
    public function parseContent($content)
    {
        if (!empty($content)) {
            if (preg_match('/^<(.*?)>/si', $content)) {
                if (preg_match('/^<(i|em|b|strong|a)(.*?)>/si', $content)) {
                    return '<p>' . $content . '</p>';
                }
            } else {
                return '<p>' . $content . '</p>';
            }
        }

        return $content;
    }

    /**
     * @access public.
     * @param Object $hook.
     * @return Mixed.
     */
    public function getFormValues($hook)
    {
        $formit =& $hook->formit;
        $values = $hook->getValues();

        $storageKey = 'Formalicious_form_' . $formit->config['formaliciousFormId'];

        if (isset($_SESSION[$storageKey])) {
            $values = array_merge($_SESSION[$storageKey], $values);
        }

        $hook->setValues($values);
        $this->modx->toPlaceholders(array_map(function ($value) {
            if (is_array($value)) {
                if (isset($value['name'])) {
                    return $value['name'];
                }

                return implode(',', $value);
            }

            return $value;
        }, $values), rtrim($formit->config['placeholderPrefix'], '.'));

        $_SESSION[$storageKey] = $values;

        return $values;
    }

    /**
     * @access public.
     * @param Object $hook.
     * @return Mixed.
     */
    public function removeFormValues($hook)
    {
        $formit =& $hook->formit;

        $storageKey = 'Formalicious_form_' . $formit->config['formaliciousFormId'];

        if (isset($_SESSION[$storageKey])) {
            unset($_SESSION[$storageKey]);
        }

        return true;
    }
}