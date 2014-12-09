<?php

namespace SdMvc\View\Helper;

use Cake\Utility\Inflector;
use SdMvc\View\View;
use SdMvc\View\ViewHelper;
use Slim\Helper\Set;

/**
 * Description of AssetHelper
 *
 * @author Rhys
 */
class AssetHelper extends ViewHelper {

    protected $scripts;
    protected $styles;
    protected $enqueuedScripts;
    protected $enqueuedStyles;

    public function __construct(View $view) {
        $this->scripts = new Set();
        $this->styles = new Set();

        $this->enqueuedScripts = [];
        $this->enqueuedStyles = [];

        parent::__construct($view);
    }

    public function scripts() {
        $queue = $this->processQueue($this->enqueuedScripts, $this->scripts, 'scripts');

        $ml = '';

        foreach ($queue as $slug) {
            $ml .= '<script type="text/javascript" src="' . $this->scripts[$slug]['src'] . '"></script>' . "\n        ";
        }

        $this->view->Blocks->prepend('scripts', $ml);
        $this->view->Blocks->prepend('scripts', "<!-- scripts -->\n        ");
        $this->view->Blocks->append('scripts', "<!-- /scripts -->\n");

        return $this->view->Blocks->get('scripts');
    }

    public function styles() {
        $queue = $this->processQueue($this->enqueuedStyles, $this->styles, 'styles');

        $ml = '';

        foreach ($queue as $slug) {
            $ml .= '<link rel="stylesheet" href="' . $this->styles[$slug]['src'] . "\" />\n        ";
        }

        // output using a content block
        $this->view->Blocks->prepend('styles', $ml);
        $this->view->Blocks->prepend('styles', "<!-- stylesheets -->\n        ");
        $this->view->Blocks->append('styles', "<!-- /stylesheets -->\n");

        return $this->view->Blocks->get('styles');
    }

    public function registerScript($slug, $file, $dependencies = []) {
        $this->scripts->set($slug, new Set([
            'src' => $file, 'deps' => $dependencies
        ]));
    }

    public function registerStyle($slug, $file, $dependencies = []) {
        $this->styles->set($slug, new Set([
            'src' => $file, 'deps' => $dependencies
        ]));
    }

    /**
     * Enqueue a script by it's slug
     * 
     * @param string|array A slug referring to a script or an array of slugs
     */
    public function enqueueScript($slug) {
        if (is_array($slug)) {
            array_map([$this, 'enqueueScript'], $slug);
            return;
        }

        $this->enqueuedScripts [] = $slug;
    }

    /**
     * Enqueue a style by it's slug
     * 
     * @param string|array A slug referring to a style or an array of slugs
     */
    public function enqueueStyle($slug) {
        if (is_array($slug)) {
            array_map([$this, 'enqueueStyle'], $slug);
            return;
        }

        $this->enqueuedStyles [] = $slug;
    }

    protected function processQueue($enqueued, Set $registered, $type) {
        $queue = [];

        /*
         * add slug's dependencies to queue if they haven't been already 
         * then add slug 
         */
        foreach ($enqueued as $slug) {
            $this->addToQueue($queue, $registered, $slug, $type);
        }

        usort($queue, function($a, $b) use ($registered) {
            $aDeps = $registered[$a]['deps'];
            $bDeps = $registered[$b]['deps'];

            return in_array($a, $bDeps) ? -1 : in_array($b, $aDeps);
        });

        return $queue;
    }

    /**
     * Recursive iterator function to enqueue required dependencies.
     * 
     * @param type $queue
     * @param type $def
     * @param type $slug
     * @param type $type
     * @return type
     */
    protected function addToQueue(&$queue, $def, $slug, $type) {
        if (!$def->has($slug)) {
            // TODO: log warn script not registered
            // if ($app->config->debug) 
            $this->view->Blocks->append($type, sprintf("<!-- Warning: %s '%s' not registered -->\n        ", Inflector::singularize($type), $slug));
            return;
        }

        if (!in_array($slug, $queue)) {
            $queue [] = $slug;
        }
        
        foreach ($def[$slug]['deps'] as $dep) {
            $this->addToQueue($queue, $def, $dep, $type);
        }
    }
}
