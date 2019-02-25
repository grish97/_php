<div class="container">
    <div class="items mt-5">
        <?php if(!empty($users)) : foreach ($users as $user) : if($user['id'] !== userData('id')) :  ?>
            <div class="item w-100 mb-4">
                <div class="smallAvatar d-inline-block mr-3">
                    <img src="/public/storage/avatar/avatar.png" class='smallAvatar' alt="Avatar">
                </div>
                <a href="<?=in_array($user['id'],$friendsId) ? ('/friend/'.$user['id']) : ''?>"><span class=""><?=$user['name'] . ' ' . $user['last_name']?></span></a>
               <?= roleButton($sentRequest,$user['id'],$friendsId)?>
            </div>
        <?php  endif; endforeach; endif ?>
    </div>
</div>

