<?php

namespace app\Controller;

use app\Models\Products;
use Carbon\Carbon;

class ProductController
{
    public function __construct() {

    }

    public function index($role) {
        if ($role === 'my') {
            $creator_id = userData('id');
            $product = Products::query()->where('creator_id', '=',$creator_id)
                ->get()->all();
        }elseif ($role === 'all') {
            $product = Products::query()->get()->all();
        }

        if(empty($product)) {
            echo '<h3>No Products</h3>';
            return false;
        }

        echo view('product.index',"Product",['product' => $product]);
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
            $file = $_FILES['file'];
            $file_name = $file['name'];
            $tmp_name = $file['tmp_name'];
            $destination = base_dir('public/storage/products');

            for($i = 0; $i < count($tmp_name); $i++) {
                move_uploaded_file($tmp_name[$i],"$destination/$file_name[$i]");
            }

            $image = implode(', ', $_FILES['file']['name']);
        }

        $image_name = isset($image) ? $image : null;

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

        redirect('profile');
    }

    public function edit() {

    }

    public function show($id) {
        $product = Products::query()
                    ->where('id','=',$id)
                    ->get()->first();
//        dd(image($product['image_name']));
        echo view('product.show','Product', ['product' => $product]);
    }

    public function update() {

    }

    public function delete() {

    }
}