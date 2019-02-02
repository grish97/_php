<?php require_once 'header.php';?>
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

                <ul class="navbar-nav ml-auto">
                    <li class="nav-link">
                        <a href="/views/auth/login.php" class="nav-link">Login</a>
                    </li>
                    <li class="nav-link">
                        <a href="/views/auth/register.php" class="nav-link">Register</a>
                    </li>
                </ul>
            </nav>
        </section>

        <!--CONTENT-->
        <section id="content">
            <div class="container">
                @content
            </div>
        </section>

        <!--FOOTER-->
<?php require_once 'footer.php';?>