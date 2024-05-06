<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HSOFT Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="background_img1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row  g-3">

                    <?php
                    require "header.php"
                    ?>
                </div>
            </div>


            <hr class="hr_breack1 mt-3">

            <!-- searchbar -->
            <div class="col-12 ">
                <div class="row justify-content-center">
                    <div class="col-10 ">
                        <div class="row justify-content-center">
                            <div class="col-1"><img src="resources/HSOFT-logos_whiteX.png" alt="" height="100px" class="text-center"></div>

                            <div class="col-12 col-lg-6 mt-3 ">


                                <div class="row g-0">
                                    <div class="col-12 col-md-8"> <input type="text" class="form-control basicS" aria-label="Text input with dropdown button" id="basic_search_txt"></div>
                                    <div class="col-12 col-md-4">
                                        <select name="" id="cat_s" class=" form-select">
                                            <option value="0">Select Category</option>

                                            <?php
                                            require "connection.php";
                                            $rs = Database::s("SELECT * FROM `catagory` ;");
                                            $n = $rs->num_rows;

                                            for ($i = 0; $i < $n; $i++) {
                                                $cat = $rs->fetch_assoc();

                                            ?>
                                                <option class="" value="<?php echo $cat["id"] ?>"><?php echo $cat["name"] ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                </div>


                            </div>
                            <div class="col-12 col-lg-2 d-grid">
                                <a class="btn btn-outline-light search_btn mt-2 fs-4" onclick="basicSearch(1);">Search</a>
                            </div>
                            <div class="col-2 col-md-1 mt-4 ">
                                <a href="advancedSearch.php" class="link-secondary link1 fs-4 advTXT"> Advanced</a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <!-- searchbar -->


            <div class="col-12" id="product_view_div">
            </div>

            <hr class="hr_breack1 mt-3">


            <!-- slide -->
            <div class="col-12 d-none d-lg-block">
                <div class="row justify-content-center">
                    <div id="carouselExampleCaptions" class="carousel slide col-9" data-bs-ride="carousel" style="height: 700px;">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="resources/slider images/1q.jpg" class="d-block w-100 posterImage1" alt="..." style="height: 700px;">
                                <div class="carousel-caption d-none d-md-block posterCaption text-light">
                                    <h5 class="posterTitle title_back">Welcome to HSOFT Computes</h5>
                                    <!-- <p class="posterText">The Sri Lankas Largest computer store </p> -->
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="resources/slider images/2q.jpg" class="d-block w-100" alt="..." style="height: 700px;">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5 class="posterTitle title_back">All ROG Products in one place</h5>

                                    <!-- <p class="posterText">The world's Best Online shoping center. By one Click </p> -->
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="resources/slider images/6q.jpg" class="d-block w-100" alt="..." style="height: 700px;">
                                <div class="carousel-caption d-none d-md-block posterCaption2 d-flex justify-content-center">
                                    <h5 class="posterTitle1 title_back">Build your own Dream PC with Us</h5>
                                    <!-- <p class="posterText">The world's Best Online shoping center. By one Click </p> -->
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="col-3" style="height: 700px;">
                        <div class="row ">

                            <div class="col-12 tinyBox">
                                <div class="card tinycard mb-3" style="max-width: 540px;height: 200px;">
                                    <div class="row g-0">

                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">High Performence GPU</h5>
                                                <p class="card-text">Best Pricess</p>
                                                <p class="card-text"><small class="text-muted"><a href="products.php?id=4"><i class="bi bi-arrow-right-circle-fill  fs-1 icon2"></i></a></small></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="resources/tini_image1.png" class="img-fluid rounded-start mt-1 me-1" alt="...">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 tinyBox tinyBox_m">
                                <div class="card tinycard mb-3" style="max-width: 540px;height: 200px;">
                                    <div class="row g-0">

                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title ">BEST GAMING LAPTOPS</h5>
                                                <p class="card-text">Best Pricess</p>
                                                <p class="card-text"><small class="text-muted"><a href="products.php?id=2"><i class="bi bi-arrow-right-circle-fill  fs-1 icon2"></i></a></small></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="resources/tini_image2.png" class="img-fluid rounded-start mt-1 me-1" alt="...">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 tinyBox  tinyBox_m">
                                <div class="card mb-3 tinycard" style="max-width: 540px;height: 200px;">
                                    <div class="row g-0">

                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">BUILD THE BEST GAMING PC</h5>
                                                <p class="card-text">Best Pricess</p>
                                                <p class="card-text"><small class="text-muted"><a href="products.php?id=3"><i class="bi bi-arrow-right-circle-fill  fs-1 icon2"></i></a></small></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="resources/tini_image3.png" class="img-fluid rounded-start mt-1 me-1" alt="...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- slide -->



            <!--Product title view-->

            <?php

            $rs = Database::s("SELECT * FROM `catagory`;");
            $n = $rs->num_rows;

            for ($j = 0; $j < $n; $j++) {
                $c = $rs->fetch_assoc();


            ?>
                <!-- This is Sigble product catogory name start-->

                <?php
                $resultSet1 = Database::s("SELECT * FROM   `product` WHERE `catagory_id` ='" . $c["id"] . "' AND `status_id`='1' ;");
                $nr1 = $resultSet1->num_rows;
                ?>
                <!--<button class="btn btn-primary"> <?php //echo $nr1 
                                                        ?></button>--> <?php
                                                                        ?>
                <div class="col-12 text-center mt-5">
                    <a href="#" class="display-4 mt-5 mb- text-light 3" style="text-decoration: none;"><?php echo $c["name"]; ?></a>&nbsp;&nbsp;

                    <?php

                    if ($nr1 > 5) {
                    ?>
                        <a href="products.php?id=<?php echo $c["id"] ?>" class="text-decoration-none fs-4"> more.......</a>
                    <?php
                    }

                    ?>


                </div>
                <!-- This is Sigble product catogory name end-->

                <!-- This is Sigble product catogory row start-->
                <div class="col-12 mb-5 pb-2">
                    <div class="row">
                        <div class="offset-lg-1 col-12 col-lg-10">
                            <div class="row justify-content-center justify-content-lg-start">

                                <?php
                                $resultSet = Database::s("SELECT * FROM   `product` WHERE `catagory_id` ='" . $c["id"] . "' AND `status_id`='1'  ORDER BY `datetime_added` DESC LIMIT 5;");
                                $nr = $resultSet->num_rows;

                                if ($nr == 0) {
                                ?><div class=" text-center">
                                        <h1 class="text-white-50">No Products Yet</h1>
                                    </div>

                                <?php
                                }

                                for ($i = 0; $i < $nr; $i++) {
                                    $prod = $resultSet->fetch_assoc();


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
                                                            if (isset($_SESSION["u"])) {
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
                                                                <?php



                                                                ?>

                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="col-12 mt-1 "><span class="btn " onclick="addToCart(<?php echo $prod['id'] ?>)"><i class="bi bi-cart-fill text-white fs-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to cart"></i></span></div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="col-12 mt-3"> <span class="" onclick="addToWatchlist(<?php echo $prod['id'] ?>);"><i class="bi bi-heart fs-1 <?php echo $codeC ?>" id="watch<?php echo $prod['id'] ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to watchlist"></i></span></div>
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
                                                                        <div class="col-12 mt-3"> <span class="" onclick="addToWatchlist(<?php echo $prod['id'] ?>);"><i class="bi bi-heart fs-1 <?php echo $codeC ?>" id="watch<?php echo $prod['id'] ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to watchlist"></i></span></div>
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
            <!-- This is Sigble product catogory row end-->







            <!--Product View-->
            <!-- footer -->
            <?php
            require "footer.php"
            ?>
            <!-- footer -->
        </div>
    </div>



    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    <script src="script,.js"></script>
</body>

</html>