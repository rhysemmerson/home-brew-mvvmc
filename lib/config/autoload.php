<?php

class SD_Autloader {

    public $packages;

    public function __construct(array $packages) {
        $this->packages = $packages;
    }

    public function autoload($class) {
        $location = false;

        foreach ($this->packages as $key => $path) {
            if (strpos($class, $key) === 0) {
                $class = preg_replace('|^' . $key . '\\\|', '', $class);
                
                if (is_array($path)) {
                    $location = $path['src'];
                } else {
                    $location = $path;
                }
            }
        }

        if (!$location) {
            return;
        }
        
        $filePath = $location . DS . str_replace(['\\', '/'], DS, $class) . '.php';

        if (!file_exists($filePath)) {
            throw new \Exception('Class file ' . $filePath . ' does not exist');
        }

        require_once $filePath;
    }

    public function register() {
        spl_autoload_register(array($this, 'autoload'));
    }

}
