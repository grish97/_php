<div class="col-6 mx-auto jumbotron">
    <h3 class="mt-3 text-center mb-3">Edit Product</h3>
    <form enctype="multipart/form-data" method="post" class="form">
        <div class="mt-3 mb-4 file">
            <input type="file" name="file[]" class="inputFile" multiple="multiple" id="file">
        </div>
        <div class="image">
        <?php foreach(image($product['image_name']) as $key => $value) : ?>
            <div class="store_img d-inline-block shadow mb-5 mr-3">
                <img src="<?= str_trim ('/public/storage/products/' . $value)?>" alt="Product Photo">
            </div>
        <?php endforeach; ?>
        </div>
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?= $product['name']?>">
            <span class="text-danger small"><?= getError('name') ?></span>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" name="price" id="price" placeholder="Price" value="<?= $product['price'] ?>">
            <span class="text-danger small"><?= getError('price') ?></span>
        </div>
        <div class="form-group">
            <label for="desc">Description</label>
            <textarea class="form-control" name="desc" id="desc" placeholder="Description"><?= $product['description'] ?></textarea>
            <span class="text-danger small"><?= getError('desc') ?></span>
        </div>
        <button type="submit" class="btn btn-info mt-2">Update</button>
    </form>
</div>
