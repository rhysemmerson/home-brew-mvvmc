<?php

/**
 * return [
 *      [
 *          'route'         : a slim route
 *          'controller'    : controller alias
 *          'action'        : action method
 *          'methods'       : HTTP method, string or array of methods,
 *          'name'          : A name for this route
 *      }
 * ]
 */
return [
    [
        'route' => '/(:page)(/:subPage)',
        'controller' => 'Pages',
        'action' => 'index'
    ]
];
