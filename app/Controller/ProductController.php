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
        $creator_id = $_COOKIE['auth_user_id'];
        if(is_uploaded_file($_FILES['file']['tmp_name'][0])) {
            $image_name = implode(', ', $_FILES['file']['name']);
        }
        exit;
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

                    $creator_id
                ]);
    }

    public function edit() {

    }

    public function update() {

    }

    public function delete() {

    }
}