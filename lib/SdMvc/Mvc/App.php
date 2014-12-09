<?php

namespace SdMvc\Mvc;

use Cake\Utility\Inflector;
use SdMvc\Mvc\Listener\AfterActionListener;
use SdMvc\Mvc\Listener\BeforeRedirectListener;
use SdMvc\View\ViewModel;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Description of App
 *
 * @author Rhys
 */
class App implements BeforeRedirectListener, AfterActionListener {
    public $slim;
    public $config;
    public $view;
    public $renderer;
    public $eventDispatcher;
    public $mvcEvent;
    
    protected $data;
    
    public function __construct($slim, $config = array()) {
        $this->slim = $slim;
        $this->config = $config;
        
        $this->eventDispatcher = new EventDispatcher();
        
        $this->eventDispatcher->addListener(MvcEvent::BEFORE_REDIRECT, array($this, 'beforeRedirect'));
        $this->eventDispatcher->addListener(MvcEvent::AFTER_ACTION, array($this, 'afterAction'));
        
        $this->mvcEvent = new MvcEvent($this);
    }
    
    public function beforeRedirect(MvcEvent $event) {
        /* Add controller view dir to template path stack */
        $this->renderer->resolver->append(VIEW_DIR . DS . $event->controller);
    }
    
    public function afterAction(MvcEvent $event) {
        /* invoke view and render template/s */
        $this->invokeView($event->actionResult);
    }
    
    public function invokeView($actionResult) {
        if ($actionResult === null) {
            $actionResult = new ViewModel();
        }
        
        if (!($actionResult instanceof ViewModel) && is_array($actionResult)) {
            $actionResult = new ViewModel($actionResult);
        }
        
        if (!$actionResult->template) {
            $actionResult->template = $this->mvcEvent->controller . DS . Inflector::underscore($this->mvcEvent->action);
        }
        
        if ($actionResult->layout !== false) {
            $layout = new ViewModel();
            $layout->template = $actionResult->layout ?: 'default';
            $layout->addChild($actionResult);
            
            echo $this->renderer->render($layout);
            
            return;
        }
        
        echo $this->renderer->render($actionResult);
    }
    
    public function __call($name, $arguments) {
        call_user_func_array([$this->slim, $name], $arguments);
    }
    
    public function __get($name) {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
    }
    
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

}
