<?php

namespace app\Controller;

use app\Models\Products;
use app\Models\Images;
use Carbon\Carbon;

class ProductController
{

    public $endImage;

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
            json_response(['error' => $data]);
            return false;
        }

        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $price = $_POST['price'];

        if(isset($_FILES['file']['tmp_name'][0])) {
            $file = $_FILES['file'];
            global $file_name = $file['name'];
            $tmp_name = $file['tmp_name'];
            $destination = base_dir('public/storage/products');

            for($i = 0; $i < count($tmp_name); $i++) {
                move_uploaded_file($tmp_name[$i],"$destination/$file_name[$i]");
            }
        }

        $upload_image_name = isset($image) ? $image : '';

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
                    $upload_image_name,
                    $creator_id
                ]);
        }elseif ($role === 'edit') {
            $product = Products::query()->where('id','=',$id)->get()->first();

            if (isset($product) && isset($product['creator_id']) && $product['creator_id'] === userData('id')) {
                $tableImage = str_replace(', ',' ',$product['image_name']);
                $folder = './public/storage/products/';

                if(!empty($_POST['tableImage'])) {
                    $deleted_img = $_POST['tableImage'];
                    foreach($deleted_img as $val) {
                        $tableImage = str_replace($val,'',$tableImage);
                    }

                    foreach($deleted_img as $_image) {
                        unlink($folder.$_image);
                    }
                }

                if(!empty($upload_image_name)) $tableImage .= ' ' . $upload_image_name;


                Products::query()
                    ->where('id','=',$id)
                    ->update([
                        'name' => $name,
                        'description' => $desc,
                        'price' => $price,
                        'image_name' => $tableImage,
                        'updated_at' => Carbon::now()
                    ]);

            }else {
                json_response(['warning' => 'Warning']);
                return false;
            }
        }else {
            json_response(['warning' => 'Warning']);
            return false;
        }
        json_response(['link' => 'product?product=my']);
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