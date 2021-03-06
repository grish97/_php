<?php

define('BASE_PATH',dirname(__FILE__ ));

require_once('vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
require_once('Core' . DIRECTORY_SEPARATOR . 'functions.php');

spl_autoload_register(function ($class_name) {
    $file =  $class_name . '.php';
    if(file_exists($file)) {
        require_once($file);
    }
});

getRoute();