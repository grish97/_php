<?php


namespace app\Controller;

use Models\User;

class AuthController
{
    public function login() {
        echo view('auth.login',"Login");
    }

    public function register() {
        echo view('auth.register',"Register");
        unset($_SESSION['errors']);
        unset($_SESSION['values']);
    }

    public function store() {
        validate($_POST,[
            'name' => 'required|min:3|max:20',
            'last_name' => 'required|min:3|max:30',
            'email' => 'required|email|min:6|max:26|unique:users,email',
            'password' => 'required|min:3|max:30|confirmed'
        ]);

        if (!empty($_SESSION['errors'])) {
           redirect('register');
        }


    }


}