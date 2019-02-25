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

        <div class="w-50">
            <!--Middle Column -->
            <div class="ml-5 w3-white w3-round"><br>
                <!--                <img src="/w3images/avatar5.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">-->
                <!--                <span class="w3-right w3-opacity">16 min</span>-->
                <h4><?= $friend['name'] . ' ' . $friend['last_name']?></h4><br>
                <hr class="w3-clear">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <!-- End Middle Column -->
        </div>
    </div>
</div>
