<?php

/* init autoloaders first */
include APP_ROOT . DS . 'vendor' . DS . 'autoload.php';

$packages = array(
    'SdMvc' => LIB_SRC . DS . 'SdMvc'
);

$pkg = file_exists(CONFIG_DIR . DS . 'packages.php') ? include CONFIG_DIR . DS . 'packages.php' : [];

if (!empty($pkg)) {
    $packages = array_merge($packages, $pkg);
}

require_once 'autoload.php';

$autoloader = new SD_Autloader($packages);
$autoloader->register();

/* init app */

use SdMvc\Mvc\App;
use SdMvc\Mvc\FrontController;
use SdMvc\View\Renderer;
use SdMvc\View\Resolver;
use SdMvc\View\View;
use Slim\Slim;

$config = array(
    'template.path' => VIEW_DIR
);

// let dev modify $config
include CONFIG_DIR . DS . 'bootstrap.php';

$slim = new Slim($config);

$app = new App($slim, $config);

// register controllers from package config
$controllers = [];

foreach ($packages as $pkg) {
    if (is_array($pkg) && isset($pkg['controllers'])) {
        $controllers = array_merge($controllers, $pkg['controllers']);
    }
}

$app->frontController = new FrontController($controllers, $app);

// map controller route to FrontController
$slim->map('/:controller(/:action)', array($app->frontController, 'resolve'))->via('GET', 'POST');

// include custom routes
if (file_exists(CONFIG_DIR . DS . 'routes.php')) {
    $routes = include CONFIG_DIR . DS . 'routes.php';

    if (is_array($routes)) {
        $app->frontController->addRoutes($routes);
    }
}

// initialize view
$resolver = new Resolver();

$resolver->append(VIEW_DIR . DS . 'Layout');
$resolver->append(VIEW_DIR);

$view = new View();
$view->addHelpers([]);

$app->renderer = new Renderer($app);
$app->renderer->setResolver($resolver);
$app->view = $view;
// done
$app->run();
