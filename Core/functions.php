<?php
session_start();
function dd (...$args) {
     var_dump($args);
     die();
}

function redirect($path) {
    header("Location:" . $path);
}

function getRoute () {
    $router = new Core\Router();
    $router->getRout();
}

function base_dir($path) {
    $path = str_replace('/',DIRECTORY_SEPARATOR,$path);
    return BASE_PATH . DIRECTORY_SEPARATOR . $path;
}

function base_path($path) {
    $path = str_replace('/',DIRECTORY_SEPARATOR,$path);
    return BASE_PATH . DIRECTORY_SEPARATOR . $path . '.php';
}

function app_path($className) {
    return BASE_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . "{$className}.php";
}

function views_path($path) {
    $path = str_replace('.',DIRECTORY_SEPARATOR,$path);
    return BASE_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $path . ".php";
}

function view($page,$title = '',$params = []) {
    $view = new Core\View();
    return $view->render($page,$title,$params);
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

function email() {
    if(isset($_SESSION['notFound'])) {
        return $_SESSION['notFound'];
    }
}

function auth() {
    if(isset($_COOKIE['auth_user_id'])) {
        return true;
    }
}

function userData ($data) {
    return $_SESSION['userData']["$data"];
}

function image($image,$default) {
    $image_arr = [];
    if(!empty($image)) {
        foreach($image as $key => $value) {
            $image_arr[$key] = $value['name'];
        }
    }else $image_arr[0] = $default;

    return $image_arr;
}

function hasRequest () {
    $userController = new app\Controller\UserController();
     return $userController->hasRequest();
}

function roleButton($sentRequest,$userId,$friendsId) {
    $buttonText = 'Friends';
    $action = "data-action=friendRequest/$userId";
    $request = 'request';
    $btn_color = 'btn-info';
    if(!empty($sentRequest)) {
        foreach($sentRequest as $val) {
            if($val['id_to'] == $userId) {
                $buttonText =  'Sent';
                $action = '';
                $request = '';
                $btn_color = 'btn-light';
            }
        }
    }
    if (!empty($friendsId)) {
        foreach($friendsId as $id) {
            if($id === $userId) {
                $buttonText =  '<i class="far fa-check-circle"></i> Friends';
                $action = '';
                $request = '';
                $btn_color = 'btn-light';
            }
        }
    }

    $button = "<button class='btn $btn_color float-right $request'  $action>$buttonText</button>";
    return $button;
}

function str_trim ($string) {
    $string = str_replace(' ', '', $string);
    return $string;
}

function str_random ($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, ($charactersLength - 1))];
    }
    return $randomString;
}

function verify_token($action) {
    $token = $_SESSION['verification_token'];
    if($token) {
        if($action === 'get') {
            return $token;
        }elseif ($action === 'delete') {
            unset($token);
        }
    }else {
        return false;
    }
}

function json_response(array $data) {
    echo json_encode($data);
}
