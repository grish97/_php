<?php
namespace app\Controller;

Class HomeController
{
    public function index() {
        echo view('home.index',"Home");
    }
}