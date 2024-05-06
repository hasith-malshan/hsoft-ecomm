<?php
session_start();
require "connection.php";
?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HSOFT |Single Product View</title>


    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body onload="payNow(<?php echo $productSD['id'] ?>);" class="background_img1">


    <style>
        label,
        span {
            color: white;
        }
    </style>
    <div class="container-fluid">

        <div class="row mb-3" style="background-color: black;">
            <?php
            require "header.php"
            ?>
            <hr class="bg-secondary border border-2 mt-3" />
        </div>



    </div>



    <?php

    if (isset($_GET["id"])) {

        //echo $_GET["id"];

        $pid = $_GET["id"];

        $productS =  Database::s("SELECT * FROM `product` WHERE `id`='" . $pid . "' ; ");
        $productSNr = $productS->num_rows;

        if ($productSNr == 1) {
            $productSD = $productS->fetch_assoc();



            $imgS = Database::s("SELECT * FROM `image` WHERE `product_id` = '" . $productSD["id"] . "' ;");
            $imgSNr = $imgS->num_rows;
            if ($imgSNr == 1) {
                $imgSD = $imgS->fetch_assoc();
            }
        }

    ?>


        <?php
        if (isset($imgSD["code"])) {
            $img1 =  $imgSD["code"];
        } else {
            $img1 = "resources/211634_camera_icon (2).png";
        }

        if (isset($imgSD["code1"]) and $imgSD["code1"] != "") {
            $img2 =  $imgSD["code1"];
        } else {
            $img2 = "resources/211634_camera_icon (2).png";
        }

        if (isset($imgSD["code2"]) and $imgSD["code2"] != "") {
            $img3 =  $imgSD["code2"];
        } else {
            $img3 = "resources/211634_camera_icon (2).png";
        }




        ?>


        <div class="container-fluid">
            <div class="row">
                <!-- Product Details -->
                <div class="col-12 mt-0 singleproduct">
                    <div class="row">
                        <div class=" col-12">
                            <div class="row">
                                <div class="col-12 offset-0 col-md-3 col-lg-2 order-lg-1 order-2">
                                    <ul>
                                        <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1 p-2" onclick="loadMainImg('img1');">
                                            <img src="<?php echo $img1; ?>" height="130px" id="img1" class="col-12" />
                                        </li>
                                        <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1 p-2" onclick="loadMainImg('img2');">
                                            <img src="<?php echo $img2; ?>" height="130px" id="img2" class="col-12" />
                                        </li>
                                        <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1 p-2" onclick="loadMainImg('img3');">
                                            <img src="<?php echo $img3 ?>" height="130px" id="img3" class="col-12" />
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                    <div class="d-flex flex-column justify-content-center align-items-center border border-5 border-secondary px-1 py-5">
                                        <img src="<?php echo $imgSD["code"] ?>" class="col-12" id="maining" height="600px" />
                                    </div>
                                </div>
                                <div class="col-lg-6 order-3">
                                    <div class="row">
                                        <div class="col-12 pe-0">
                                            <nav>
                                                <ol class="d-flex flex-wrap mb-0 list-unstyled rounded">
                                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                                                    <li class="breadcrumb-item text-white"><a style="cursor: pointer;"><?php echo $productSD["title"]  ?></a></li>
                                                </ol>
                                            </nav>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fs-4 fw-bold mt-0"><?php echo $productSD["title"]  ?></label>
                                        </div>
                                        <?php

                                        $rate = Database::s("SELECT * FROM `rate` WHERE `pid`='" . $pid . "';");
                                        $rateNr = $rate->num_rows;
                                        if ($rateNr > 0) {
                                            $rateVal = 0;
                                            for ($i = 0; $i < $rateNr; $i++) {
                                                $rateD = $rate->fetch_assoc();
                                                $rateVal = $rateVal + $rateD["rate"];
                                            }
                                            $finRate = 0;
                                            $finRate = $rateVal/$rateNr;
                                        }else{
                                            $rateNr = 0;
                                            $finRate = 0;
                                        }
                                       

                                        ?>
                                        <div class="col-8">
                                            <span>
                                                <i class="fa fa-star fs-6 text-warning"></i>
                                                <label class=" fs-6 text-white"><?php echo $finRate ?></label>
                                                <label class=" fs-6">| <?php echo $rateNr?> Reviews</label>
                                            </span>
                                        </div>
                                        <div class="col-12">
                                            <label class="d-inline-block fw-bold fs-3">Rs. <?php echo $productSD["price"]  ?></label>
                                            <label class="d-inline-block fw-bold fs-6"></label> &nbsp;
                                            <label class="d-inline-block fw-bold fs-5 text-danger" style="text-decoration: line-through">Rs. <?php echo (float)$productSD["price"] * 1.05  ?></label>
                                        </div>
                                        <div class="col-12">
                                            <hr class="hrbreak1" />
                                        </div>


                                        <div class="col-12 col-md-6 d-grid">
                                            <label class="text-primary" style="font-size: 13px;"><b>Warrenty:</b> 6 months warrenty</label>
                                            <label class="text-primary" style="font-size: 13px;"><b>Return Policy:</b> 7 days easy return policy</label>
                                            <?php
                                            if ($productSD["qty"] > 0) {
                                                $codeQ = "";


                                            ?>
                                                <label class="text-success fs-4" style="font-size: 13px;"><b>In Stock</b></label>
                                            <?php
                                            } else {
                                                $codeQ = "disabled";
                                            ?>
                                                <label class="text-danger fs-4" style="font-size: 13px;"><b>Out of Stock</b></label>
                                            <?php
                                            }

                                            ?>
                                            <span class="text-primary"><?php echo $productSD["qty"]  ?> item availables</span>
                                        </div>

                                        <?php

                                        ?>


                                        <div class="col-12">
                                            <div class="row px-2">
                                                <div class="col-12 col-md-6 border border-2 border-success rounded mt-3 mb-3">
                                                    <div class="row p-3">
                                                        <div class="col-2 col-sm-2">
                                                            <img src="resources/pricetag.jpg" />
                                                        </div>
                                                        <div class="col-10 col-sm-10">
                                                            <label class="text-white-50">Stand a chance to get instant 5% discount by using VISA</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 px-4">
                                            <div class="row">
                                                <label class="fw-bold">Colour Options</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 px-3">
                                                    <?php

                                                    $clrId = Database::s("SELECT * FROM `product` WHERE `id`='" . $pid . "' ");
                                                    $clrIdData = $clrId->fetch_assoc();

                                                    $clrName = Database::s("SELECT * FROM `color` WHERE `id`='" . $clrIdData["color_id"] . "' ");
                                                    $clrNameData = $clrName->fetch_assoc();



                                                    ?>
                                                    <label class="h3"><?php echo $clrNameData["name"] ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr class="hrbreak1" />
                                        </div>
                                        <div class="col-12">
                                            <div class="row px-3">
                                                <div class="col-8 col-md-6" style="margin-top: 15px;">
                                                    <div class="row">
                                                        <!-- <div class="border border-1 border-secondary rounded product-qty py-2 ps-3"> -->

                                                        <div class="col-2"> <span class="fw-bold h5">QTY : </span></div>
                                                        <div class="col-6"> <input type="number" class="border border-0 fs-6 fw-bold text-start input-number pe-2 form-control" pattern="[0-9]*" value="1" id="qtyInput" min="1" max="<?php echo $productSD['qty'] ?>" disabled />
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="position-absolute qty-btn">
                                                                <div class=" qty-inc d-inline">
                                                                    <i class="fa fa-plus btn btn-primary" onclick="qty_inc(<?php echo $productSD['qty'] ?>)"></i>
                                                                </div>
                                                                <div class=" qty-dec d-inline">
                                                                    <i class="fa fa-minus btn btn-danger" onclick="qty_dec();"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- </div> -->
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 d-flex flex-column align-items-center justify-content-center" style="margin-top: 15px;">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <button class="btn btn-primary" onclick="addToCart2(<?php echo $productSD['id'] ?>);" <?php echo $codeQ ?>>Add to Cart</button>
                                                            <?php
                                                            if ($productSD["qty"] > 0) {
                                                            ?>
                                                                <button class="btn btn-success" id="payhere-payment" type="submit" onclick="payNow(<?php echo $productSD['id'] ?>);" <?php echo $codeQ ?>>Buy Now</button>

                                                            <?php
                                                            } else {
                                                            ?>

                                                                <button class="btn btn-success" id="payhere-payment" type="submit" onclick="payNow(<?php echo $productSD['id'] ?>);" <?php echo $codeQ ?>>Buy Now</button>

                                                            <?php
                                                            }
                                                            ?>


                                                            <button class="btn btn-my">
                                                                <i class="fas fa-heart mt-1 fs-5 text-black-50"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Other Products -->
                        <div class="col-12 ">
                            <div class="row d-block mx-0 mt-4 mb-3 border border-2 border-start-0 border-end-0 border-top-0 border-white">
                                <div class="col-md-6">
                                    <div class="row">
                                        <span class="h1 fw-bold">Related Items</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 my-5">
                            <div class="row">
                                <div class="col-md-12 p-2">
                                    <div class="row px-5 g-3">
                                        <?php
                                        $number = 4;

                                        $brandrs = Database::s("SELECT * FROM `product` WHERE `catagory_id`='" . $productSD["catagory_id"] . "' AND `id`!= '" . $productSD["id"] . "';");
                                        $bdn = $brandrs->num_rows;

                                        for ($x = 0; $x < $bdn; $x++) {
                                            $prod = $brandrs->fetch_assoc();
                                            // echo $bd["id"];
                                            $imageOfProduct = Database::s("SELECT * FROM `image` WHERE `product_id`='" . $prod["id"] . "' ;");
                                            $imgRow = $imageOfProduct->fetch_assoc();
                                            //echo $imagerow["product_id"];

                                        ?>
                                            <div class="card me-3 d-none" style="width: 18rem;">
                                                <img src="<?php echo $imagerow["code"] ?>" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $bd["title"] ?></h5>
                                                    <p class="card-text">Rs.<?php echo $bd["price"] ?>.00</p>
                                                    <a href="#" class="btn btn-primary fsm2">Add cart</a>
                                                    <a href="#" class="btn btn-primary fsm2">Buy Now</a>
                                                    <a href="#" class="mt-2 fs-6"><i class="fas fa-heart mt-1 fs-4 text-black-50"></i></a>
                                                </div>
                                            </div>

                                            <div class="card card1 col-6 col-lg-2 mt-1 mb-1 ms-1" style="width: 18rem;">
                                                <img src="<?php echo $imgRow["code"] ?>" class="card-img-top mt-2">
                                                <div class="card-body">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h5 class="card-title text-center mb-1"><?php echo $prod["title"] ?> <br />
                                                                    <div class="row justify-content-center mt-2">
                                                                        <span class="badge bg-info text-dark text-center col-6">New</span>
                                                                    </div>

                                                                </h5>




                                                                <div class="row text-center">
                                                                    <div class="col-12 d-inline"> <span class="text-primary fs-5">Rs <?php echo $prod["price"] ?> .00</span><br>
                                                                    </div>

                                                                    <?php

                                                                    if ((int)$prod["qty"] > 0) {

                                                                    ?>
                                                                        <span class="text-warning">In stock</span>
                                                                        <input type="number" class="form-control my-3 d-none" value="1" id="qtyTxt<?php echo $prod['id'] ?>">
                                                                        <div class="col-12 d-grid mt-1"><a href="singleProductView.php?id=<?php echo $prod['id'] ?>" class="btn btn-success">Buy now</a></div>


                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <div class="col-12 mt-1 "><span class="btn " onclick="addToCart(<?php echo $prod['id'] ?>)"><i class="bi bi-cart-fill text-white fs-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to cart"></i></span></div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="col-12 mt-3"> <span class="" onclick="addToWatchlist(<?php echo $prod['id'] ?>);"><i class="bi bi-heart fs-1" id="watch<?php echo $prod['id'] ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to watchlist"></i></span></div>
                                                                            </div>
                                                                        </div>

                                                                    <?php

                                                                    } else { ?>
                                                                        <span class="text-danger">Out of stoke</span>
                                                                        <button class="btn btn-success disabled">Buy now</button>
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <div class="col-12 mt-1 "><span class="btn "><i class="bi bi-cart-fill text-white fs-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="This product is ot of stock you cant add to Cart"></i></span></div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="col-12 mt-3"> <span class="" onclick="addToWatchlist(<?php echo $prod['id'] ?>);"><i class="bi bi-heart fs-1" id="watch<?php echo $prod['id'] ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to watchlist"></i></span></div>
                                                                            </div>
                                                                        </div>



                                                                    <?php

                                                                    }
                                                                    ?>



                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>






                                                </div>
                                            </div>
                                        <?php
                                        }

                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Other Products -->


                        <?php

                        $modalBrandSearch = Database::s("SELECT * FROM `modle_has_brand` WHERE `id`='" . $productSD["modle_has_brand_id"] . "'; ");
                        $modalBrandSearchData = $modalBrandSearch->fetch_assoc();


                        $modalSearch = Database::s("SELECT * FROM `model` WHERE `id`='" . $modalBrandSearchData["model_id"] . "'; ");
                        $modalSearchData = $modalSearch->fetch_assoc();


                        $BrandSearch = Database::s("SELECT * FROM `brand` WHERE `id`='" . $modalBrandSearchData["brand_id"] . "'; ");
                        $BrandSearchData = $BrandSearch->fetch_assoc();





                        ?>

                        <!-- Product Details -->
                        <div class="col-12 ">
                            <div class="row d-block mx-0 mt-4 mb-3 border border-2 border-start-0 border-end-0 border-top-0 border-white">
                                <div class="col-md-6">
                                    <div class="row">
                                        <span class="h1 fw-bold">Product Details</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="form-label">Brand</label>
                                        </div>
                                        <div class="col-9 text-white">
                                            <?php echo $BrandSearchData["name"]; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="form-label">Model</label>
                                        </div>
                                        <div class="col-9 text-white">
                                            <?php echo $modalSearchData["name"]; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="row">
                                        <div class="col-3 text-white">
                                            <label class="form-label">Product name</label>
                                        </div>
                                        <div class="col-9 text-white">
                                            <?php echo $productSD["title"]; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="row">
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Description</label>
                                        </div>
                                        <div class="col-10 offset-1 offset-md-0 col-md-7">
                                            <textarea cols="40" rows="10" class="form-control" style="resize: none;" disabled><?php echo $productSD['description'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product Details -->

                    </div>
                </div>
                <!-- Product Details -->

                <div class="col-12">
                    <div class="row d-block me-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-white">
                        <div class="col-md-6">
                            <span class="h1 fw-bold">Feedbacks</span>
                        </div>
                    </div>
                </div>

                <?php

                $feedbackrs = Database::s("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "'");
                $feed = $feedbackrs->num_rows;

                if ($feed == 0) {
                ?>
                    <label class="form-lable fs-3 text-white text-center mb-4">There are no feedbacks to view.</label>
                <?php
                } else {
                ?>
                    <div class="col-12">
                        <div class="row">

                            <?php
                            for ($a = 0; $a < $feed; $a++) {
                                $feedrow = $feedbackrs->fetch_assoc();
                            ?>

                                <div class="col-12 col-md-4 p-3">
                                    <div class="row">
                                        <div class="col-12  border border-1 border-danger rounded">
                                            <div class="row">

                                                <div class="col-12">
                                                    <span class="fs-5 text-primary fw-bold"><?php echo $feedrow["user_email"]  ?></span>
                                                </div>
                                                <div class="col-12">
                                                    <span class="text-white"><?php echo $feedrow["feed"]  ?></span>
                                                </div>

                                                <div class="col-12 text-end">
                                                    <span class="fs-6 text-white-50"><?php echo $feedrow["date"]  ?></span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php

                            }
                            ?>
                        </div>
                    </div>
                <?php
                }
                ?>






            </div>
        </div>

        <!-- Footer -->
        <div class="container-fluid">
            <div class="row">
                <?php require "footer.php"; ?>
            </div>
        </div>


        <!-- Footer -->

    <?php

    } else { ?>
        <script src="script,.js"></script>
        <script>
            goToHome();
        </script>
    <?php
    }



    ?>



    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="bootstrap.bundle.js"></script>

    <script src="bootstrap.bundle.js"></script>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

    <script src="script,.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

</body>

</html>