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
                    <p></p><?= userData('name') . ' ' . userData('last_name')?></p>
                    <hr>
                    <p><i class="fas fa-pen fa-fw w3-margin-right w3-text-theme"></i> Designer, UI</p>
                    <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> London, UK</p>
                    <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> April 1, 1988</p>
                </div>
            </div>
            <br>

            <!-- Accordion -->
            <div class="w3-card w3-round">
                <div class="w3-white">
                    <a href='friends' onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Friends</a>
                    <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Post</button>
                    <div id="Demo2" class="w3-hide w3-container">
                        <ul class="navbar-nav ml-3">
                            <li class="nav-item">
                                <a href="product?product=my" class="nav-link">My Post</a>
                            </li>
                            <li class="nav-item">
                                <a href="create-product" class="nav-link">Create Post</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

<!--        <section id="news" class="ml-5">-->
<!--            <div class="item">-->
<!--                <img src="/public/images/1.jpg" alt="News Image">-->
<!--                <p class="text">Lorem ipsum dolor sit amet</p>-->
<!--            </div>-->
<!--        </section>-->
    </div>
</div>