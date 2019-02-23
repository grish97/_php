<?php
namespace app\Controller;

use app\Models\Users;
use app\Models\Images;
use app\Models\FriendPivot;

Class HomeController
{
    public $userId;

    public function __construct() {
        if(auth()) $this->userId = userData('id');
    }

    public function index() {
        echo view('home.index',"Home");
    }

    public function profile() {
        $user = Users::query()->where('id','=',$this->userId)->get()->first();
        $_SESSION['userData'] = $user;
        $avatar = Images::query()->where('is_avatar','=',$this->userId)->get()->all();
        $avatar = image($avatar,'avatar.jpg');
        echo view('profile.main','MY Profile',['avatar' => $avatar]);
    }

    public function logout() {
        unset($_COOKIE['auth_user_id']);
        unset($_SESSION['userDate']);
        setcookie('auth_user_id','',time()- 3600);
        redirect('login');
    }
}