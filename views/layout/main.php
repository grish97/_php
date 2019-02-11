<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/main.css">
    <title>@title</title>
</head>
    <body>
        <!--HEADER-->
        <section id="header">
            <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
                <a href="/" class="navbar-brand">MVC <small class="font-weight-light text-muted">Project</small></a>

                <ul class="navbar-nav">
                    <li class="nav-link">
                        <a href="/" class="nav-link">Home</a>
                    </li>
                    <li class="nav-link">
                        <a href="/" class="nav-link">About</a>
                    </li>
                </ul>

                <?php if(auth()) : ?>
                <ul class='navbar-nav ml-auto'>
                    <li class='nav-link'>
                        <a href='#' class='nav-link'><?= userData('email')?></a>
                    </li>
                    <li class='nav-link'>
                        <a href='logout' class='nav-link'>Logout</a>
                    </li>
               </ul>
                <?php else : ?>
                <ul class='navbar-nav ml-auto '>
                    <li class='nav-link'>
                        <a href='login' class='nav-link'>Login</a>
                    </li>
                    <li class='nav-link'>
                        <a href='register' class='nav-link'>Register</a>
                    </li>
                 </ul>
                <?php endif; ?>

            </nav>
        </section>

        <!--CONTENT-->
        <section id="content">
            <div class="container">
                @content
            </div>
        </section>

        <!--FOOTER-->
<!--        <footer id="footer" class="">-->
<!--            <p class="text-center text-muted">All right reserved</p>-->
<!--        </footer>-->
        <!--SCRIPTS-->
        <script src="/public/js/access/jquery.min.js"></script>
        <script src="/public/js/access/bootstrap.min.js"></script>
        <script src="/public/js/main.js"></script>
    </body>
</html>