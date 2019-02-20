<!DOCTYPE html>
<html>
    <head>
        <title>@title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/public/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" href="/public/css/toastr.css">
        <link rel="stylesheet" href="/public/css/main.css">
        <style>
            html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
        </style>
    </head>
    <body class="w3-theme-l5">
    <!-- Navbar -->
        <div class="w3-t">
            <div class="w3-bar w3-theme-d2 w3-left-align">
                <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
                <a href="<?= auth() ? 'profile' : '/'; ?>" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i><?= auth() ? 'My Profile' : 'Home'; ?></a>
                <?php if(auth()) : ?>
                    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="News"><i class="fa fa-globe"></i></a>
                    <a href="users" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Users"><i class="fa fa-user"></i></a>
                    <a href="product?product=all" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Product"><i class="fas fa-cart-arrow-down"></i></a>
                    <div class="d-flex justify-content-end">
                        <p class="pt-2 mr-1"><?= userData('email')?></p>
                        <a href="logout" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Messages"><i class="fas fa-sign-out-alt"></i>Logout</a>
                    </div>
                <?php else : ?>
                    <div class="d-flex justify-content-end">
                        <a href="login" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Account Settings">Login</a>
                        <a href="register" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Messages">Register</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!--CONTENT -->
        @content
        <!--END CONTENT -->
        <!--FOOTER-->
        <footer class="d-none" id="footer">
            <p class="text-muted small text-center mt-3">All right reserved 2019</p>
        </footer>
        <!--SCRIPT-->
        <script src="/public/js/access/jquery.min.js"></script>
        <script src="/public/js/access/bootstrap.min.js"></script>
        <script src="/node_modules/toastr/toastr.js"></script>
        <script src="/public/js/main.js"></script>
    </body>
</html>