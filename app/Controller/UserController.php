<?php

namespace app\Controller;

use app\Models\Users;
use app\Models\Images;

class UserController
{
    public function index() {
       $users = Users::query()->get()->all();
       $avatar = Images::query()->where('is_avatar' ,'!=',null)->get()->all();
       echo view('users.index','Users',['users' => $users,'avatar' => $avatar]);
    }

    public function friendRequest($id) {
        echo $id;
    }
}