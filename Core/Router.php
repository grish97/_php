<?php

namespace Core;

Class Router
{
    private $routers;

    public function __construct()
    {
        $this->routers = require_once 'routers.php';
        $this->getURI();
    }

    private function getURI()
    {
        $uri = $_SERVER['REQUEST_URI'];
        if(!empty($uri)) {
            return explode('/',$uri)[1];
        }
    }

    public function getRout()
    {
        $uri = $this->getURI();
        $get = !empty(array_keys($_GET)[1]) ? (array_keys($_GET)[1] .'='. array_values($_GET)[1])  : '';

        foreach($this->routers as $key => $value) {
            if (($key . $get) === $uri) {
                $parts = explode('/',$value);
                $controller = ucfirst($parts[0]) . 'Controller';
                $action = $parts[1];
                $params = isset(array_keys($_GET)[1]) ?  array_values($_GET)[1] : '';
                $controllerFile = app_path($controller);

                if(file_exists($controllerFile)) {
                    $class_name = "\\app\\Controller\\{$controller}";
                    $object = new $class_name();
                    $result = empty($params) ? $object->$action() : $object->$action($params);
                    if ($result !== null) break;
                }
            }

        }

    }
}

