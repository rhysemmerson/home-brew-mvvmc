<?php

namespace SdCms\Controller;

use Cake\Utility\Inflector;
use SdMvc\Mvc\AbstractController;
use SdMvc\View\ViewModel;

/**
 * Description of PagesController
 *
 * @author Rhys
 */
class PagesController extends AbstractController {
    
    public function index($page = 'index', $subPage = false) {
        $vm = new ViewModel();
        
        $vm->template = 'Pages/' . Inflector::underscore(str_replace('-', '_', $page));
        
        return $vm;
    }
}
