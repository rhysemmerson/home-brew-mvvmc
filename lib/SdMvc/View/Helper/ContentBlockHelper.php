<?php

namespace SdMvc\View\Helper;

use SdMvc\View\View;
use SdMvc\View\ViewHelper;
use Slim\Helper\Set;


/**
 * Description of ContentBlockHelper
 *
 * @author Rhys
 */
class ContentBlockHelper extends ViewHelper {
    
    protected $blocks;
    
    protected $openBlock;
    
    public function __construct(View $view) {
        $this->blocks = new Set();
        
        parent::__construct($view);
    }

    public function start($name, $action = 'append') {
        $this->openBlock = $name;
        $this->openAction = $action;
        ob_start();
    }
    
    public function end() {
        $content = ob_get_clean();
        
        switch ($this->openAction) {
            case 'set':
                $this->set($this->openBlock, $content);
                break;
            case 'prepend':
                $this->append($this->openBlock, $content);
                break;
            case 'append': 
            default:
                $this->append($this->openBlock, $content);
        }
        
        return $this->get($this->openBlock);
    }
    
    public function set($name, $value) {
        $this->blocks->set($name, $value);
        return $this;
    }
    
    public function get($name, $default = '') {
        return $this->blocks->get($name, $default);
    }
    
    public function append($name, $content) {
        $value = $this->blocks->get($name, '');
        
        $this->blocks->set($name, $value . $content);
    }
    
    public function prepend($name, $content) {
        $value = $this->blocks->get($name, '');
        
        $this->blocks->set($name, $content . $value);
    }
}
