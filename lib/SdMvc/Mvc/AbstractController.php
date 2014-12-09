<?php

namespace SdMvc\Mvc;

use SdMvc\Mvc\Listener\AfterActionListener;
use SdMvc\Mvc\Listener\BeforeRedirectListener;

/**
 * Description of AbstractController
 *
 * @author Rhys
 */
class AbstractController implements BeforeRedirectListener, AfterActionListener {
    public $app;
    
    public function __construct(App $app) {
        $this->app = $app;
        $this->app->eventDispatcher->addListener(MvcEvent::BEFORE_REDIRECT, array($this, 'beforeRedirect'));
        $this->app->eventDispatcher->addListener(MvcEvent::AFTER_ACTION, array($this, 'beforeRedirect'));
    }
    
    public function beforeRedirect(MvcEvent $event) {
        
    }

    public function AfterAction(MvcEvent $event) {
        
    }

}
