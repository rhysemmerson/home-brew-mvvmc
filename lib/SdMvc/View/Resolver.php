<?php

namespace SdMvc\View;

/**
 * Resolves files by searching a stack containing possible template
 * locations.
 *
 * @author Rhys
 */
class Resolver {
    
    protected $stack = [];
    public $ext = '.php';
    
    public function __construct() {
        
    }
    
    /**
     * Locate a template by searching the template path stack.
     * 
     * When the template is located the full file path is returned or false.
     * 
     * @param string $templateFile 
     * @return boolean|string The file path or false if one couldn't be found
     */
    public function resolve($templateFile) {
        $templateFile = str_replace(['\\', '/'], DS, $templateFile);
        
        foreach ($this->stack as $location) {
            $filePath = $location . DS . $templateFile . $this->ext;
            if (file_exists($filePath)) {
                return $filePath;
            }
        }
        
        return false;
    }
    
    public function getStack() {
        return $this->stack;
    }
    
    public function append($location) {
        $this->stack []= $location;
    }
    
    public function prepend($location) {
        array_unshift($this->stack, $location);
    }
    
}
