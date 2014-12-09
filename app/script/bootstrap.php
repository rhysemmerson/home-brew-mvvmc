<?php
/**
 * Bootstrap file for scripts that run in the CLI environment
 */
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

/* define the directory structure */
define('WEB_ROOT', __DIR__ . DS . 'webroot');
define('APP_ROOT', dirname(dirname(WEB_ROOT)));

define('CONFIG_DIR', APP_ROOT . DS . 'app' . DS . 'config');

define('APP_SRC', APP_ROOT . DS . 'app' . DS . 'src');
define('LIB_SRC', APP_ROOT . DS . 'lib');

define('VIEW_DIR', APP_ROOT . DS . 'app' . DS . 'view');

include LIB_SRC . DS . 'config' . DS . 'bootstrap.php';