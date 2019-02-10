<?php


namespace app\Controller;

use app\Models\Users;
use Core\Mail\Mail;
use Carbon\Carbon;

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

        $name = $_POST['name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = hash('sha256',$_POST['password']);
        $_SESSION['verification_token'] = str_random(60);

        Users::query()->create([
            'name',
            'last_name',
            'email',
            'password',
            'verification_token'
        ], [
            $name,
            $last_name,
            $email,
            $password,
            $_SESSION['verification_token']
        ]);

        new Mail("example@gmail.com",'Verify Account','email.registerVerify');

        redirect('login');
    }

    public function verify() {
        $token = $_SESSION['verification_token'];

        if(isset($token)) {
            Users::query()->where('verification_token','=',$token)
                ->update([
                    'verification_token' => null,
                    'email_verify_at' => Carbon::now()->toDateTimeString()
                ]);
            unset($token);
        }

        redirect('login');
    }


}