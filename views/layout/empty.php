<div class="container mt-5">
    <div class="jumbotron w-100">
        <h1 class="text-muted"><?= $message ?></h1>
        <?php if(isset($url)) : ?>
        <a href="<?= $url ?>" class="btn btn-primary"><?= $name ?></a>
        <?php endif ?>
    </div>
</div>