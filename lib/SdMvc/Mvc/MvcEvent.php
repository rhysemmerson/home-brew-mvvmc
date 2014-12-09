<?php

namespace SdMvc\Mvc;

use Symfony\Component\EventDispatcher\Event;

/**
 * Description of MvcEvent
 *
 * @author Rhys
 */
class MvcEvent extends Event {

    const AFTER_ACTION = 'after_action';
    const BEFORE_REDIRECT = 'before_redirect';

    public $app;
    public $controller;
    public $action;
    public $actionResult;

    public function __construct(App $app) {
        $this->app = $app;
    }

}
