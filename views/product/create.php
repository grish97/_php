<div class="col-6 mx-auto jumbotron">
    <h3 class="mt-3 text-center mb-3">Create Product</h3>
    <form method="post" enctype="multipart/form-data" class="form">
        <div class="mt-3 mb-4 file">
            <input type="file" name="file[]" class="inputFile" id="file" multiple="multiple" accept="image/jpeg">
        </div>
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" name="price" id="price" placeholder="Price">
        </div>
        <div class="form-group">
            <label for="desc">Description</label>
            <textarea class="form-control" name="desc" id="desc" placeholder="Description"></textarea>
        </div>
        <button type="submit" class="btn btn-info mt-2" data-params="/store-product/create">Create</button>
    </form>
</div>
