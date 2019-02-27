<div class="col-6 mx-auto jumbotron">
    <h3 class="mt-3 text-center mb-3">Edit Profile</h3>
    <form enctype="multipart/form-data" method="post" class="form">
        <div class="mt-3 mb-4 file">
            <label for="file" class="label">Choose File</label>
            <input type="file" name="file[]" class="inputFile" multiple="multiple" id="file" accept="image/*">
        </div>
        <?php if (!empty($avatar)) : foreach($avatar as $val) : ?>
                <div class="store_img d-inline-block mb-5" data-name="<?=$val?>">
                    <a role="button" class="deleteImage"><i class="fas fa-times"></i></a>
                    <img src="/public/storage/avatar/<?=$val?>" alt="Avatar">
                </div>
        <?php endforeach; endif; ?>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name"  value="<?=$user['name']?>">
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" name="last_name" id="last_name" value="<?= $user['last_name'] ?>">
        </div>
        <button type="submit" class="btn btn-info mt-2" data-params="/update-prof">Update</button>
    </form>
</div>
