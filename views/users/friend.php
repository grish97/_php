<!-- Page Container -->
<div class="container mt-5">
    <!-- The Grid -->
    <div class="row mb-5">
        <!-- Left Column -->
        <div class="w3-col m3 mr-5">
            <!-- Profile -->
            <div class=" w3-round w3-white">
                <div class="w3-container">
                    <div class="avatar mx-auto mt-3 mb-4">
                        <img src="/public/storage/avatar/<?=$avatar?>" class="w3-circle avatar" alt="Avatar">
                    </div>
                    <span class="text-center"><?= $friend['name'] . ' ' . $friend['last_name']?></span>
                    <hr>
                    <p><i class="fas fa-pen fa-fw w3-margin-right w3-text-theme"></i> Designer, UI</p>
                    <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> London, UK</p>
                    <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> April 1, 1988</p>
                </div>
            </div>
            <br>
        </div>

        <div class="col-8">
            <!--Middle Column -->
            <div class="bg-white post">
                <img src="/public/images/2.jpg" alt="Friend post image">
                <hr class="w3-clear">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <!-- End Middle Column -->
        </div>
    </div>
</div>
