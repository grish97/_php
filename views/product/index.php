
<a href="/create-product" class="btn btn-primary float-right mt-3 mr-3"><i class="fas fa-plus-circle"></i> Create</a>
<div class="container mt-5">
    <div class="card-columns">
        <?php foreach($product as $key => $value) : ?>
            <div class="card product shadow mb-5 defaultImg">
                <a href="/show/<?= $value['id']?>" class="show_prod"><i class="far fa-eye"></i></a>
                <?= generateImage($image,$value['id'])?>
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
