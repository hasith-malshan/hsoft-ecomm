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
                <div id="content" class="d-none">
                    <nav class="navbar navbar-light navbar-expand bg-white shadow topbar static-top">
                        <div class="container-fluid">
                            <ul class="navbar-nav flex-nowrap ms-auto">
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

                <div class="wrapper mt-5">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-12 pe-0">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb text-black-50">
                                        <li class="breadcrumb-item"><a href="admin.php">Admin homepage</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Manage Products</li>
                                    </ol>
                                </nav>
                            </div>

                            <div class="col-12 bg-light text-center rounded">
                                <label class="form-label fs-2 fw-bold text-primary">Manage All Products</label>
                            </div>
                            <div class="col-12 bg-light rounded d-none">
                                <div class="row">
                                    <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                                        <div class="row">
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="searchtext" onkeyup="searchUser();" />
                                            </div>
                                            <div class="col-3">
                                                <button class="btn btn-primary" onclick="searchUser();">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3 mb-2">
                                <div class="row">

                                    <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                                        <span class="fs-4 fw-bold text-white">#</span>
                                    </div>

                                    <div class="col-2 col-lg-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                        <span class="fs-4 fw-bold">Product Image</span>
                                    </div>

                                    <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                                        <span class="fs-4 fw-bold text-white">Title</span>
                                    </div>

                                    <div class="col-6 col-lg-2 bg-light pt-2 pb-2">
                                        <span class="fs-4 fw-bold">Price</span>
                                    </div>

                                    <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                                        <span class="fs-4 fw-bold text-white">Quantity</span>
                                    </div>

                                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                        <span class="fs-4 fw-bold">Registered Date</span>
                                    </div>

                                    <div class="col-4 col-lg-1 bg-primary">
                                        <span class="fs-6 fw-bold text-white">Change Status</span>
                                    </div>

                                </div>
                            </div>

                            <?php

                            if (isset($_GET["page"])) {
                                $pageno = $_GET["page"];
                            } else {
                                $pageno = 1;
                            }


                            $productrs = Database::s("SELECT * FROM `product` ");
                            $d = $productrs->num_rows;
                            $row = $productrs->fetch_assoc();
                            $result_per_page = 5;
                            $number_of_pages = ceil($d / $result_per_page);
                            $page_first_result = ((int)$pageno - 1) * $result_per_page;
                            $selectedrs = Database::s("SELECT * FROM `product` LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
                            $srn = $selectedrs->num_rows;

                            $c = 0;
                            ?>

                            <div class="col-12 mb-2">

                                <?php
                                while ($srow = $selectedrs->fetch_assoc()) {
                                    $c = $c + 1;
                                ?>
                                    <div class="row border border-2 border-bottom-black-50 shadow">

                                        <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end mt-1">
                                            <span class="fs-5 fw-bold text-white"><?php echo $srow["id"]; ?></span>
                                        </div>

                                        <?php
                                        $productimg = Database::s("SELECT * FROM `image` WHERE `product_id`='" . $srow["id"] . "' ");
                                        $icode = $productimg->fetch_assoc();
                                        ?>

                                        <div class="col-2 col-lg-2 bg-light p-1 d-none d-lg-block mt-1" onclick="singleviewmodal('<?php echo $srow['id']; ?>');">
                                            <img src="<?php echo $icode["code"]; ?>" style="height: 60px; margin-left: 80px;">
                                        </div>

                                        <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block mt-1">
                                            <span class="fs-5 fw-bold text-white"><?php echo $srow["title"]; ?></span>
                                        </div>

                                        <div class="col-6 col-lg-2 bg-light pt-2 pb-2 mt-1">
                                            <span class="fs-5 fw-bold">Rs. <?php echo $srow["price"]; ?>.00</span>
                                        </div>

                                        <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block mt-1">
                                            <span class="fs-5 fw-bold text-white"><?php echo $srow["qty"]; ?></span>
                                        </div>

                                        <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block mt-1">
                                            <span class="fs-5 fw-bold"><?php
                                                                        $rd = $srow["datetime_added"];
                                                                        $splitrd = explode(" ", $rd);
                                                                        echo $splitrd[0];
                                                                        ?></span>
                                        </div>

                                        <div class="col-4 col-lg-1 bg-white d-grid p-1 mt-1">
                                            <?php
                                            $s = $srow["status_id"];
                                            if ($s == "1") {
                                            ?>
                                                <button class="btn btn-danger" onclick="blockproduct('<?php echo $srow['id']; ?>');">Block</button>
                                            <?php
                                            } else {
                                            ?>
                                                <button class="btn btn-success" onclick="blockproduct('<?php echo $srow['id']; ?>');">Unblock</button>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <!-- Modal-single product -->
                                    <div class="modal fade" id="singleproductview<?php echo $srow['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $srow["title"]; ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <img src="<?php echo $icode["code"]; ?>" style="height: 150px;" class="img-fluid">
                                                    </div>



                                                    <span class="fs-5 fw-bold">Price :</span>&nbsp;
                                                    <span class="fs-5 fw-bold">Rs. <?php echo $srow["price"]; ?>.00</span><br />
                                                    <span class="fs-5 fw-bold">Quantity :</span>&nbsp;
                                                    <span class="fs-5"><?php echo $srow["qty"]; ?> Item Left</span><br />

                                                    <span class="fs-5 fw-bold">Description :</span>&nbsp;
                                                    <span class="fs-5"><?php echo $srow["description"]; ?></span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal-single product -->

                                <?php
                                }
                                ?>

                                <!-- pagination -->
                                <div class="col-12 justify-content-center d-flex text-center fs-5 fw-bold mt-2">
                                    <div class="pagination">
                                        <a href="<?php if ($pageno <= 1) {
                                                        echo '#';
                                                    } else {
                                                        echo "?page=" . ($pageno - 1);
                                                    }
                                                    ?>">
                                            &laquo;</a>
                                        <?php
                                        for ($page = 1; $page <= $number_of_pages; $page++) {
                                            if ($page == $pageno) {
                                        ?>
                                                <a class="active ms-1" href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                                            <?php
                                            } else {
                                            ?>
                                                <a class="ms-1" href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                                        <?php
                                            }
                                        }
                                        ?>

                                        <a href="<?php
                                                    if ($pageno >= $number_of_pages) {
                                                        echo '#';
                                                    } else {
                                                        echo "?page=" . ($pageno + 1);
                                                    }
                                                    ?>">&raquo;
                                        </a>
                                    </div>
                                </div>
                                <!-- pagination -->

                                <hr />

                                <div class="col-12 d-none">
                                    <h3 class="text-primary">Manage Categories</h3>
                                </div>

                                <hr>

                                <div class="col-12 mb-3 d-none">
                                    <div class="row g-1">

                                        <?php

                                        $categoryrs = Database::s("SELECT * FROM `catagory` ");
                                        $num = $categoryrs->num_rows;

                                        for ($i = 0; $i < $num; $i++) {
                                            $row = $categoryrs->fetch_assoc();
                                        ?>
                                            <div class="col-12 col-lg-3">
                                                <div class="row g-1 px-1">
                                                    <div class="col-12 text-center bg-body border border-2 border-success shadow rounded">
                                                        <label class="form-label fs-4 fw-bold py-3"><?php echo $row["name"] ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>


                                        <div class="col-12 col-lg-3">
                                            <div class="row g-1 px-1">
                                                <div class="col-12 text-center bg-body border border-2 border-danger shadow rounded">
                                                    <div class="row">
                                                        <div class="col-3 mt-3 addnewimg"></div>
                                                        <div class="col-9" onclick="addnewmodal();">
                                                            <label class="form-label fs-4 fw-bold py-3 text-black-50">Add New Category</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Modal-1 -->
                                <div class="modal fade" id="addnewmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label class="form-label">Category</label>
                                                <input type="text" class="form-control" id="categorytxt" />
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" onclick="savecategory();">Save category</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal-1 -->




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