<?php

namespace SdMvc\View;

use SdMvc\Mvc\App;

/**
 * Description of Renderer
 *
 * @author Rhys
 */
class Renderer {
    public $app;
    /** @var Resolver */
    public $resolver;
    
    public function __construct(App $app) {
        $this->app = $app;
        $this->view = $app->view;
    }
    
    public function render(ViewModel $vm) {
        foreach ($vm->children as $child) {
            $vm->{$child->captureTo} = $this->render($child);
        }
        
        return $this->renderView($vm);
    }
    
    public function renderView(ViewModel $vm) {
        if (!$this->resolver) {
            throw new \Exception('No template resolver added');
        }
        $templateFile = $this->resolver->resolve($vm->template);
        
        if (!$templateFile) {
            throw new \Exception('Could not locate template ' . $vm->template . print_r($this->resolver->getStack(), true));
        }
        
        return $this->app->view->render($templateFile, $vm->all());
    }
    
    public function getResolver() {
        return $this->resolver;
    }

    public function setResolver(Resolver $resolver) {
        $this->resolver = $resolver;
    }


}
