<?php


namespace app\Controller;

use app\Models\Users;
use app\Models\Images;
use Core\Mail\Mail;
use Carbon\Carbon;

class AuthController
{
    public function login() {
        echo view('auth.login',"Login");
    }

    public function sign_in() {
        unset($_SESSION['errors']);
        validate($_POST,[
            'email' => 'required|email|min:6|max:26',
            'password' => 'required|min:3|max:30'
        ]);

        if(isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            json_response(['error' => $errors]);
            return false;
        }

        $email = $_POST['email'];
        $password = hash('sha256',$_POST['password']);

        $user = Users::query()
                ->where('email','=',$email)
                ->get()->first();

        if(!empty($user)) {
            if ($user['password'] === $password && $user['email'] === $email && $user['verification_token'] == null) {
                //Auth SET COOKIE
                setcookie('auth_user_id', $user['id']);
                $_SESSION['userData'] = $user;
                json_response(['link' => '/profile']);
                return true;
            } elseif ($user['verification_token'] != null && ($user['password'] === $password) && ($user['email'] === $email)) {
                json_response(['message' => 'Your account is not verified']);
                return false;
            }
            json_response(['message' => 'Wrong Email and Password']);
            return false;
        }

        json_response(['message' => 'Wrong Email and Password']);
    }

    public function register() {
        echo view('auth.register',"Register");
    }

    public function store() {
        unset($_SESSION['errors']);

        validate($_POST,[
            'name' => 'required|string|min:3|max:20',
            'last_name' => 'required|string|min:3|max:30',
            'email' => 'required|email|min:6|max:26|unique:users,email',
            'password' => 'required|min:3|max:30|confirmed',
            'image'    => 'image'
        ]);

        if (!empty($_SESSION['errors'])) {
           $errors = $_SESSION['errors'];
           json_response(['error' => $errors]);
           return false;
        }


        $name = $_POST['name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = hash('sha256',$_POST['password']);
        $avatar = isset($_FILES['file']) ? $_FILES['file']['name'] : '';
        $token = str_random(60);

        if(isset($_FILES['file'])) {
            $file = $_FILES['file'];
            $file_name = $file['name'];
            $tmp_name = $file['tmp_name'];
            $direct = './public/storage/avatar/';
            for($i = 0; $i < count($tmp_name);$i++) {
                move_uploaded_file($tmp_name[$i],$direct.$file_name[$i]);
            }
        }

        Users::query()->create([
            'name',
            'last_name',
            'email',
            'password',
            'verification_token',
        ], [
            $name,
            $last_name,
            $email,
            $password,
            $token,
        ]);
        $userId = Users::query()->max('id')->first();
        $userId = $userId['last_id'];
        if(!empty($avatar)) {
            foreach ($avatar as $image) {
                Images::query()
                    ->insert([
                        'name',
                        'is_avatar'
                    ],[
                        $image,
                        $userId
                    ]);
            }
        }

        //SEND VERIFY MAIL
        new Mail("$email",'Verify Account','email.registerVerify',$token);
        //VERIFY VIEW
        json_response(['link' => '/v-link']);
        return true;
    }

    public function verify_link() {
        echo view('page.verify_link','Verification');
    }

    public function verify($token) {
        $user_token = Users::query()->where('verification_token','=',$token)->get()->first();

        if(!empty($user_token)) {
            Users::query()->where('verification_token', '=', $token)
                    ->update([
                        'verification_token' => null
                    ]);
           redirect('/login');
        }else {
           echo "<h2 class='text-font-weight'>404 Page not found</h2>
                  <a href='http://mvc.loc/' class='btn'>Home</a>";
        }
    }


}