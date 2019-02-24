<?php

return [
    //HOME PAGE
    "/"          => 'home/index',
    "profile"   => 'home/profile',
    "edit-prof"   => 'user/edit',
    "update-prof" => 'user/update',
    //LOGOUT
    'logout'    => 'home/logout',
    //LOGIN
    "login"     => 'auth/login',
    //AUTH
    'sign_in'   => 'auth/sign_in',
    //REGISTER
    "register"  => 'auth/register',
    "store"     => 'auth/store',
    "v-link"    => 'auth/verify_link',
    "verify"   => 'auth/verify',
    //POST CRUD
    "create-product" => 'product/create',
    "store-product" => 'product/store',
    'product'       => 'product/index',
    'show'          => 'product/show',
    'delete'        => 'product/delete',
    'edit'          => 'product/edit',
    //USERS
    'users'          => 'user/index',
    'friends'        => 'user/friends',
    'friend'        => 'user/friend',
    'friendRequest' => 'user/friendRequest',
    'notice'         => 'user/notice',
    'requestAnswer' => 'user/requestAnswer',
    'deleteFriend'  => 'user/deleteFriend',
];

