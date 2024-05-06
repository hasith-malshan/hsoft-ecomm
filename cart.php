<?php

session_start();
require "connection.php";


if (isset($_SESSION["u"])) {
?>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>eshop | Cart</title>


        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
    </head>

    <body class="background_img1">

        <div class="container-fluid">
            <div class="row">
                <?php
                require "header.php"
                ?>
            </div>
        </div>

        <div class="container-fluid">

            <div class="col-12">
                <nav aria-label="breadcrumb" class="">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Watchlist</li>
                    </ol>
                </nav>
            </div>

            <div class="col-12 my-2 border border-1 border-secondary rounded">
                <div class="row">
                    <div class="col-12">
                        <label class="form-label fs-1 fw-bolder ps-2 text-white"> Cart <i class="bi bi-cart4"></i></label>
                    </div>
                    <div class="col-12 col-lg-6">
                        <hr class="hrbreak1">
                    </div>
              
                    <div class="col-12">
                        <hr class="hrbreak1">
                    </div>








                    <!-- with items View -->
                    <div class="col-12 p-5">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12 col-md-8">

                                <?php

                                $cartS = Database::s("SELECT * FROM `cart` WHERE `user_email` = '" . $_SESSION["u"]["email"] . "';");
                                $cartSNr = $cartS->num_rows;
                                //echo $cartSNr;
                                if ($cartSNr == 0) {
                                ?>
                                    <!-- no items View -->
                                    <div class="col-12 ">
                                        <div class="row">
                                            <div class="col-12 emptyCart">

                                            </div>
                                            <label for="" class="form-label fs-1 mb-3 fw-bolder text-center text-white">You have no items in your cart</label>
                                        </div>
                                        <div class="row justify-content-center mb-5">
                                            <div class="col-12 col-lg-4 d-grid">
                                                <button class="btn btn-lg btn-primary fs-1" onclick="goToHome();">Start Shopping</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- no items View -->

                                    <?php
                                } else {

                                    $sum = 0;
                                    $deliverySum = 0;

                                    for ($i = 0; $i < $cartSNr; $i++) {
                                        $catrProducts = $cartS->fetch_assoc();
                                        $productS = Database::s("SELECT * FROM `product` WHERE `id`='" . $catrProducts["product_id"] . "' ;");
                                        $productSNr = $productS->num_rows;
                                        //echo $productSNr;

                                        if ($productSNr == 1) {
                                            $productSD = $productS->fetch_assoc();

                                            $conName = Database::s("SELECT * FROM `condition` WHERE `id`='" . $productSD["condition_id"] . "' ");
                                            $conNameData = $conName->fetch_assoc();

                                            $clrName = Database::s("SELECT * FROM `color` WHERE `id`='" . $productSD["color_id"] . "' ");
                                            $clrNameData = $clrName->fetch_assoc();



                                            $addressrs = Database::s("SELECT * FROM `user_has_address` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
                                            $ar = $addressrs->fetch_assoc();
                                            $cityid = $ar["city_id"];

                                            $districtrs = Database::s("SELECT * FROM `city` WHERE `id`='" . $cityid . "'");
                                            $xr = $districtrs->fetch_assoc();
                                            $districtid = $xr["district_id"];

                                            $imgS =  Database::s("SELECT * FROM `image` WHERE `product_id`='" . $productSD["id"] . "' ;");
                                            $imgSNr = $imgS->num_rows;



                                            if ($imgSNr == 1) {
                                                $imgSD = $imgS->fetch_assoc();
                                            }

                                    ?>
                                            <div class="card card1 mb-3">
                                                <div class="row g-0">


                                                    <div class="col-md-4 px-5 border-end-2 border" class="cart_image" style="height: 300px;">
                                                        <img src="<?php echo $imgSD["code"] ?>" class="img-fluid rounded-start py-5 cart_image" alt="..." tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" title="<?php echo $productSD["title"]; ?>" data-bs-content="<?php echo $productSD["description"]; ?>">
                                                    </div>

                                                    <!-- <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Disabled popover"> -->

                                                    </span>
                                                    <div class="col-md-5">
                                                        <div class="card-body">
                                                            <h5 class="card-title fs-3"><?php echo $productSD["title"]
                                                                                        ?></h5>
                                                            <span class="fw-bold text-text-black-50" fs-5>Color :<?php echo $clrNameData["name"] ?></span>
                                                            &nbsp; | &nbsp;<span class="fw-bold text-text-black-50 fs-5">Condition : <?php echo $conNameData["name"] ?></span> <br />
                                                            <span class="fw-bold text-text-black-50 fs-5">Price : </span>
                                                            &nbsp; &nbsp;<span class="fw-bold text-text-black-50 fs-5">Rs <?php echo $productSD["price"] ?>.00</span><br>
                                                            <?php
                                                            if ($districtid == 1) {

                                                                $diliveryfee = $productSD["dic"];
                                                            } else {
                                                                $diliveryfee = $productSD["doc"];
                                                            } ?>

                                                            <span class="fw-bold text-text-black-50 fs-5">Dilivery Cost : Rs <?php echo $diliveryfee ?>.00</span><br />

                                                            <div class="row mt-5">
                                                                <!-- <div class="border border-1 border-secondary rounded product-qty py-2 ps-3"> -->

                                                                <div class="col-2"> <span class="fw-bold text-white">QTY : </span></div>
                                                                <div class="col-6"> <input type="number" class="border border-0 fs-6 fw-bold text-start input-number pe-2 form-control" pattern="[0-9]*" value="<?php echo $catrProducts['qty'] ?>" id="qtyInput<?php echo $productSD['id'] ?>" min="1" max="<?php echo $productSD['qty'] ?>" disabled />
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="position-absolute qty-btn">
                                                                        <div class=" qty-inc d-inline">
                                                                            <i class="fa fa-plus btn btn-primary" onclick="qty_inc2(<?php echo $productSD['qty'] ?>,<?php echo $productSD['id'] ?>)"></i>
                                                                        </div>
                                                                        <div class=" qty-dec d-inline">
                                                                            <i class="fa fa-minus btn btn-danger" onclick="qty_dec2(<?php echo $productSD['id'] ?>);"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="card-body d-grid">
                                                            <button href="#" class="btn btn-outline-primary mt-2" value="<?php echo $productSD["id"] ?>" id="btn<?php echo $i ?>">Buy now</button>

                                                            <a href="#" class="btn btn-outline-danger mt-2" onclick="deleteFromCart(<?php echo $catrProducts['id']; ?>)">Remove</a>
                                                        </div>
                                                    </div>

                                                    <hr width="80%" class="text-lg-center">
                                                    <div class="row px-5 mb-2">
                                                        <div class="col-6 col-lg-6">
                                                            <span class="fw-bold">Requested Total &nbsp;</span><i class="bi bi-info-circle"></i>
                                                        </div>
                                                        <?php


                                                        ?>
                                                        <div class="col-6 col-lg-6 text-end">
                                                            <span class="fw-bold ">Rs <?php echo $productSD["price"]*$catrProducts["qty"] + $diliveryfee ?> .00</span>
                                                        </div>
                                                    </div>


                                                </div>
                                                <!--card row inside cardEnd-->
                                            </div>
                                            <!--card End-->



                                        <?php

                                            $sum = $productSD["price"]*$catrProducts["qty"] + $sum;


                                            $deliverySum = $diliveryfee + $deliverySum;
                                        }

                                        ?>






                                    <?php

                                    }




                                    ?>
                            </div>
                            <!--card space col-12 in Row End-->


                            <!-- Modal -->
                            <div class="modal fade" id="alertModal0" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="alertModal0_title">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-danger" id="alertModal0_body">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-12 col-md-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label fs-4 fw-bold text-white">Summary</label>
                                    </div>
                                    <div class="col-12">
                                        <hr />
                                    </div>
                                    <div class="col-6">
                                        <span class="fs-4 fw-bold text-white">Items(<?php echo $cartSNr; ?>)</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="fs-4 fw-bold text-white">Rs. <?php echo $sum; ?> .00</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="fs-4 fw-bold text-white">Shipping</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="fs-4 fw-bold text-white">Rs. <?php echo $deliverySum; ?> .00</span>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <hr class="bg-white" />
                                    </div>
                                    <div class="col-6 mt-1">
                                        <span class="fs-3 fw-bold text-white">Total</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="fs-3 fw-bold text-white">Rs.<?php echo $deliverySum + $sum; ?> .00</span>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <hr class="bg-white" />
                                        <hr class="bg-white" />
                                    </div>
                                 
                                    <div class="col-12 mt-3 mb-3 d-flex justify-content-center">
                                        <button class="btn btn-primary fs-5" onclick="checkOut();" value="<?php echo$i ?>" id="checkBtn">CHECKOUT</button>
                                    </div>
                                </div>
                            </div>
                        <?php
                                }

                        ?>



                        </div>
                        <!--card  Row End-->
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
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="bootstrap"></script>



        <script type="text/javascript">
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>

        <script src="script,.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
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