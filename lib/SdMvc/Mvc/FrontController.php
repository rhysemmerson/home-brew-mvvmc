<?php

namespace SdMvc\Mvc;

/**
 * Routes requests to specified controllers
 *
 * @author Rhys
 */
class FrontController {

    public $controllers = array();
    public $app;
    public $currentController;
    public $currentAction;
    protected $mvcEvent;
    
    public function __construct($config, $app) {
        if (isset($config['Controllers'])) {
            $this->controllers = $config['Controllers'];
        } else {
            $this->controllers = $config;
        }
        
        $this->mvcEvent = $app->mvcEvent;
        
        $this->app = $app;
    }

    public function beforeRedirect($controller, $action) {
        $this->currentController = $controller;
        $this->currentAction = $action;
        
        $mvcEvent = $this->mvcEvent;
        $mvcEvent->controller = $controller;
        $mvcEvent->action = $action;
        
        $this->app->eventDispatcher->dispatch('before_redirect', $mvcEvent);
    }

    public function addRoutes($routes) {
        foreach ($routes as $route) {
            $this->addRoute($route);
        }
    }

    public function addRoute($route) {
        $route = array_merge(['action' => 'index', 'method' => 'all'], $route);

        $methods = ['GET', "POST", 'PUT', 'DELETE'];

        if (is_array($route['method'])) {
            $methods = $route['method'];
        } elseif (is_string($route['method']) && $route['method'] !== 'all') {
            $methods = [$route['method']];
        }

        $fController = $this;
        $theRoute = $route;

        foreach ($methods as $method) {
            $this->app->slim->map($theRoute['route'], function() use($theRoute, $fController) {
                $args = func_get_args();

                array_unshift($args, $theRoute['action']);
                array_unshift($args, $theRoute['controller']);

                call_user_func_array(array($fController, 'resolve'), $args);
            })->via($method);
        }
    }

    public function resolve($controller, $action = 'index') {

        if (isset($this->controllers[$controller])) {
            $controllerInst = new $this->controllers[$controller]($this->app);

            if (!method_exists($controllerInst, $action)) {
                throw new MissingActionException('method doesnt exits');
            }

            $args = func_get_args();

            unset($args[0]);
            unset($args[1]);

            $this->beforeRedirect($controller, $action, $args);

            $result = call_user_func_array(array($controllerInst, $action), $args);
            
            $mvcEvent = $this->mvcEvent;
            $mvcEvent->actionResult = $result;
            
            $this->app->eventDispatcher->dispatch('after_action', $mvcEvent);
        } else {
            $this->app->slim->pass();
        }
    }

}
