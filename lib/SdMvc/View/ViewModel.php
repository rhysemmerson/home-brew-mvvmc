<?php

namespace SdMvc\View;

use Slim\Helper\Set;

/**
 * Description of ViewModel
 *
 * @author Rhys
 */
class ViewModel extends Set {

    public $template = false;
    public $layout = null;
    public $captureTo = 'content';
    public $children = array();
    public $result = false;
    
    public function __construct($items = array(), $template = false) {
        $this->template = $template;
        parent::__construct($items);
    }

    public function addChild(ViewModel $child, $captureTo = 'content') {
        if (!$child->captureTo) {
            $child->captureTo = $captureTo;
        }
        
        $this->children [] = $child;
    }

}
