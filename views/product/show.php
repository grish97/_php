<div class="container mb-5">
    <div class="card mt-5 bg-white shadow-lg">
            <div class="image_block d-inline-block">
                <?php foreach (image($product['image_name']) as $image) : ?>
                    <img src="<?= str_trim ('/public/storage/products/' . $image)?>" alt="Product Photo" class="show_img">
                <?php endforeach; ?>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $product['name'] ?></h5>
                <p class="card-text"><?= $product['description'] ?></p>
                <p class="small text-muted">Price: <?= $product['price'] . ' $'?></p>
                <p class="small text-muted">Added: <?= $product['created_at']?></p>
            </div>

            <?php if(userdata('id')  === $product['creator_id']) : ?>
                <div class="d-inline-block mb-5 pl-3">
                    <a href="edit?id=<?= $product['id'] ?>" class="mr-4"><i class="far fa-edit"></i></a>
                    <a href="delete?id=<?= $product['id'] ?>" class=""><i class="far fa-trash-alt"></i></a>
                </div>
            <?php endif ?>
    </div>
</div>