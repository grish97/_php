<div class="col-6 mx-auto jumbotron">
    <h3 class="mt-3 text-center mb-3">Create Product</h3>
    <form enctype="multipart/form-data" method="post" action="store-product?store=create">
        <div class="mt-3 mb-4">
            <input type="file" name="file" class="inputFile" id="file" multiple="multiple">
        </div>
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?= getOldVal('name')?>">
            <span class="text-danger small"><?= getError('name') ?></span>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" name="price" id="price" placeholder="Price" value="<?= getOldVal('price')?>">
            <span class="text-danger small"><?= getError('price') ?></span>
        </div>
        <div class="form-group">
            <label for="desc">Description</label>
            <textarea class="form-control" name="desc" id="desc" placeholder="Description"><?= getOldVal('desc')?></textarea>
            <span class="text-danger small"><?= getError('desc') ?></span>
        </div>
        <button type="submit" class="btn btn-info mt-2">Create</button>
    </form>
</div>
