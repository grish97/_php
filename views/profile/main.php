<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
    <!-- The Grid -->
    <div class="row mb-5">
        <!-- Left Column -->
        <div class="w3-col m3">
            <!-- Profile -->
            <div class="w3-card w3-round w3-white">
                <div class="w3-container">
                    <div class="avatar mx-auto mt-3 mb-4">
                        <img src="/public/storage/avatar/<?=$avatar[0]?>" class="w3-circle avatar" alt="Avatar">
                    </div>
                    <hr>
                    <p><i class="fas fa-user-tie fa-fw w3-margin-right w3-text-theme"></i> <?= userData('name') . ' ' . userData('last_name')?></p>
                    <p><a href="/edit-prof"><i class="fas fa-pen fa-fw w3-margin-right w3-text-theme"></i> Edit Profile</a></p>
                </div>
            </div>
            <br>

            <!-- Accordion -->
            <div class="w3-card w3-round">
                <div class="w3-white">
                    <a href='/friends' class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Friends</a>
                    <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Product</button>
                    <div id="Demo2" class="w3-hide w3-container">
                        <ul class="navbar-nav ml-3">
                            <li class="nav-item">
                                <a href="/product/my" class="nav-link">My Product</a>
                            </li>
                            <li class="nav-item">
                                <a href="/create-product" class="nav-link">Create Product</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-50">
            <!--Middle Column -->
            <div class="ml-5 w3-white w3-round"><br>
                <!--                <img src="/w3images/avatar5.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">-->
                <!--                <span class="w3-right w3-opacity">16 min</span>-->
                <h4>John Doe</h4><br>
                <hr class="w3-clear">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <!-- End Middle Column -->
        </div>
    </div>
</div>