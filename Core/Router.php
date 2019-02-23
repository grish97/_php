<?php

namespace Core;

Class Router
{
    private $routers;
    private $pageCond;
    public $page;

    public function __construct()
    {
        $this->routers = require_once 'routers.php';
        $this->pageCond = require_once 'conditionsPage.php';
        $this->page = false;
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
                $this->middleware($key);
                $this->page = true;
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

        if($this->page === false) {
           echo view('page.404','Page not found');
        }

    }

    private function middleware($url) {
        foreach($this->pageCond as $key => $page) {
            if($key === 'auth' && in_array($url,$page)) {
                if(!auth()) {
                    redirect('login');
                    return false;
                }
                return true;
            }elseif ($key === 'guest' && in_array($url,$page)) {
                if(auth()){
                    redirect('profile');
                    return false;
                }
                return true;
            }

        }
    }
}

