<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
    <!-- The Grid -->
    <div class="row mb-5">
        <!-- Left Column -->
        <div class="w3-col m3">
            <!-- Profile -->
            <div class="w3-card w3-round w3-white">
                <div class="w3-container">
                    <h4 class="w3-center">My Profile</h4>
                    <p class="w3-center"><img src="/w3images/avatar3.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
                    <hr>
                    <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> Designer, UI</p>
                    <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> London, UK</p>
                    <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> April 1, 1988</p>
                </div>
            </div>
            <br>

            <!-- Accordion -->
            <div class="w3-card w3-round">
                <div class="w3-white">
                    <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Friends</button>
                    <div id="Demo1" class="w3-hide w3-container">
                        <p>Some text..</p>
                    </div>
                    <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Post</button>
                    <div id="Demo2" class="w3-hide w3-container">
                        <ul class="navbar-nav ml-3">
                            <li class="nav-item">
                                <a href="product?product=my" class="nav-link">My Post</a>
                            </li>
                            <li class="nav-item">
                                <a href="product?product=all" class="nav-link">All Post</a>
                            </li>
                            <li class="nav-item">
                                <a href="create-product" class="nav-link">Create Post</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-50 ml-5">
            <!--Middle Column -->
            <div class="w3-white w3-round"><br>
<!--                <img src="/w3images/avatar5.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">-->
<!--                <span class="w3-right w3-opacity">16 min</span>-->
                <h4>Jane Doe</h4><br>
                <hr class="w3-clear">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <!-- End Middle Column -->
        </div>
    </div>
</div>