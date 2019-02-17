<div class="col-6 mx-auto jumbotron">
    <h3 class="mt-3 text-center mb-3">Edit Product</h3>
    <form enctype="multipart/form-data" method="post" class="form">
        <div class="mt-3 mb-4 file">
            <input type="file" name="file[]" class="inputFile" multiple="multiple" id="file" accept="image/*">
        </div>
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?= $product['name']?>">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" name="price" id="price" placeholder="Price" value="<?= $product['price'] ?>">
        </div>
        <div class="form-group">
            <label for="desc">Description</label>
            <textarea class="form-control" name="desc" id="desc" placeholder="Description"><?= $product['description'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-info mt-2" data-param="edit:<?= $product['id'] ?>">Update</button>
    </form>
</div>
