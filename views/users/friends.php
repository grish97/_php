<div class="container mt-5">
    <div class="items">
        <?php foreach($friends as $key =>  $friend) : ?>
            <div class="item mr-5 d-inline-block mb-5">
                <div class="friendInfo d-inline-block">
                    <img src="/public/storage/avatar/<?=!empty($friend['avatar']) ? $friend['avatar'] : 'avatar.jpg' ?>" alt="Avatar" class="avatar">
                    <a href="friend?id=<?=$friend['id']?>" class="ml-4 mt-5"><?= $friend['name'] . ' ' . $friend['last_name']?></a>
                </div>
                <div class="dropdown d-inline-block ml-2">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-check-circle mr-2"></i>Friend
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <button type="submit" class="btn dropdown-item request" data-action="deleteFriend?id=<?= $friend['id']?>">Delete in friends</button>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>