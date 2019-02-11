<?php
namespace app\Controller;

Class HomeController
{
    public function index() {
        echo view('home.index',"Home");
    }

    public function logout() {
        unset($_COOKIE['auth_user_id']);
        unset($_SESSION['userDate']);
        setcookie('auth_user_id','',time()- 3600);
        redirect('login');
    }
}