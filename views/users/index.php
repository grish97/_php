<div class="container">
    <div class="items mt-5">
        <?php if(!empty($users)) : foreach ($users as $user) : if($user['id'] !== userData('id')) :  ?>
            <div class="item w-100 mb-4">
                <div class="smallAvatar d-inline-block mr-3">
                    <img src="/public/images/avatar.jpg" class='smallAvatar' alt="Avatar">
                </div>
                <span class=""><?=$user['name'] . ' ' . $user['last_name']?></span>
                <button class="btn btn-info float-right" data-action="friends?id=<?=$user['id']?>">Friends</button>
            </div>
        <?php  endif; endforeach; endif ?>
    </div>
</div>