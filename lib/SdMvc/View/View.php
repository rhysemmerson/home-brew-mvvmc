<?php

namespace SdMvc\View;

use Slim\Helper\Set;

/**
 * This is the object templates are scoped within.
 *
 * @property SdMvc\View\Helper\HtmlHelper $Html Html helper
 * @property SdMvc\View\Helper\ContentBlockHelper $Blocks Content blocks helper
 * @property SdMvc\View\Helper\AssetHelper $Assets Asset utility
 */
class View {

    public $defaultHelpers = [
        'Html' => 'SdMvc\View\Helper\HtmlHelper',
        'Blocks' => 'SdMvc\View\Helper\ContentBlockHelper',
        'Assets' => 'SdMvc\View\Helper\AssetHelper'
    ];
    protected $helpers;
    protected $helperInst;

    public function __construct() {
        $this->helpers = new Set($this->defaultHelpers);
        $this->helperInst = new Set();
    }

    public function render($templateFile, $data = array()) {
        $fVar = '____templateFile____';

        unset($data[$fVar]);

        ${$fVar} = $templateFile;

        extract($data);

        ob_start();
        include $templateFile;
        return ob_get_clean();
    }

    public function __get($name) {
        if ($this->helpers->has($name)) {
            if (!$this->helperInst->has($name)) {
                $class = $this->helpers->get($name);

                $this->helperInst->set($name, new $class($this));
            }

            return $this->helperInst->get($name);
        }
    }

    public function addHelper($name, $helper) {
        $this->helpers->set($name, $helper);
    }

    public function addHelpers($helpers) {
        $this->helpers->replace($helpers);
    }

}
