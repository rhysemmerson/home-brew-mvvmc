<?php
/**
 * [
 *      '[Package Name]' => [
 *          'src' => 'Src Directory',
 *          'controllers' => [
 *              '[Controler alias]' => '[Controller class name]'
 *          ]
 *      ]
 * ]
 */
return [
    'SdCms' => [
        'src' => APP_SRC . DS . 'SdCms',
        'controllers' => [
            'Pages' => 'SdCms\Controller\PagesController'
        ]
    ]
];
