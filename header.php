<!-- header -->

<div class="col-12">
    <div class="row" style="background-color: black;">
        <div class="offset-lg-1 col-12 col-lg-4 col-xl-5 col-xxl-4 align-self-start  pt-3 ">
            <span class="text-start fw-bold lable1 text-white">Welcome &nbsp;

                <?php
                if (isset($_SESSION["u"])) {
                    $user = $_SESSION["u"]["fname"];
                ?><span class="text-primary text-capitalize"><?php echo $user; ?></span> <?php

                                                                                        } else {

                                                                                            ?>
                    <a href="index.php" class="align-top"> Sign in or Regester </a>
                <?php


                                                                                        }
                ?>

            </span>
            <span class="text-start lable2 text-white align-top">&nbsp; <a href="messages.php?e=hasher22542@gmail.com" class="text-decoration-none text-success">| Help and contact |</a> </span>
            <span class="text-start lable2 text-danger" style="cursor: pointer;" onclick="signOut();">Sign out</span>
        </div>

        <div class="offset-lg-3 offset-xl-3 offset-xxl-5 col-12 col-lg-4 col-xl-3 col-xxl-2 ">

            <div class="row justify-content-center ">

                <div class="col-3 col-sm-3 col-lg-6 dropdown text-center d-none">
                    <button class="btn  dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        My Account
                    </button>
                    <ul class="dropdown-menu d-none" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="watchlist.php">Watchlist</a></li>
                        <li><a class="dropdown-item" href="purchaseHistory.php"> Purchase History</a></li>
                        <li><a class="dropdown-item" href="#">Messeges</a></li>
                        <li><a class="dropdown-item" href="#">Saved</a></li>
                        <li><a class="dropdown-item" href="sellerProductView.php">My Products </a></li>
                        <li><a class="dropdown-item" href="userProfile.php">My profile </a></li>
                        <li><a class="dropdown-item" href="#">My settings</a></li>
                    </ul>
                </div>
                <div class="col-1 col-lg-3 mt-2  ms-md-0  ms-lg-0  text-center" style="cursor: pointer;" onclick="goToProfile();"><i class="bi bi-person-circle fs-2 icon1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="User Profile"></i></div>
                <div class="col-1 col-lg-3 mt-2  ms-md-0  ms-lg-0  text-center" style="cursor: pointer;" onclick="goToWatchlist();"><i class="bi bi-heart  fs-2 icon1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Watch list"></i></div>
                <div class="col-1 col-lg-3 mt-2  ms-md-0  ms-lg-0  text-center" style="cursor: pointer;" onclick="goToCart();"><i class="bi bi-cart-fill  fs-2 icon1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cart"></i></div>

            </div>
        </div>

        <!-- header -->

    </div>
</div>

<script src="bootstrap.bundle.js"></script>

<script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
</script>