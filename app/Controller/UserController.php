<?php

namespace app\Controller;

use app\Models\Users;
use app\Models\Images;
use app\Models\FriendPivot;
use app\Models\Friends;

class UserController
{
    public $userId;

    public function __construct() {
        if(auth()) $this->userId = userData('id');
    }
    public function index() {
        $users = Users::query()->get()->all();
        $avatar = Images::query()->where('is_avatar' ,'!=',null)->get()->all();
        $sentRequest =FriendPivot::query()->where('id_from','=',$this->userId)->get()->all();
       echo view('users.index','Users',['users' => $users,'avatar' => $avatar,'sentRequest' => $sentRequest]);
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
        $request = FriendPivot::query()->where('id_to','=',$this->userId)->get()->all();
        $from = [];
        if(empty($request)) {
            echo view('layout.empty','Empty',['message' => 'You are have not notification']);
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
         if(preg_match("/(cancel)/",$answer)) {
             $id_from = explode(':',$answer)[1];
             FriendPivot::query()->where(['id_from','id_to'],'AND',[$id_from,$this->userId])->delete();
             json_response(['delete' => 'element']);
         }

         $id_from = $answer;
         $row = FriendPivot::query()->where(['id_from','id_to'],'AND',[$id_from,$this->userId])->get()->all();
         if(!empty($row)) {
             FriendPivot::query()->where(['id_from','id_to'],'AND',[$id_from,$this->userId])->delete();

             Friends::query()
                 ->insert([
                     'user_1',
                     'user_2'
                 ],[
                     $this->userId,
                     $id_from
                 ]);
             json_response(['message' => 'You are friends','delete' => 'delete']);
         }

     }

     public function friends() {
        $friends = Friends::query()->where(['user_1','user_2'],'OR',[$this->userId,$this->userId])->get()->all();
        $friendsId = [];
        $friendsInfo = [];
        if(!empty($friends)) {
            foreach($friends as $key => $friend) {
                $keys = array_keys($friend);
                if($friend[$keys[0]] !== $this->userId) $friendsId[$key] = $friend[$keys[0]];
                else if ($friend[$keys[1]] !== $this->userId) $friendsId[$key] = $friend[$keys[1]];
            }

            foreach ($friendsId as $key => $id) {
                $user = Users::query()->where('id','=',$id)->get()->first();
                $avatar = Images::query()->where('is_avatar','=',$user['id'])->get()->first();
                $avatar = !empty($avatar) ? $avatar['name'] : '';
                $friendsInfo[$key] = ['id' => $user['id'],'name' => $user['name'],'last_name' => $user['last_name'],'avatar' => $avatar];
            }

            echo view('users.friends','Friends',['friends' => $friendsInfo]);
            return true;
        }

        echo view('layout.empty','Empty',['message' => 'You are have not friends','url' => 'users','name' => 'Friends']);
        return false;
     }

     function deleteFriend($id) {
        $friends = Friends::query()->where(['user_1','user_2'],'OR',[$this->userId,$this->userId])->get()->all();
        if(!empty($friends)) {
            foreach($friends as $key => $friend) {
                $keys = array_keys($friend);

                if(($friend['user_1'] === $id && $friend['user_2'] === $this->userId) || ($friend['user_1'] === $this->userId && $friend['user_2'] === $id)) {
                    $user_1 = $friend['user_1'];
                    $user_2 = $friend['user_2'];
                    Friends::query()->where('user_1','=',$user_1)->delete();
                    json_response(['message' => 'Deleted']);
                }
            }
        }
     }

     public function friend($id) {
        $friend = Users::query()->where('id','=',$id)->get()->first();
        $avatar = Images::query()->where('is_avatar','=',$id)->get()->first();
        $avatar = !empty($avatar) ? $avatar['name']  : 'avatar.jpg';
        if(!empty($friend)) {
            $title = $friend['name'] . " " . $friend['last_name'];
            echo view('users.friend',$title,['friend' => $friend,'avatar' => $avatar]);
        }
     }

    public function hasRequest () {
        if(auth()) {
            $request = FriendPivot::query()->where('id_to','=',$this->userId)->get()->all();
            $request = !empty($request) ? count($request) : '';
            return $request;
        }
    }
}