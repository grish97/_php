<div class="container mt-5">
    <div class="card-columns">
        <?php foreach($product as $key => $value) : ?>
            <div class="card product shadow">
                <a href="show?id=<?= $value['id']?>" class="show_prod"><i class="far fa-eye"></i></a>
                    <?php if(!empty($image)) { foreach($image as $img) { ?>
                        <?php if($value['id'] == $img['product_id']) : ?>
                            <img src="<?= '/public/storage/products/' . $img['name']?>" alt="Product Photo">
                        <?php break; endif; ?>
                    <?php } }else { ?>
                        <img src="/public/images/default.png " alt="Product Photo">
                    <?php } ?>
                <div class="card-body">
                    <h5 class="card-title"><?= $value['name'] ?></h5>
                    <p class="card-text"><?= $value['description'] ?></p>
                    <p class="card-text">Price: <?= $value['price'] . ' $'?></p>
                    <p class="small text-muted">Added: <?= $value['created_at']?></p>

                    <?php if(!empty($value['updated_at'])) : ?>
                        <p class="small text-muted">Updated: <?= $value['updated_at']?></p>
                    <?php endif ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>