<?php
namespace app\Controller;

use app\Models\Images;

Class HomeController
{
    public function index() {
        echo view('home.index',"Home");
    }

    public function profile() {
        $userId = userData('id');
        $avatar = Images::query()->where('is_avatar','=',$userId)->get()->all();
        $avatar = image($avatar,'avatar.png');
        echo view('home.profile','MY Profile',['avatar' => $avatar]);
    }

    public function logout() {
        unset($_COOKIE['auth_user_id']);
        unset($_SESSION['userDate']);
        setcookie('auth_user_id','',time()- 3600);
        redirect('login');
    }
}