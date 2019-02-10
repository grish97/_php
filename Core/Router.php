<?php

namespace Core;
use \app\Controller\AuthController;

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

    public function getRout() {
        $uri = $this->getURI();
        foreach ($this->routers as $uriPattern  => $path) {

            if ($uriPattern === $uri) {
                $parts = explode('/', $path);
                $controller = ucfirst($parts[0]) . "Controller";
                $action = $parts[1];
                $controllerFile = app_path($controller);

                if (file_exists($controllerFile)) {
                    $class_name = "\\app\\Controller\\{$controller}";
                    $object = new $class_name();
                    $result = $object->$action();
                    if ($result !== null) {
                        break;
                    }
                }
            }
        }
    }

}
