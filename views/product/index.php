<div class="container mt-5">
    <div class="card-columns">
        <?php foreach($products as $key => $value) : ?>
            <div class="card product shadow">
                <a href="show?id=<?= $value['id']?>" class="show_prod"><i class="far fa-eye"></i></a>
                <img src="/public/storage/products/<?= product_img($value['image_name']) ?>" alt="Product Photo">
                <div class="card-body">
                    <h5 class="card-title"><?= $value['name'] ?></h5>
                    <p class="card-text"><?= $value['description'] ?></p>
                    <p class="small text-muted"><?= $value['price'] . ' $'?></p>
                    <p class="small text-muted">Added: <?= $value['created_at']?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>