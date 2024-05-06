<?php

session_start();
require "connection.php";

//$Admintest = Database::s("SELECT * FROM `ADMIN` WHERE `lname`='Admin2'; ");
//$_SESSION["a"] = $Admintest->fetch_assoc();

if (isset($_SESSION["a"])) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>HSOFT - Manage Products </title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
        <link rel="icon" href="resources/logo.svg" />

    </head>

    <body id="page-top">
        <div id="wrapper">
            <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
                <div class="container-fluid d-flex flex-column p-0">
                    <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
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
                <div id="content">
                    <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                        <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                            <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            </form>
                            <ul class="navbar-nav flex-nowrap ms-auto">
                                <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">

                                    </div>
                                </li>

                                <li class="nav-item dropdown no-arrow mx-1">
                                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" href="messagesA.php"><span class="badge bg-danger badge-counter"></span><i class="fas fa-envelope fa-fw"></i></a>

                                    </div>
                                    <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
                                </li>
                                <div class="d-none d-sm-block topbar-divider"></div>
                                <li class="nav-item dropdown no-arrow">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                            <span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION["a"]["fname"] ?></span><img class="border rounded-circle img-profile" src="assets/img/200112401196-Hasith%20Malshan%20-%20My%20Image.jpg"></a>
                                        <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#">
                                                <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
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
                        <div class="row">

                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin.php">admin homepage</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">My Produts</li>
                                </ol>
                            </nav>

                            <!-- head -->
                            <div class="col-12 bg-primary">
                                <div class="row">
                                    <div class="col-12 col-lg-1 d-none">
                                        <div class="row d-flex justify-content-center justify-content-lg-start">
                                            <div class="col-3">
                                                <?php
                                                $profileImgS = Database::s("SELECT * from profile_img WHERE `user_email`='" . $_SESSION["a"]["email"] . "';");
                                                $profileImgNr = $profileImgS->num_rows;

                                                if ($profileImgNr == 1) {
                                                    $profileImgData = $profileImgS->fetch_assoc();

                                                ?>
                                                    <img src="<?php echo $profileImgData["code"] ?>" alt="" height="100px" width="auto" class="rounded-circle ">
                                                <?php
                                                } else { ?>
                                                    <img src="resources/demoProfileImg.jpg" alt="" height="100px" width="auto" class="rounded-circle ">
                                                <?php
                                                }

                                                ?>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-5 mt-3 mt-lg-0 d-none">
                                        <div class="row text-center text-lg-start">
                                            <div class="col-12">
                                                <span class="fw-bold text-white"><?php echo $_SESSION["a"]["fname"] . " " . $_SESSION["a"]["lname"] ?></span>
                                            </div>
                                            <div class="col-12">
                                                <span class="fw-bold text-white"><?php echo $_SESSION["a"]["email"] ?></span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mt-2 mt-lg-0 text-center">

                                            <span class="fw-bold text-center text-white h1">Products</span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- head -->




                        <div class="col-12 bg-light">
                            <div class="row">

                                <!-- sortings -->
                                <div class="col-12 col-lg-12 my-3 px-3">
                                    <div class="row">

                                        <div class="col-12 my-3  rounded  border-primary border">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="" class="form-label">Filters</label>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <input type="text" class="form-control" id="search">
                                                        </div>
                                                        <div class="col-2">
                                                            <i class="bi bi-search fs-3"></i>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-4">
                                                    <div class="row">
                                                        <div class="col-12 mt-2">
                                                            <label for="" class="form-label fw-bold">Active time</label>
                                                        </div>
                                                        <div class="col-12">
                                                            <hr width="80%" />
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="aTime" id="n">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    Newer to Oldest
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="aTime" id="o">
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                    Oldest to newer
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="row">
                                                        <div class="col-12 mt-2">
                                                            <label for="" class="form-label fw-bold">Quantity</label>
                                                        </div>
                                                        <div class="col-12">
                                                            <hr width="80%" />
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="sQty" id="l">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    Low to high
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="sQty" id="h">
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                    High to low
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="row">
                                                        <div class="col-12 ">
                                                            <label for="" class="form-label fw-bold">By condition</label>
                                                        </div>
                                                        <div class="col-12">
                                                            <hr width="80%" />
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="Con" id="b">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    Brand new
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="Con" id="u">
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                    Used
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-grid mt-5 mb-1">
                                                    <div class="btn btn-primary" onclick="addFilters(1);">Filter Data</div>
                                                </div>
                                                <div class="col-12 d-grid my-2">
                                                    <div class="btn btn-danger "><a href="sellerProductView.php" class="text-decoration-none text-light">Clear Data</a></div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- sortings -->





                                <!-- product -->
                                <div class="col-12 col-lg-12 ms-0 ms-md-1 mt-3 mb-3 bg-white">
                                    <div class="row  justify-content-center">

                                        <div class="col-12" id="productview">

                                        </div>

                                        <div class="col-10 " id="myproducts">
                                            <div class="row justify-content-center justify-content-lg-start ">




                                                <?php

                                                $productS = Database::s("SELECT * FROM `product` WHERE `user_email`='" . $_SESSION["a"]["email"] . "' ; ");
                                                $productNr = $productS->num_rows;
                                                $SingleProduct = $productS->fetch_assoc();

                                                $results_per_page = 6;
                                                $number_of_pages = ceil($productNr / $results_per_page);

                                                //echo $productNr."<br>";
                                                //echo $number_of_pages;



                                                if (!isset($_GET["page"])) {
                                                    $pageNo = 1;
                                                } else {
                                                    $pageNo = $_GET["page"];
                                                }

                                                $offset = ((int)$pageNo - 1) * $results_per_page;

                                                //echo $offset;

                                                $productS = Database::s("SELECT * from `product` where `user_email`='" . $_SESSION["a"]["email"] . "' LIMIT " . $results_per_page . " OFFSET " . $offset . ";");

                                                $productNr = $productS->num_rows;


                                                if ($productNr == 0) {
                                                ?><div class=" text-center">
                                                        <h1>No Products Added</h1>
                                                    </div>

                                                <?php
                                                }



                                                while ($productD = $productS->fetch_assoc()) {

                                                    $pimgS = Database::s("SELECT * FROM `image` WHERE `product_id`='" . $productD["id"] . "' ;");
                                                    $pimgData = $pimgS->fetch_assoc();
                                                ?>

                                                    <div class="card mb-3 ms-0 ms-md-1" style="max-width: 540px;">
                                                        <div class="row g-0">
                                                            <div class="col-md-4 mt-4">
                                                                <img src="<?php echo $pimgData['code'] ?>" class="img-fluid rounded-start" height="100px">
                                                            </div>
                                                            <div class="col-md-8 text-center">
                                                                <div class="card-body">

                                                                    <h5 class="card-title h4 fw-bold"><?php echo $productD["title"] ?></h5>
                                                                    <p class="card-text h5 fw-bold">Rs <?php echo $productD["price"] ?> .00</p>
                                                                    <p class="card-text h6 fw-bold"><small class="text-success"><?php echo $productD["qty"] . " items left"; ?></small></p>
                                                                </div>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox" id="check<?php echo $productD['id']; ?>" onclick="changeState(<?php echo $productD['id']; ?>);" <?php
                                                                                                                                                                                                                    if ($productD["status_id"] == 2) {
                                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                                    } ?>>
                                                                    <label class="form-check-label fw-bold text-info" for="check<?php echo $productD['id']; ?>" ; id="checklable<?php echo $productD['id']; ?>">
                                                                        <?php
                                                                        if ($productD["status_id"] == 2) {
                                                                            echo "Make your product active";
                                                                        } else {
                                                                            echo "Make your product Deactive";
                                                                        }
                                                                        ?>
                                                                    </label>
                                                                    <div class="row gx-0 gx-lg-1 mt-2">
                                                                        <div class="col-12 col-md-6 d-grid  mt-3 mt-lg-0">
                                                                            <a href="" class="btn  btn-success" onclick="sendId('<?php echo $productD['id']; ?>')"> Update Product</a>
                                                                        </div>
                                                                        <div class="col-12 col-md-6 d-grid mt-3 mt-lg-0">
                                                                            <a class="btn  btn-danger" onclick="deleteModal(<?php echo $productD['id']; ?>);"> Delete Product</a>
                                                                        </div>
                                                                        <p class="mt-1 card-title fw-bold">Product ID :<?php echo $productD["id"] ?></p>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!-- Modal -->
                                                    <div class="modal fade" id='deleteModal<?php echo $productD["id"] ?>' tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Do you wanto delete <?php echo $productD["title"] ?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    ...
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" onclick="" data-bs-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn btn-danger" onclick="deleteModal();">Save changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal -->

                                                <?php }
                                                ?>






                                            </div>
                                        </div>

                                        <!-- pagination -->

                                        <div class="col-12" id="pagination">
                                            <div class="row">


                                                <div class="d-flex justify-content-center">
                                                    <div class="pagination text-center line1 ">

                                                        <a href="<?php if ($pageNo <= 1) {
                                                                        echo '#';
                                                                    } else {
                                                                        echo "?page=" . ($pageNo - 1);
                                                                    } ?>">

                                                            &laquo;</a>

                                                        <?php

                                                        for ($page = 1; $page <= $number_of_pages; $page++) {

                                                            if ($page == $pageNo) {
                                                        ?>
                                                                <a href="<?php echo  "?page=" . ($page); ?>" class="active"> <?php echo $page; ?> </a>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <a href="<?php echo  "?page=" . ($page); ?>" class="ms-1"> <?php echo $page; ?> </a>
                                                            <?php
                                                            }
                                                            ?>


                                                        <?php

                                                        }


                                                        ?>

                                                        <a href="<?php if ($pageNo >= $number_of_pages) {
                                                                        echo '#';
                                                                    } else {
                                                                        echo "?page=" . ($pageNo + 1);
                                                                    } ?>
                                                        ">&raquo;</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- pagination -->

                                    </div>
                                </div>
                                <!-- product -->
                            </div>
                        </div>

                    </div>
                </div>

            </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>


        </div>




        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/chart.min.js"></script>
        <script src="assets/js/bs-init.js"></script>
        <script src="assets/js/theme.js"></script>
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