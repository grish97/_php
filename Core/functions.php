<?php

session_start();

function dd (...$args) {
     var_dump($args);
     die();
}

function redirect($path) {
    header("Location:" . $path);
}

function base_path($path) {
    $path = str_replace('/',DIRECTORY_SEPARATOR,$path);
    return BASE_PATH . DIRECTORY_SEPARATOR . $path . '.php';
}

function app_path($className) {
    return BASE_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . "{$className}.php";
}

function views_path($path) {
    $path = str_replace('/',DIRECTORY_SEPARATOR,$path);
    return BASE_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $path . ".php";
}

function view($page,$title = '') {
    $view = new Core\View();
    return $view->render($page,$title);
}

function validate($data,$rule) {
    $validator = new Core\Validator($data,$rule);
    $validator->validate();
}


function getError ($field) {
    return isset($_SESSION['errors'][$field]) ? $_SESSION['errors'][$field] : '';
}

function getOldVal($field) {
    return isset($_SESSION['values'][$field]) ? $_SESSION['values'][$field] : '';
}
