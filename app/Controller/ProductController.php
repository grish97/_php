<?php

namespace app\Controller;

use app\Models\Products;
use Carbon\Carbon;

class ProductController
{
    public function __construct() {

    }

    public function create() {
        echo view('product.create','Create Product');
        unset($_SESSION['errors']);
        unset($_SESSION['values']);
    }

    public function store() {
        validate($_POST,[
            'name' => 'required|min:3|max:50',
            'desc' => 'required|min:3|max:1000',
            'price' => 'required|number',
        ]);

        if(isset($_SESSION['errors'])) redirect('create-product');

        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $price = $_POST['price'];
        $image_name = explode('.',$_POST['file'])[0];
        $creator_id = $_COOKIE['auth_user_id'];

        print_r($_FILES);exit;
        Products::query()
                ->insert([
                    'name',
                    'description',
                    'price',
                    'image_name',
                    'creator_id',
                ],[
                    $name,
                    $desc,
                    $price,
                    $image_name,
                    $creator_id
                ]);

    }

    public function edit() {

    }

    public function update() {

    }

    public function delete_post() {

    }
}