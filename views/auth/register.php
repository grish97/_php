<div class="col-3 mx-auto jumbotron">
    <h3 class="mt-3 text-center mb-3">Sign Up</h3>
    <form method="post" action="store">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control rounded-0" name="name" id="name" placeholder="Name" value="<?= getOldVal('name')?>">
            <span class="text-danger small"><?= getError('name') ?></span>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control rounded-0" name="last_name" id="last_name" placeholder="Last Name" value="<?= getOldVal('last_name')?>">
            <span class="text-danger small"><?= getError('last_name') ?></span>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control rounded-0" name="email" id="email" placeholder="Email" value="<?= getOldVal('email')?>">
            <span class="text-danger small"><?= getError('email') ?></span>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control rounded-0" name="password" id="password" placeholder="Password">
            <span class="text-danger small"><?= getError('password') ?></span>
        </div>
        <div class="form-group">
            <label for="password">Confirm Password</label>
            <input type="password" class="form-control rounded-0" name="conf_password" id="conf_password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-success mt-2">Register</button>
        </form>
</div>
