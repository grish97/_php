<?php


namespace app\Controller;

use app\Models\Users;
use Core\Mail\Mail;
use Carbon\Carbon;

class AuthController
{
    public function login() {
        echo view('auth.login',"Login");
        unset($_SESSION['errors']);
        unset($_SESSION['notFound']);
        unset($_SESSION['values']);
    }

    public function sign_in() {
        validate($_POST,[
            'email' => 'required|email|min:6|max:26',
            'password' => 'required|min:3|max:30'
        ]);

        if(isset($_SESSION['errors'])) {
            redirect('login');
            return false;
        }
        //https://www.w3schools.com/w3css/tryw3css_templates_social.htm#
        $email = $_POST['email'];
        $password = hash('sha256',$_POST['password']);

        $user = Users::query()
                ->where('email','=',"$email")
                ->get()->first();

        if (!empty($user) && $user['password'] === $password) {
            //Auth SET COOKIE
            setcookie('auth_user_id',$user['id']);
            $_SESSION['userData'] = $user;
            redirect('profile');
        }elseif(empty($user)) {
            //EMAIL ADDRESS DOES NOT EXIST
            $_SESSION['notFound'] = 'Address does not exist!';
            redirect('login');
        }else {
            redirect('login');
        }
    }

    public function register() {
        echo view('auth.register',"Register");
    }

    public function store() {
        unset($_SESSION['errors']);
        validate($_POST,[
            'name' => 'required|min:3|max:20',
            'last_name' => 'required|min:3|max:30',
            'email' => 'required|email|min:6|max:26|unique:users,email',
            'password' => 'required|min:3|max:30|confirmed'
        ]);

        if (!empty($_SESSION['errors'])) {
           $errors = $_SESSION['errors'];
           echo json_encode(['error' => $errors]);
           return false;
        }

        $name = $_POST['name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = hash('sha256',$_POST['password']);
        $token = str_random(60);

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
        //SEND VERIFY MAIL
        new Mail("example@gmail.com",'Verify Account','email.registerVerify',$token);
        //VERIFY VIEW
        echo json_encode(['message' => 'success']);
    }

    public function verify($token) {
        $user_token = Users::query()->where('verification_token','=',$token)->get()->first();

        if(!empty($user_token)) {
            Users::query()->where('verification_token', '=', $token)
                    ->update([
                        'verification_token' => null,
                        'email_verified_at' => Carbon::now()
                    ]);
           redirect('login');
        }else {
           echo "<h2 class='text-font-weight'>404 Page not found</h2>
                  <a href='http://mvc.loc/' class='btn'>Home</a>";
        }
    }


}