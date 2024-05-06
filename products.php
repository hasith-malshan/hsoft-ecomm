<?php

session_start();
require "connection.php";

if (isset($_GET["id"])) {
    $cat = $_GET["id"];
}else{
    $cat ="x";
}



if ($cat == "x") {
    $stxt = "";
    $stxt1 = "WHERE `status_id`='1' ";
} else {
    $stxt = " WHERE `id`='" . $cat . "';";
    $stxt1 = " WHERE `catagory_id`='" . $cat . "' AND `status_id`='1'";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>HSOFT | Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="background_img1">



    <div class="container-fluid">


        <?php

        $catS =  Database::s("SELECT * FROM `catagory` " . $stxt . ";");
        $catSD = $catS->fetch_assoc();



        ?>
        <div class="col-12">
            <div class="row  g-3">

                <?php
                require "header.php"
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6"><span class="text-white text-start fs-3"><a href="products.php?id=x" class="text-decoration-none">All Products </a></span></div>
            <div class="col-6 text-end"><span class="text-white  fs-3"><a href="home.php" class="text-decoration-none text-center">Back to home </a></span></div>
        </div>
        <?php

        if ($cat == "x") {
        ?>

            <div class="row">
                <h1 class="text-white text-center">All Products</h1>
            </div>
        <?php

        } else {

        ?>
            <div class="row">
                <h1 class="text-white text-center"><?php echo  $catSD["name"] ?></h1>
            </div>
        <?php
        }


        ?>


        <div class="row">


            <?php
            $selectProducts = Database::s("SELECT * FROM `Product` " . $stxt1 . " ");
            $selectProductsNr = $selectProducts->num_rows;
            if ($selectProductsNr > 0) {

            ?>

                <div class="col-12 mb-5 pb-2">
                    <div class="row">
                        <div class="offset-lg-1 col-12 col-lg-10">
                            <div class="row justify-content-center justify-content-lg-start">

                                <?php
                                $resultSet = Database::s("SELECT * FROM   `product` " . $stxt1 . "  ORDER BY `datetime_added` DESC;");
                                $nr = $resultSet->num_rows;

                                if ($nr == 0) {
                                ?><div class=" text-center">
                                        <h1 class="text-white-50">No Products Yet</h1>
                                    </div>

                                <?php
                                }

                                for ($i = 0; $i < $nr; $i++) {
                                    $prod = $selectProducts->fetch_assoc();


                                ?>
                                    <!-- This is Sigble product section start-->

                                    <?php

                                    $pImage = Database::s("SELECT * from `image` WHERE `product_id`='" . $prod["id"] . "'; ");
                                    $imgRow = $pImage->fetch_assoc();


                                    ?>



                                    <div class="card card1 col-6 col-lg-2 mt-1 mb-1 ms-1" style="width: 18rem;">
                                        <img src="<?php echo $imgRow["code"] ?>" class="card-img-top mt-2 border border-2 border-secondary">
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

                                                            if (isset($_SESSION[""])) {
                                                                $wish = Database::s("SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["u"]["email"] . "' AND `product_id`='" . $prod["id"] . "' ;");
                                                                if ($wish->num_rows == 1) {
                                                                    $codeC = "text-danger";
                                                                } else {
                                                                    $codeC = "text-white";
                                                                }
                                                            }

                                                          

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
                                                                        <div class="col-12 mt-3"> <span class="" onclick="addToWatchlist(<?php echo $prod['id'] ?>);"><i class="bi bi-heart fs-1 <?php echo $codeC?>" id="watch<?php echo $prod['id'] ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to watchlist"></i></span></div>
                                                                    </div>
                                                                </div>

                                                            <?php

                                                            } else { ?>
                                                                <span class="text-danger">Out of stoke</span>
                                                                <button class="btn btn-warning" onclick="req(<?php echo $prod['id'] ?>);">Request more Products</button>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="col-12 mt-1 "><span class="btn "><i class="bi bi-cart-fill text-white fs-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="This product is ot of stock you cant add to Cart"></i></span></div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="col-12 mt-3"> <span class="" onclick="addToWatchlist(<?php echo $prod['id'] ?>);"><i class="bi bi-heart fs-1  <?php echo $codeC?>" id="watch<?php echo $prod['id'] ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to watchlist"></i></span></div>
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
                                    <!-- This is Sigble product section end-->
                                <?php
                                }
                                ?>


                            </div>
                        </div>
                    </div>
                </div>

            <?php



            }


            ?>



        </div>

        <div class="row">
            <?php
            require "footer.php";

            ?>
        </div>


    </div>

<script src="script,.js"></script>

</body>

</html>