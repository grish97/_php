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
            $product = Products::query()->where('creator_id', '=',$creator_id)->get()->all();
            $image = Images::query()->where('creator_id','=',$creator_id)->get()->all();
        }elseif ($role === 'all') {
            $product = Products::query()->get()->all();
            $image = Images::query()->get()->all();
        }

        if(empty($product)) {
            echo '<h3>No Products</h3>';
            return false;
        }

        echo view('product.index',"Product",['product' => $product,'image' => $image]);
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
        $fileName = !empty($_FILES['file']) ? $_FILES['file']['name'] : '';

        //UPLOAD DIRECTORY
        if(isset($_FILES['file']['tmp_name'][0])) {
            $file = $_FILES['file'];
            $file_name = $file['name'];
            $tmp_name = $file['tmp_name'];
            $destination = base_dir('public/storage/products');

            for($i = 0; $i < count($tmp_name); $i++) {
                move_uploaded_file($tmp_name[$i],"$destination/$file_name[$i]");
            }
        }

        if ($role === 'create') {
            $creator_id = $_COOKIE['auth_user_id'];
            Products::query()
                ->insert([
                    'name',
                    'description',
                    'price',
                    'creator_id',
                ],[
                    $name,
                    $desc,
                    $price,
                    $creator_id
                ]);

            $newProductId = Products::query()->max('id')->first();

            if(!empty($fileName)) {

                foreach($fileName as $image) {
                    Images::query()
                        ->insert([
                            'name',
                            'product_id',
                            'creator_id'
                        ],[
                            $image,
                            $newProductId['last_id'],
                            $creator_id
                        ]);
                }
            }

        }elseif ($role === 'edit') {
            $product = Products::query()->where('id','=',$id)->get()->first();

            if (isset($product) && isset($product['creator_id']) && $product['creator_id'] === userData('id')) {
                $deleted_img = isset($_POST['base_img']) ? $_POST['base_img'] : '';

                if(!empty($deleted_img)) {
                    $fileDirectory = './public/storage/products/';
                    foreach($deleted_img as $val) {
                        Images::query()->where('name','=',$val)->delete();

                        unlink($fileDirectory . $val);
                    }
                }

                Products::query()
                    ->where('id','=',$id)
                    ->update([
                        'name' => $name,
                        'description' => $desc,
                        'price' => $price,
                        'updated_at' => Carbon::now()
                    ]);

                if(!empty($fileName)) {
                    foreach($fileName as $val) {
                        Images::query()
                            ->insert([
                                'name',
                                'product_id',
                                'creator_id'
                            ],[
                                $val,
                                $id,
                                userData('id')
                            ]);
                    }
                }

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
        $image = Images::query()->where('product_id','=',$id)->get()->all();
        if ($product['creator_id'] !== userData('id')) {
            redirect('profile');
            return false;
        }
        echo view('product.edit',"Edit Product",['product' => $product,'image' => $image]);
    }

    public function show($id) {
        $product = Products::query()
                    ->where('id','=',$id)
                    ->get()->first();
        $image = Images::query()->where('product_id','=',$id)->get()->all();

        echo view('product.show','Product', ['product' => $product,'image' => $image]);
    }

    public function delete($id) {
        $product = Products::query()
                ->where('id','=',$id)
                ->get()->first();

        if($product['creator_id'] === userData('id')) {
            Products::query()
                    ->where('id','=',$id)->delete();
        }
        json_response(['link' => 'profile']);
    }


}