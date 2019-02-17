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
    }

    public function store($params) {
        $parts = explode(':',$params);
        $role = isset($parts[0]) ? $parts[0] : $params;
        $id = isset($parts[1]) ? $parts[1] : '';
        unset($_SESSION['errors']);

        validate($_POST,[
            'name' => 'required|min:3|max:50',
            'desc' => 'required|min:3|max:1000',
            'price' => 'required|number',
        ]);

        if(isset($_SESSION['errors'])) {
            $data = $_SESSION['errors'];
            echo json_encode(['error' => $data]);
            return false;
        }

        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $price = $_POST['price'];

        if(isset($_FILES['file']['tmp_name'][0])) {
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

        if ($role === 'create') {
            $creator_id = $_COOKIE['auth_user_id'];
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
            $product = Products::query()->where('id','=',$id)->get()->first();

            if (isset($product) && isset($product['creator_id']) && $product['creator_id'] === userData('id')) {
                Products::query()
                    ->where('id','=',$id)
                    ->update([
                        'name' => $name,
                        'description' => $desc,
                        'price' => $price,
                        'image_name' => $image_name ,
                        'updated_at' => Carbon::now()
                    ]);
            }else {
                echo json_encode(['warning' => 'Warning']);
                return false;
            }
        }else {
            echo json_encode(['warning' => 'Warning']);
            return false;
        }

        echo json_encode(['message' => 'success']);
    }

    public function edit($id) {
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