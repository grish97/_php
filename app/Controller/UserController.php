<?php

namespace app\Controller;

use app\Models\Users;
use app\Models\Images;
use app\Models\FriendPivot;
use app\Models\Friends;

class UserController
{
    public function index($role) {
        $userId = userData('id');
        if($role === 'all') {
            $users = Users::query()->get()->all();
            $avatar = Images::query()->where('is_avatar' ,'!=',null)->get()->all();
        }else if($role === 'my') {
            $users = Friends::query()->where('user_1','=',$userId)->get()->all();
//            $avatar = Images::query()->where('is_avatar' ,'!=',null)->get()->all();
            dd($users);
        }
       echo view('users.index','Users',['users' => $users,'avatar' => $avatar]);
    }

    public function friendRequest($id) {
        $id_from = userData('id');
        $id_to = $id;
        if($id_from) {
            FriendPivot::query()
                ->insert([
                    'id_from',
                    'id_to'
                ],[
                    $id_from,
                    $id_to
                ]);
            json_response(['message' => 'Request has been successfully sent']);
        }
    }

    public function notice() {
        $userId = userData('id');
        $request = FriendPivot::query()->where('id_to','=',$userId)->get()->all();
        $from = [];
        if(empty($request)) {
            echo view('empty.layout','Empty');
            return false;
        }

        foreach($request as $key  => $id) {
            $users = Users::query()->where('id','=',$id['id_from'])->get()->all();
            foreach($users as $user) {
                $from[$key] = ['id' => $user['id'],'name' => $user['name'], 'last_name' => $user['last_name']];
            }
        }

        echo view('home.notice','Notice',['request' => $from]);
    }

     public function requestAnswer($answer) {
         $userId = userData('id');
         if(preg_match("/(cancel)/",$answer)) {
             $id_from = explode(':',$answer)[1];
             FriendPivot::query()->where(['id_from','id_to'],'AND',[$id_from,$userId])->delete();
             json_response(['delete' => 'element']);
         }

         $id_from = $answer;
         $row = FriendPivot::query()->where(['id_from','id_to'],'AND',[$id_from,$userId])->get()->all();
         if(!empty($row)) {
             FriendPivot::query()->where(['id_from','id_to'],'AND',[$id_from,$userId])->delete();

             Friends::query()
                 ->insert([
                     'user_1',
                     'user_2'
                 ],[
                     $userId,
                     $id_from
                 ]);
             json_response(['message' => 'You are friends','delete' => 'delete']);
         }

     }

    public function hasRequest () {
        if(auth()) {
            $userId = userData('id');
            $request = FriendPivot::query()->where('id_to','=',$userId)->get()->all();
            $request = !empty($request) ? count($request) : '';
            return $request;
        }
    }
}