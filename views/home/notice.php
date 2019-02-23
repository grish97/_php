<div class="container mt-5">
    <div class="col-6 column">
        <?php foreach ($request as $val) : ?>
            <div class="row mb-5 requestBlock">
                <span class="mr-4"><span class="font-weight-bold"><?= $val['name'] . ' ' . $val['last_name']?></span> wants to be with you.</span>
                <button class="btn btn-success mr-3 request" data-action="requestAnswer/<?= $val['id']?>">Confirm</button>
                <button class="btn btn-danger request" data-action="requestAnswer/cancel:<?= $val['id']?>">Cancel</button>
            </div>
        <?php endforeach ?>
    </div>
</div>