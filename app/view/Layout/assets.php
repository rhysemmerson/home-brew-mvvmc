<?php 

$this->Assets->registerScript('jquery', '/assets/js/jquery.min.js');
$this->Assets->registerScript('bootstrap', '/assets/js/bootstrap.min.js', ['jquery']);
$this->Assets->registerScript('bootstrap-datepicker', '/assets/js/bootstrap/bootstrap-datepicker.js', ['jquery', 'bootstrap']);

$this->Assets->registerStyle('font-awesome', '/assets/css/font-awesome.min.css');
$this->Assets->registerStyle('bootstrap', '/assets/css/bootstrap.min.css');
$this->Assets->registerStyle('bootstrap-extend', '/assets/css/bootstrap.extend.css', ['bootstrap']);
$this->Assets->registerStyle('default', '/assets/css/default.css', ['bootstrap-extend']);
