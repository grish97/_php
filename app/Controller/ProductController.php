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

    public function store($role) {
        validate($_POST,[
            'name' => 'required|min:3|max:50',
            'desc' => 'required|min:3|max:1000',
            'price' => 'required|number',
        ]);

        if(isset($_SESSION['errors'])) {
            redirect("$role-Product?store=$role");
            return false;
        }

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

        $image_name = isset($image) ? $image : 'default.jpg';

        if($role === 'create') {
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
        }elseif ($role === 'edit') {
            Products::query()
                ->update([
                    'name' => $name,
                    'description' => $desc,
                    'price' => $price,
                    'image_name' => $image_name ,
                    'updated_at' => Carbon::now()
                ]);
        }

        redirect($_SERVER['QUERY_STRING']);
    }

    public function edit($id) {
        unset($_SESSION['errors']);
        $product = Products::query()
                    ->where('id','=',$id)
                    ->get()->first();

        if ($product['creator_id'] !== userData('id')) {
            redirect('profile');
            return false;
        }
        echo view('product.edit',"Edit Product",['product' => $product]);
    }

    public function show($id) {
        $product = Products::query()
                    ->where('id','=',$id)
                    ->get()->first();

        echo view('product.show','Product', ['product' => $product]);
    }

//    public function update($id) {
//        validate($_POST,[
//            'name' => 'required|min:3|max:50',
//            'desc' => 'required|min:3|max:1000',
//            'price' => 'required|number',
//        ]);
//
//        if(isset($_SESSION['errors'])) {
//            redirect("edit?id=$id");
//        }
//
//        $name = $_POST['name'];
//        $desc = $_POST['desc'];
//        $price = $_POST['price'];
//        $creator_id = $_COOKIE['auth_user_id'];
//
//        if(is_uploaded_file($_FILES['file']['tmp_name'][0])) {
//            $file = $_FILES['file'];
//            $file_name = $file['name'];
//            $tmp_name = $file['tmp_name'];
//            $destination = base_dir('public/storage/products');
//
//            for($i = 0; $i < count($tmp_name); $i++) {
//                move_uploaded_file($tmp_name[$i],"$destination/$file_name[$i]");
//            }
//
//            $image = implode(', ', $_FILES['file']['name']);
//        }
//
//        $image_name = isset($image) ? $image : null;
//
//
//        Products::query()
//            ->update([
//                'name' => $name,
//                'description' => $desc,
//                'price' => $price,
//                'image_name' => $image_name ,
//                'updated_at' => Carbon::now()
//            ]);
//
//        redirect('product?product=my');
//    }

    public function delete($id) {
        $product = Products::query()
                ->where('id','=',$id)
                ->get()->first();

        if($product['creator_id'] === userData('id')) {
            Products::query()
                    ->where('id','=',$id)->delete();
        }
    }


}