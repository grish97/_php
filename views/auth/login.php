<div class="col-3 mx-auto jumbotron">
    <h3 class="mt-3 text-center mb-3">Sign In</h3>
    <form method="post" action="sign_in">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control rounded-0" name='email' id="email" placeholder="Email" value="<?= getOldVal("email")?>">
            <span class="text-danger small"><?= email() ?></span>
            <span class="text-danger small"><?= getError('email')?></span>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control rounded-0" name="password" id="password" placeholder="Password">
            <span class="text-danger small"><?= getError('password')?></span>
        </div>

        <button type="submit" class="btn btn-info mt-2">SignIn</button>
    </form>
</div>