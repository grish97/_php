<div class="container mb-5">
    <div class="card mt-5 bg-white shadow-lg">
            <div class="image_block d-inline-block">
                <?php if(!empty($image)) : ?>
                    <?php foreach ($image as $val) : ?>
                        <div class="show_img d-inline-block shadow">
                            <img src="/public/storage/products/<?=$val['name']?>" alt="Product Photo">
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <h5 class="card-title"><span class="font-weight-bold">Name</span> : <?= $product['name'] ?></h5>
                <p class="card-text"><span class="font-weight-bold">Description</span> :<?= $product['description'] ?></p>
                <p class="card-text"><span class="font-weight-bold">Price</span> : <?= $product['price'] . ' $'?></p>
                <p class="card-text"><span class="font-weight-bold">Added</span> : <?= $product['created_at']?></p>
                <?php if(!empty($product['updated_at'])) : ?>
                    <p class="card-text"><span class="font-weight-bold">Updated</span> : <?= $product['updated_at']?></p>
                <?php endif ?>
            </div>

            <?php if(userdata('id')  === $product['creator_id']) : ?>
                <div class="d-inline-block mb-5 pl-4">
                    <a href="edit/<?= $product['id'] ?>" class="btn text-success edit"><i class="far fa-edit"></i></a>
                    <a role="button" data-action="delete/<?= $product['id'] ?>" class="btn text-danger delete"><i class="far fa-trash-alt"></i></a>
                </div>
            <?php endif ?>
    </div>
</div>