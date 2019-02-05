<?php

namespace config;
use app\Controller;


Class Router
{
    private $routers;

    public function __construct () {
        $this->routers = include "routers.php";
        $this->run();
    }

    public function run () {
        $uri = $_SERVER['REQUEST_URI'];
        $parts = array_values(array_filter(explode('/',$uri)));
        $controllerName = $parts[0] ? ucfirst($parts[0]) :'Home';
        $controllerClassName = "/Controller/{$controllerName}Controller";
        $object = new $controllerClassName;
        $action = !empty($parts[1]) ? $parts[1] : 'index';
        $object->$action();

    }


}