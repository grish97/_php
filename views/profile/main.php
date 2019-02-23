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
                    <p><a href="edit-prof"><i class="fas fa-pen fa-fw w3-margin-right w3-text-theme"></i> Edit Profile</a></p>
                </div>
            </div>
            <br>

            <!-- Accordion -->
            <div class="w3-card w3-round">
                <div class="w3-white">
                    <a href='friends' class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Friends</a>
                    <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Post</button>
                    <div id="Demo2" class="w3-hide w3-container">
                        <ul class="navbar-nav ml-3">
                            <li class="nav-item">
                                <a href="product/my" class="nav-link">My Product</a>
                            </li>
                            <li class="nav-item">
                                <a href="create-product" class="nav-link">Create Product</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>