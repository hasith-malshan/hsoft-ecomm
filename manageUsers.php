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
        <title>HSOFT - Manage User</title>
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
                            <div class="col-12 pe-0 bg-white">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="admin.php">Admin homepage</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-12 bg-light text-center rounded">
                                <label for="" class="form-lable fs-2 fw-bold">Manage All Users</label>
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

                            <div class="col-12 my-5">
                                <div class="row" id="table"></div>
                            </div>




                            <div class="col-12 mt-3 mb-2">
                                <div class="row">
                                    <div class="col-12 col-lg-1 bg-primary py-2 text-end">
                                        <span class="fs-4 fw-bold text-white">#</span>
                                    </div>

                                    <div class="col-12 col-lg-2 bg-light py-2 ">
                                        <span class="fs-4 fw-bold">Profile Image</span>
                                    </div>

                                    <div class="col-12 col-lg-2 bg-primary py-2">
                                        <span class="fs-4 fw-bold text-white">User Name</span>
                                    </div>

                                    <div class="col-12 col-lg-3 bg-light py-2 ">
                                        <span class="fs-4 fw-bold">Email</span>
                                    </div>

                                    <div class="col-12 col-lg-1 bg-primary py-2">
                                        <span class="fs-4 fw-bold text-white">Mobile </span>
                                    </div>

                                    <div class="col-12 col-lg-2 bg-light py-2 ">
                                        <span class="fs-4 fw-bold">Regesterd date</span>
                                    </div>

                                    <div class="col-12 col-lg-1 bg-primary py-2 text-center">
                                        <span class="fs-6 fw-bold text-white">change status</span>
                                    </div>
                                </div>

                                <?php
                                $userS = Database::s("SELECT * FROM `user` ; ");
                                $userSNr = $userS->num_rows;
                                $userD = $userS->fetch_assoc();

                                $results_per_page = 20;
                                $number_of_pages = ceil($userSNr / $results_per_page);

                                //echo $productNr."<br>";
                                //echo $number_of_pages;



                                if (!isset($_GET["page"])) {
                                    $pageNo = 1;
                                } else {
                                    $pageNo = $_GET["page"];
                                }

                                $offset = ((int)$pageNo - 1) * $results_per_page;

                                //echo $offset;

                                $userS1 = Database::s("SELECT * from `user`  LIMIT " . $results_per_page . " OFFSET " . $offset . ";");

                                $userS1Nr = $userS1->num_rows;


                                if ($userS1Nr == 0) {
                                ?><div class=" text-center">
                                        <h1>No Users</h1>
                                    </div>

                                <?php
                                }

                                $i = 1;

                                while ($userD1 = $userS1->fetch_assoc()) {

                                    //$pimgS = Database::s("SELECT * FROM `image` WHERE `product_id`='" . $productD["id"] . "' ;");
                                    //$pimgData = $pimgS->fetch_assoc();
                                ?>


                                    <div class="row mt-1 border border-bottom-2 border-bottom-black-50 shadow">
                                        <div class="col-12 col-lg-1 bg-primary py-2 text-end">
                                            <span class="fs-4 fw-bold text-white"><?php
                                                                                    echo $i;
                                                                                    $i = $i + 1;
                                                                                    ?></span>
                                        </div>


                                        <?php
                                        $profileImg = Database::s("SELECT * FROM `profile_img` WHERE `user_email`='" . $userD1["email"] . "' ; ");
                                        $n = $profileImg->num_rows;

                                        if (isset($_SESSION["a"])) {
                                            $ad = "0";
                                        } else {
                                            $ad = null;
                                        }

                                        ?>

                                        <!-- <div>onclick="viewmsgmodal('<?php echo $userD1['email'] ?>'); refresher('<?php echo $userD1['email'] ?>',<?php echo $ad ?>);"</div> -->

                                        <div class="col-12 col-lg-2 bg-light py-2 text-center" onclick="msg('<?php echo $userD1['email'] ?>')">
                                            <?php
                                            if ($n == 0) {
                                            ?>
                                                <img src="resources/demoProfileImg.jpg" class="rounded mt-5 col-2" width="150px">
                                            <?php
                                            } else {
                                                $profileImgData = $profileImg->fetch_assoc();

                                            ?>
                                                <img src="<?php echo $profileImgData["code"] ?>" class="rounded mt-5 col-2" width="150px" id="prev">
                                            <?php


                                            }

                                            ?>



                                        </div>

                                        <div class="col-12 col-lg-2 bg-primary py-2">
                                            <span class="fs-4 fw-bold text-white"> <?php echo $userD1["fname"] . " " . $userD1["lname"] ?></span>
                                        </div>

                                        <div class="col-12 col-lg-3 bg-light py-2 ">
                                            <span class="fs-4 fw-bold"><?php echo $userD1["email"] ?></span>
                                        </div>

                                        <div class="col-12 col-lg-1 bg-primary py-2">
                                            <span class="fs-5 fw-bold text-white"> <?php echo $userD1["mobile"] ?></span>
                                        </div>

                                        <div class="col-12 col-lg-2 bg-light py-2 ">
                                            <span class="fs-4 fw-bold"><?php echo $userD1["regester_date"] ?></span>
                                        </div>

                                        <div class="col-12 col-lg-1 d-grid shadow">
                                            <?php
                                            $s = $userD1["status_id"];
                                            if ($s == "1") {
                                            ?>
                                                <button class="btn btn-link text-success" onclick="blockUser('<?php echo $userD1['email']; ?>');">Block</button>
                                            <?php
                                            } else {
                                            ?>
                                                <button class="btn btn-link text-danger" onclick="blockUser('<?php echo $userD1['email']; ?>');">Unblock</button>
                                            <?php
                                            }
                                            ?>

                                        </div>



                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="msgModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" onload="refresher()">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Message to <span id="modalName"></span></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div style="background: linear-gradient(to right, #74EBD5, #9FACE6);">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-12 py-5 px-4">
                                                                    <div class="row rounded overflow-hidden shadow">
                                                                        <div class="col-12 px-0 bg-white">
                                                                        </div>
                                                                        <div class="col-12 px-3">
                                                                            <div class="row">
                                                                                <div class="col-12 px-0">
                                                                                    <div class="row px-4 py-5 text-white" id="chatrow" style="height: 500px; overflow-y: scroll; ">

                                                                                        <!-- The messages will be loaded here -->

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 px-0">
                                                                                    <div class="row bg-white">
                                                                                        <!-- Message typing area -->
                                                                                        <div class="col-12 mb-0 mt-auto">
                                                                                            <div class="row">
                                                                                                <div class="input-group">
                                                                                                    <input type="text" id="msgtxt" placeholder="Type a message..." aria-describedby="sendbtn" class="form-control rounded border-0 py-2 px-3 bg-light" />
                                                                                                    <div class="input-group-append">
                                                                                                        <button id="sendbtn" class="btn btn-link fs-3" onclick="sendmessage('<?php echo $userD1['email']; ?>',<?php echo $ad ?>);"><i class="bi bi-cursor-fill"></i></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- Message typing area -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                <?php
                                }
                                ?>
                                <!-- pagination -->






                                <div class="col-12 mt-5">
                                    <div class="row">


                                        <div class="d-flex justify-content-center">
                                            <div class="pagination text-center line1 ">

                                                <a href="<?php
                                                            if ($pageNo <= 1){
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