<?php

session_start();
require "connection.php";

if (isset($_GET["f"])) {
    $from = $_GET["f"];
}
if (isset($_GET["t"])) {
    $to = $_GET["t"];
}

?>
<?php



//$Admintest = Database::s("SELECT * FROM `ADMIN` WHERE `lname`='Admin2'; ");
//$_SESSION["a"] = $Admintest->fetch_assoc();

if (isset($_SESSION["a"])) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>HSOFT - Selling History </title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
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
                                      
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>

                </div>

                <div class="wrapper">
                    <div class="container-fluid mb-5">
                        <div class="row">




                            <div class="col-12 pe-0">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb text-black-50">
                                        <li class="breadcrumb-item"><a href="admin.php">Admin homepage</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><a href="sellinghistory.php">Product Selling History</a>  </li>
                                    </ol>
                                </nav>
                            </div>

                            <div class="col-12 bg-light text-center rounded ">
                                <label for="" class="form-label fs-2 fw-bold text-primary">Product Selling History</label>
                            </div>

                            <div class="col-12">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-6 mt-2 d-grid">
                                        <label for="" class="form-label text-center ">From Date</label>
                                        <input type="date" class="form-control" id="fromdate">

                                        <label for="" class="form-label text-center mt-2">To Date</label>
                                        <input type="date" class="form-control" id="todate">

                                        <button class="btn btn-primary mt-3" onclick="dailyselling();">Search</button>

                                        <hr class="border border-1 border-white">

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3 mb-2">
                                <div class="row border-2 border border-bottom-black-50">

                                    <div class="col-4 col-lg-2 bg-primary pt-2 pb-2 text-end">
                                        <span class="fs-4 fw-bold text-white">Order ID</span>
                                    </div>

                                    <div class="col-5 col-lg-2 bg-light pt-2 pb-2 d-lg-block">
                                        <span class="fs-4 fw-bold">Product</span>
                                    </div>

                                    <div class="col-3 bg-primary pt-2 pb-2  d-none d-lg-block col-lg-2">
                                        <span class="fs-4 fw-bold text-white">Buyer</span>
                                    </div>

                                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                        <span class="fs-4 fw-bold">Price</span>
                                    </div>

                                    <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 d-lg-block">
                                        <span class="fs-4 fw-bold text-white">Quantity</span>
                                    </div>

                                    <div class="col-3 col-lg-2 bg-light pt-2 d-none pb-2 d-lg-block">
                                        <span class="fs-5 fw-bold">Purchased Date and time</span>
                                    </div>


                                </div>
                            </div>
                            <?php
                            if (empty($from) && empty($to)) {
                                $fromrs = Database::s("SELECT * FROM `invoice` ORDER BY `date`");
                                $fn = $fromrs->num_rows;

                                if ($fn > 0) {
                                    for ($x = 0; $x < $fn; $x++) {
                                        $srow = $fromrs->fetch_assoc();
                            ?>
                                        <div class="col-12 mb-2">
                                            <div class="row border border-2 border-bottom-black-50 shadow ">

                                                <div class="col-4 col-lg-2 bg-primary pt-2 pb-2 text-end">
                                                    <span class="fs-5 fw-bold text-white"><?php echo $srow["order_id"] ?></span>
                                                </div>

                                                <?php
                                                $productdetails = Database::s("SELECT * FROM `product` WHERE `id`='" . $srow["product_id"] . "' ");
                                                $data = $productdetails->fetch_assoc();

                                                $udetails = Database::s("SELECT * FROM `user` WHERE `email`='" . $srow["user_email"] . "' ");
                                                $udata = $udetails->fetch_assoc();
                                                ?>

                                                <div class="col-5 col-lg-2 bg-light p-2 d-lg-block">
                                                    <span class="fs-5 fw-bold"><?php echo $data["title"]; ?></span>
                                                </div>

                                                <div class="col-6 col-lg-2 bg-primary d-none d-lg-block pt-2 pb-2">
                                                    <span class="fs-5 fw-bold text-white"><?php echo $udata["fname"] . " " . $udata["lname"]; ?></span>
                                                </div>

                                                <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block col-lg-2">
                                                    <span class="fs-5 fw-bold">Rs. <?php echo $srow["total"]; ?>.00</span>
                                                </div>

                                                <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 d-lg-block">
                                                    <span class="fs-5 fw-bold text-white"><?php echo $srow["qty"]; ?></span>
                                                </div>

                                                <div class="col-3 col-lg-2 bg-light pt-2 d-none pb-2 d-lg-block">
                                                    <span class="fs-5 fw-bold text-dark"><?php echo $srow["date"]; ?></span>
                                                </div>

                                            </div>
                                        </div>


                                    <?php

                                    }
                                } else {
                                    echo "No sellings";
                                }
                            } else if (!empty($from) && !empty($to)) {


                                if ($from == $to) {


                                    $splitdate1 = explode(" ", $from);
                                    $n_from_date = $splitdate1[0];

                                    $splitdate2 = explode(" ", $to);
                                    $n_to_date = $splitdate2[0];

                                    $s = "00:00:00";
                                    $e = "23:59:59";

                                    $from = $n_from_date . " " . $s;
                                    $to = $n_to_date . " " . $e;
                                }

                                $fromrs = Database::s("SELECT * FROM `invoice` WHERE `date` BETWEEN '" . $from . "' AND '" . $to . "'");
                                $fn = $fromrs->num_rows;

                                if ($fn > 0) {
                                    for ($x = 0; $x < $fn; $x++) {
                                        $srow = $fromrs->fetch_assoc();

                                    ?>
                                        <div class="col-12 mb-2">
                                            <div class="row">

                                                <div class="col-4 col-lg-2 bg-primary pt-2 pb-2 text-end">
                                                    <span class="fs-5 fw-bold text-white"><?php echo $srow["order_id"] ?></span>
                                                </div>

                                                <?php
                                                $productdetails = Database::s("SELECT * FROM `product` WHERE `id`='" . $srow["product_id"] . "' ");
                                                $data = $productdetails->fetch_assoc();

                                                $udetails = Database::s("SELECT * FROM `user` WHERE `email`='" . $srow["user_email"] . "' ");
                                                $udata = $udetails->fetch_assoc();
                                                ?>

                                                <div class="col-5 col-lg-2 bg-light p-2 d-lg-block">
                                                    <span class="fs-5 fw-bold"><?php echo $data["title"]; ?></span>
                                                </div>

                                                <div class="col-6 col-lg-2 bg-primary d-none d-lg-block pt-2 pb-2">
                                                    <span class="fs-5 fw-bold text-white"><?php echo $udata["fname"] . " " . $udata["lname"]; ?></span>
                                                </div>

                                                <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                                    <span class="fs-5 fw-bold">Rs. <?php echo $srow["total"]; ?>.00</span>
                                                </div>

                                                <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 d-lg-block">
                                                    <span class="fs-5 fw-bold text-white"><?php echo $srow["qty"]; ?></span>
                                                </div>

                                                <div class="col-3 col-lg-2 bg-light pt-2 d-none pb-2 d-lg-block">
                                                    <span class="fs-5 fw-bold text-dark"><?php echo $srow["date"]; ?></span>
                                                </div>

                                            </div>
                                        </div>


                            <?php

                                    }
                                } else {
                                    echo "You haven't sell anything in this time";
                                }
                            }

                            ?>


                           
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