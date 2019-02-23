<div class="col-5 mx-auto jumbotron">
    <h3 class="mt-3 text-center mb-3">Sign Up</h3>
    <form method="post" class="form">
        <div class="mt-3 mb-4 file">
            <input type="file" name="file[]" class="inputFile" multiple="multiple" id="file" accept="image/*">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control rounded-0" name="name" id="name" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control rounded-0" name="last_name" id="last_name" placeholder="Last Name">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control rounded-0" name="email" id="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control rounded-0" name="password" id="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="password">Confirm Password</label>
            <input type="password" class="form-control rounded-0" name="conf_password" id="conf_password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-success mt-2 register" data-params="store">Register</button>
        </form>
</div>
