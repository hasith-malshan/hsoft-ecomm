<?php

session_start();

if (isset($_SESSION["u"])) {

    $uemail =  $_SESSION["u"]["email"];


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>esho | watchlist</title>

        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

        <link rel="stylesheet" href="style.css" />
    </head>

    <body class="background_img1">



        <div class="container-fluid">


            <div class="col-12 my-2 border border-1 border-secondary rounded">
                <div class="row">
                    <div class="col-12">
                        <label class="form-label fs-1 fw-bolder text-white ms-2">Watchlist &hearts;</label>
                    </div>
                    <div class="col-12 col-lg-6">
                        <hr class="hrbreak1">
                    </div>
                    <div class="col-12 d-none">
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-0 offset-lg-2 mb-1 mb-lg-2">
                                <input type="text" class="form-control" placeholder="Search in watchlist..." />
                            </div>
                            <div class="offset-3 offset-lg-0 col-6 col-lg-2 d-grid mb-2">
                                <button class="btn btn-outline-primary">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="hrbreak1">
                    </div>


                    <div class="col-12 col-lg-2 border border-start-0 border-top-0 border-bottom-0 border-end border-2 border-primary mb-3">
                        <nav aria-label="breadcrumb" class="">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item active text-white" aria-current="page">Watchlist</li>
                            </ol>
                        </nav>
                        <nav class="nav flex-column nav-pills">
                            <a class="nav-link active" aria-current="page" href="#">My watchlist</a>
                            <a class="nav-link" href="cart.php">My Cart</a>


                        </nav>
                    </div>







                    <!-- with items View -->
                    <div class="col-12 col-lg-9">
                        <div class="row d-flex justify-content-center">

                            <?php
                            require "connection.php";

                            $alreadyAddedCheck = Database::s("SELECT * FROM `watchlist` WHERE `user_email` = '" . $uemail . "';");
                            $alreadyAddedChechkNr = $alreadyAddedCheck->num_rows;
                            //$alreadyAddedChechD = $alreadyAddedCheck->fetch_assoc();

                            if ($alreadyAddedChechkNr > 0) {
                            ?>
                                <div class="col-12 mb-5 text-center">
                                    <label for="" class="fs-1 text-white">You have <?php echo $alreadyAddedChechkNr; ?> products in your watchlist</label>
                                </div>
                                <?php

                                for ($i = 0; $i < $alreadyAddedChechkNr; $i++) {

                                    $alreadyAddedChechD = $alreadyAddedCheck->fetch_assoc();
                                    //$watchListProducts["id"];
                                    $productS = Database::s("SELECT * FROM `product` WHERE `id`='" . $alreadyAddedChechD["product_id"] . "';");
                                    $productSNr = $productS->num_rows;
                                    // echo $productSNr;

                                    if ($productSNr > 0) {


                                        $productSD = $productS->fetch_assoc();



                                        $imgS =  Database::s("SELECT * FROM `image` WHERE `product_id`='" . $productSD["id"] . "' ;");
                                        $imgSNr = $imgS->num_rows;

                                        if ($imgSNr == 1) {
                                            $imgSD = $imgS->fetch_assoc();
                                        }



                                ?>

                                        <div class="col-4">
                                            <div class="card card1 mb-3">
                                                <div class="row g-0">
                                                    <div class="col-md-12 text-center p-2">
                                                        <img src="<?php echo $imgSD["code"] ?>" class="img-fluid rounded-start cart_image" alt="...">
                                                    </div>


                                                    <?php


                                                    $conName = Database::s("SELECT * FROM `condition` WHERE `id`='" . $productSD["condition_id"] . "' ");
                                                    $conNameData = $conName->fetch_assoc();

                                                    $clrName = Database::s("SELECT * FROM `color` WHERE `id`='" . $productSD["color_id"] . "' ");
                                                    $clrNameData = $clrName->fetch_assoc();

                                                    $userDateil_S = Database::s("SELECT * FROM `admin` WHERE `email`='" . $productSD["user_email"] . "';");
                                                    $userDateil_SData = $userDateil_S->fetch_assoc();



                                                    ?>
                                                    <div class="col-md-12">
                                                        <div class="card-body">
                                                            <h5 class="card-title fs-3"><?php echo $productSD["title"] ?> </h5>
                                                            <span class="fw-bold text-text-black-50" fs-5>Color : <?php echo $clrNameData["name"] ?></span>
                                                            &nbsp; | &nbsp;<span class="fw-bold text-text-black-50 fs-5">Condition : <?php echo $conNameData["name"] ?></span> <br />
                                                            <span class="fw-bold text-text-black-50 fs-5">Price : Rs</span>
                                                            &nbsp;<span class="fw-bold text-text-black-50 fs-5"><?php echo $productSD["price"] ?> .00</span><br>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="card-body d-grid">
                                                            <?php
                                                            if ($productSD["qty"] == 0) {
                                                            ?>
                                                                <button class="btn btn-warning" onclick="req(<?php echo $productSD['id'] ?>);">Request more Products</button>

                                                            <?php
                                                            } else {
                                                            ?>
                                                                <a href="singleProductView.php?id=<?php echo $productSD['id'] ?>" class="btn btn-outline-primary mt-2">Buy now</a>
                                                                <button class="btn btn-outline-info mt-2" onclick="addToCart(<?php echo $productSD['id']?>)">Add Cart</button>

                                                            <?php
                                                            }

                                                            ?>


                                                            <a href="#" class="btn btn-outline-danger mt-2" onclick="deleteFromWatchlist(<?php echo $productSD['id'] ?>);">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php

                                    }



                                    ?>


                                <?php
                                }

                                ?>




                            <?php
                            } else {
                            ?>
                                <!-- no items View -->
                                <div class="col-12 col-lg-9">
                                    <div class="row">
                                        <div class="col-12 emptyView">

                                        </div>
                                        <label for="" class="form-label fs-1 mb-3 fw-bolder text-center text-white">You have no items n your watchlist</label>
                                    </div>
                                </div>
                                <!-- no items View -->
                            <?php
                            }


                            ?>



                        </div>
                    </div>
                    <!-- with items View -->




                </div>
            </div>

        </div>
        <div class="container-fluid">
            <div class="row">
                <?php
                require "footer.php"
                ?>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="alertModal0" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="alertModal0_title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center text-success" id="alertModal0_body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="script,.js"></script>

    </body>

    </html>

<?php
} else {

?>

    <script src="script,.js"></script>
    <script>
        goToIndex();
    </script>

<?php

}


?>