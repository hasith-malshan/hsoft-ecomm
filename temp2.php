<?php
require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="icon" href="resources/logo.svg">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-h-square"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>HSOFT ADMINS</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <?php
                require "sidebar.php";

                ?>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content" class="">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ..."><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>

                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter">7</span><i class="fas fa-envelope fa-fw"></i></a>

                                </div>
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">Valerie Luna</span><img class="border rounded-circle img-profile" src="assets/img/200112401196-Hasith%20Malshan%20-%20My%20Image.jpg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

            </div>

            <div class="wrapper">
            <div class="container-fluid">
            <!-- start of main Container -->

            <!-- heading -->
            <div class="row gy-3" id="updateProductBox">
                <!-- start of main row -->

                <div class="col-12 mb-2 text-center">
                    <h3 class="h2 fw-bold text-primary">Update Product </h3>
                </div>

                <div class="col-12 mb-2">
                    <div class="row justify-content-center">
                        <!-- <span class="lbl1">Search Product you want to Update</span> -->
                        <div class="col-12 col-md-8 col-lg-6">
                            <input type="text" class="form-control col-12 col-8" placeholder="Search Product you want to Update" id="searchToUpdate">
                        </div>
                        <div class="col-12 col-md-3 col-lg-2 d-grid">
                            <div class="btn btn-success " onclick="searchToUpdate();">Search product </div>
                        </div>
                    </div>
                </div>
                <!-- heading -->

                <!-- select Catagory,brand,modle -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label for="" class="form-label lbl1">All Catogory</label>
                                    <div class="col-12 mb-2">

                                        <?php
                                        $ca = Database::s("SELECT * FROM `catagory` WHERE `id`='" . $_SESSION["p"]["catagory_id"] . "' ");
                                        $caData = $ca->fetch_assoc();
                                        ?>
                                        <select class="form-select" aria-label="Default select example" id="ca" disabled>
                                            <option selected id="caSelected"><?php echo $caData["name"] ?></option>


                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label for="" class="form-label lbl1">Select Product Brand</label>
                                    <div class="col-12 mb-2">
                                        <?php
                                        $mb = Database::s("SELECT * FROM `modle_has_brand` WHERE `id`='" . $_SESSION["p"]["modle_has_brand_id"] . "' ");
                                        $mbData = $mb->fetch_assoc();

                                        $b = Database::s("SELECT * FROM `brand` WHERE `id`='" . $mbData["brand_id"] . "' ");
                                        $bData = $b->fetch_assoc();
                                        ?>

                                        <select class="form-select" aria-label="Default select example" id="br" disabled>
                                            <option selected><?php echo $bData["name"] ?></option>


                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label for="" class="form-label lbl1">Select Product modle</label>
                                    <div class="col-12 mb-2">
                                        <?php
                                        $mod = Database::s("SELECT * FROM `model` WHERE `id`='" . $mbData["model_id"] . "' ");
                                        $modData = $mod->fetch_assoc(); ?>
                                        <select class="form-select" aria-label="Default select example" id="mo" disabled>
                                            <option selected><?php echo $modData["name"] ?></option>


                                        </select>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- select Catagory,brand,modle -->

                </div>
                <hr class="hr_breack1">

                <!-- title -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label for="" class="form-label lbl1"> Add a title to your product</label>
                        </div>
                        <div class="offset-lg-2 col-12 col-lg-8">
                            <input type="text " class="form-control" id="ti" value="<?php echo $_SESSION["p"]["title"] ?>" />
                        </div>
                    </div>
                </div>
                <!-- title -->

                <hr class="hr_breack1">

                <!-- condition,color,qty -->
                <div class="col-12">
                    <div class="row gy-3">


                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label for="" class="form-label lbl1"> Select Product Condition</label>
                                </div>

                                <?php

                                $conS = Database::s("SELECT * FROM `product` WHERE `id`='" . $_SESSION["p"]["id"] . "' ");
                                $conSData = $conS->fetch_assoc();

                                $conName = Database::s("SELECT * FROM `condition` WHERE `id`='" . $conSData["condition_id"] . "' ");
                                $conNameData = $conName->fetch_assoc();

                                ?>
                                <div class="offset-lg-1 col-12 col-lg-3 form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" name="condition" checked id="bn" disabled>
                                    <label class="form-check-label fs-2" for="bn">
                                        <?php echo $conNameData["name"] ?>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label for="" class="form-label lbl1"> Select your color </label>
                                </div>

                                <?php

                                $clrId = Database::s("SELECT * FROM `product` WHERE `id`='" . $_SESSION["p"]["id"] . "' ");
                                $clrIdData = $clrId->fetch_assoc();

                                $clrName = Database::s("SELECT * FROM `color` WHERE `id`='" . $clrIdData["color_id"] . "' ");
                                $clrNameData = $clrName->fetch_assoc();

                                ?>

                                <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                    <input class="form-check-input " type="radio" value="" id="clr1" name="colorSelect" disabled checked>
                                    <label class="form-check-label fs-2" for="clr1">
                                        <?php echo $clrNameData["name"] ?>
                                    </label>
                                </div>


                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="COL-12"> <label for="" class="form-label lbl1"> Add product quantity </label>
                                    <input class="form-control" type="number" value="<?php echo $_SESSION["p"]["qty"] ?>" min="0" id="qty">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- condition,color,qty -->

                <hr class="hr_breack1">

                <!-- payents,cost,method -->

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="col-12">
                                        <label for="" class="form-label lbl1">Cost per Item</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rs.</span>
                                        <input type="text" class="form-control" aria-label="Amount (to the nearest Ruppee)" id="cost" disabled value="<?php echo $_SESSION["p"]["price"] ?>">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- payents,cost,method -->

                <hr class="hr_breack1">

                <!-- dilivery Cost -->

                <div class="col-12 ">

                    <div class="row">

                        <div class="col-12">
                            <label for="" class="form-label lbl1">Dilivery Cost</label>
                        </div>

                        <div class="col-12 col-lg-6 ">
                            <div class="row">

                                <div class="offset-lg-1 col-12 col-lg-3">
                                    <label for="" class="form-label">Dilivery Cost within Colombo</label>
                                </div>

                                <div class="col-12 col-lg-7">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rs.</span>
                                        <input type="text" class="form-control" aria-label="Amount (to the nearest Ruppee)" id="dwc" value="<?php echo $_SESSION["p"]["dic"] ?>">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="col-12 col-lg-6 ">
                            <div class="row">

                                <div class="offset-lg-1 col-12 col-lg-3">
                                    <label for="" class="form-label">Dilivery Cost out of Colombo</label>
                                </div>

                                <div class="col-12 col-lg-7">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rs.</span>
                                        <input type="text" class="form-control" aria-label="Amount (to the nearest Ruppee)" id="doc" value="<?php echo $_SESSION["p"]["doc"] ?>">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>
                </div>

                <!-- dilivery Cost -->
                <hr class="hr_breack1">


                <!-- descrption -->
                <div class="col-12 ">
                    <div class="row">
                        <div class="col-12 ">
                            <label for="" class="form-label lbl1">Product Description</label>
                        </div>

                        <div class="col-12  d-grid">
                            <textarea name="" id="des" cols="100" rows="30" class="form-control mb-3" style="background-color: honeydew;"><?php echo $_SESSION["p"]["description"] ?></textarea>
                        </div>

                    </div>
                </div>
                <!-- descrption -->

                <div class="col-12">
                    <div class="row">

                        <div class="col-12">
                            <label for="" class="form-label lbl1"> Add product Image</label>
                        </div>


                        <?php

                        $imgS = Database::s("SELECT * FROM `image` WHERE `product_id` = '" . $_SESSION["p"]["id"] . "' ;");
                        $imgD = $imgS->fetch_assoc();

                        if ($imgD["code"] != "") {
                            $code = $imgD["code"];

                            if ($imgD["code1"] != "") {
                                $code1 = $imgD["code1"];
                            } else {
                                $code1 = "resources/addproductimg.svg";
                            }

                            if ($imgD["code2"] != "") {
                                $code2 = $imgD["code2"];
                            } else {
                                $code2 = "resources/addproductimg.svg";
                            }
                            //$code1 = $imgD["code1"];
                            //$code2 = $imgD["code2"];

                        } else {
                            $code = "resources/addproductimg.svg";
                            $code1 = "resources/addproductimg.svg";
                            $code2 = "resources/addproductimg.svg";
                        }

                        ?>
                        <div class="col-12">
                            <div class="row">

                                <div class="col-4 d-inline">

                                    <img src="<?php echo $code ?>" alt="" class="img-thumbnail col-12 ms-2" id="prev1">
                                    <div class="col-12">

                                        <div class="row">

                                            <div class="col-12 col-lg-6 ms-2 mt-2">
                                                <input type="file" accept="image/*" class="form-control d-none" id="imgUploader1">
                                                <label for="imgUploader1" class="btn btn-primary col-12 col-lg-4" onclick="changeImg1();">Upload</label>
                                            </div>
                                            <div class="col-6 col-lg-4 d-grid d-none">
                                                <button class="btn btn-success">Upload </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-4 d-inline">
                                    <img src="<?php echo $code1 ?>" alt="" class="img-thumbnail col-12 ms-2" id="prev2">
                                    <div class="col-12">

                                        <div class="row">

                                            <div class="col-12 col-lg-6 ms-2 mt-2">
                                                <input type="file" accept="image/*" class="form-control d-none" id="imgUploader2">
                                                <label for="imgUploader2" class="btn btn-primary col-12 col-lg-4" onclick="changeImg2();">Upload</label>
                                            </div>
                                            <div class="col-6 col-lg-4 d-grid d-none">
                                                <button class="btn btn-success">Upload </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-4 d-inline">

                                    <img src="<?php echo $code2 ?>" alt="" class="img-thumbnail col-12 ms-2" id="prev3">
                                    <div class="col-12">

                                        <div class="row">

                                            <div class="col-12 col-lg-6 ms-2 mt-2">
                                                <input type="file" accept="image/*" class="form-control d-none" id="imgUploader3">
                                                <label for="imgUploader3" class="btn btn-primary col-12 col-lg-4" onclick="changeImg3();">Upload</label>
                                            </div>
                                            <div class="col-6 col-lg-4 d-grid d-none">
                                                <button class="btn btn-success">Upload </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- product img -->
                <hr class="hr_breack1">

                <!-- notice -->
                <div class="col-12">
                    <label class="form-lable lbl1" for="">
                        Notice...
                    </label>
                    <label for="" class="form-lable">
                        We are taking 5% of the prodct price from every product as a service charge.
                    </label>
                </div>
                <!-- notice -->

                <!-- save product -->
                <div class="col-12 ">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-4 d-grid">
                            <button class="btn btn-success my-5" onclick="updateProduct();">Update product </button>
                            <button class="btn btn-dark my-5" onclick="goToAddProduct();">Add product </button>

                        </div>
                    </div>
                </div>
                <!-- save product -->

            </div>
            <!-- end of main row -->

        </div>
            </div>




            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2021</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="script,.js"></script>
</body>

</html>