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
        <title>Dashboard - Admin</title>
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



                    <?php

                    $today = date("Y-m-d");
                    $thisMonth = date("m");
                    $thisYear = date("y");

                    $DailyEarnings = "0";
                    $MonthlyEarnings = "0";
                    $totalEarnings = "0";
                    $todaySellings = "0";
                    $monthlySellings = "0";
                    $totalSellings = "0";

                    $invoiceS = Database::s("SELECT * FROM `invoice`;");
                    $invoiceSNr = $invoiceS->num_rows;

                    for ($i = 0; $i < $invoiceSNr; $i++) {
                        $invoiceD = $invoiceS->fetch_assoc();

                        $invoiceDate = $invoiceD["date"];

                        $splitDate = explode(" ", $invoiceDate);
                        $extractedDate = $splitDate[0];

                        $splitMonth = explode("-", $invoiceDate);
                        $extractedMonth = $splitMonth[1];

                        $splitYear = explode("-", $invoiceDate);
                        $extractedYear = $splitYear[0];

                        if ($extractedDate == $today) {
                            $DailyEarnings = $DailyEarnings + $invoiceD["total"];
                            $todaySellings = $todaySellings + $invoiceD["qty"];
                        }

                        if ($extractedMonth == $thisMonth) {
                            $MonthlyEarnings = $MonthlyEarnings + $invoiceD["total"];
                            $monthlySellings = $monthlySellings + $invoiceD["qty"];
                        }

                        $totalSellings = $totalSellings + $invoiceD["qty"];
                    }

                    ?>

                    <?php

                    $usersrs = Database::s("SELECT * FROM `user`");
                    $un = $usersrs->num_rows;

                    $invo = Database::s("SELECT * FROM `invoice`");
                    $invoNr = $invo->num_rows;

                    ?>

                    <div class="container-fluid">
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-dark mb-0">Dashboard</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card shadow border-start-primary py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Earnings (monthly)</span></div>
                                                <div class="text-dark fw-bold h5 mb-0"><span>Rs.<?php echo $MonthlyEarnings ?></span></div>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card shadow border-start-success py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Earnings (Daily)</span></div>
                                                <div class="text-dark fw-bold h5 mb-0"><span>Rs.<?php echo $DailyEarnings ?></span></div>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card shadow border-start-info py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Total Sold Items</span></div>
                                                <div class="text-dark fw-bold h5 mb-0"><span><?php echo $totalSellings ?></span></div>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card shadow border-start-warning py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Total Users</span></div>
                                                <div class="text-dark fw-bold h5 mb-0"><span><?php echo $un ?></span></div>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <?php
                        $today = date("Y-m-d H:i:s");

                        $timestamp1 = strtotime('today');
                        $timestamp2 = strtotime('yesterday');
                        $timestamp3 = strtotime('-2 days');
                        $timestamp4 = strtotime('-3 day');
                        $timestamp5 = strtotime('-4 days');

                        $day1 =  date('Y-m-d', $timestamp1);
                        $day2 =  date('Y-m-d', $timestamp2);
                        $day3 =  date('Y-m-d', $timestamp3);
                        $day4 =  date('Y-m-d', $timestamp4);
                        $day5 =  date('Y-m-d', $timestamp5);

                        $dateS[0] = $day1;
                        $dateS[1] = $day2;
                        $dateS[2] = $day3;
                        $dateS[3] = $day4;
                        $dateS[4] = $day5;

                        //echo print_r($dateS);

                        $prodQty;
                        for ($i = 0; $i < 5; $i++) {

                            $chartDate1 = Database::s("SELECT * FROM `invoice` WHERE `date` LIKE '" . $dateS[$i] . "%' ");
                            $chartDateNr1 =  $chartDate1->num_rows;
                            $prodQty[$i] = $chartDateNr1;
                        }

                        $allSellings  = Database::s("SELECT * FROM `invoice`;");
                        $allSellingsNr = $allSellings->num_rows;
                        $incQty = 0;
                        /*for ($i = 0; $i < $allSellingsNr; $i++) {
                            $allSellingsData = $allSellings->fetch_assoc();
                            $incQty = $incQty + $allSellingsData["qty"];
                        }*/
                        echo $incQty;

                        ?>

                        <div class="row">
                            <div class="col-12">
                                <div class="card shadow mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="text-primary fw-bold m-0">Last five Days Selllings- Products</h6>

                                    </div>

                                    <div class="cord-body">
                                        <canvas id="mychart">
                                        </canvas>
                                    </div>




                                </div>
                            </div>
                            <div class="col-lg-5 col-xl-4 d-none">
                                <div class="card shadow mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="text-primary fw-bold m-0">Revenue Sources</h6>

                                    </div>
                                    <div class="card-body">
                                        <canvas id="mychart2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card shadow mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="text-primary fw-bold m-0">All Selllings - Quantities</h6>

                                    </div>

                                    <div class="cord-body">
                                        <canvas id="mychart3">
                                        </canvas>
                                    </div>




                                </div>
                            </div>

                        </div>

                        <script>
                            //const img = new Image();

                            const mychart = document.getElementById('mychart').getContext('2d');
                            //const fillPattern = ctx.createPattern(img, 'repeat');

                            const chart = new Chart(mychart, {
                                type: 'line',
                                data: {
                                    labels: ['<?php echo $day5 ?>', '<?php echo $day4 ?>', '<?php echo $day3 ?>', '<?php echo $day2 ?>', '<?php echo $day1 ?>'],
                                    datasets: [{
                                        label: 'Last 5 Days Sellings',
                                        data: [<?php echo $prodQty["4"] ?>, <?php echo $prodQty["3"] ?>, <?php echo $prodQty["2"] ?>, <?php echo $prodQty["1"] ?>, <?php echo $prodQty["0"] ?>],
                                        //backgroundColor: fillPattern
                                    }]
                                }
                            });
                        </script>

                        <script>
                            //const img = new Image();

                            const mychart1 = document.getElementById('mychart2').getContext('2d');
                            //const fillPattern = ctx.createPattern(img, 'repeat');

                            const chart1 = new Chart(mychart1, {
                                type: 'pie',
                                data: {
                                    labels: ['Item 1', 'Item 2', '<?php echo "hello" ?> 3', '4', '5'],
                                    datasets: [{
                                        label: 'Piop',
                                        data: [10, 15, 30, 10, 20],
                                        //backgroundColor: fillPattern
                                    }]
                                }
                            });
                        </script>

                        <script>
                            //const img = new Image();

                            const mychart3 = document.getElementById('mychart3').getContext('2d');
                            //const fillPattern = ctx.createPattern(img, 'repeat');

                            const chart2 = new Chart(mychart3, {
                                type: 'line',
                                data: {
                                    labels: [
                                        <?php

                                        for ($i = 0; $i < $allSellingsNr; $i++) {
                                            echo "'event" . $i + 1 . "',";
                                        } ?>
                                    ],
                                    datasets: [{
                                        label: 'All sellings',
                                        data: [<?php
                                                for ($i = 0; $i < $allSellingsNr; $i++) {
                                                    $allSellingsData = $allSellings->fetch_assoc();
                                                    $incQty = $incQty + $allSellingsData["qty"];
                                                    echo $incQty . ",";
                                                }
                                                ?>],
                                        //backgroundColor: fillPattern
                                    }]
                                }
                            });
                        </script>
                        <?php

                        $mbl = 0;
                        $lap = 0;
                        $pc = 0;
                        $gpu = 0;



                        $sellData = Database::s("SELECT * FROM `invoice`");
                        $sellDataNr = $sellData->num_rows;

                        for ($i = 0; $i < $sellDataNr; $i++) {
                            $sellDataX = $sellData->fetch_assoc();
                            $prodId = $sellDataX["product_id"];
                            //echo $prodId."<br>";

                            $catidS = Database::s("SELECT * FROM `product` WHERE `id` ='" . $prodId . "' ");
                            $catidSData = $catidS->fetch_assoc();
                            $catIdX = (int)$catidSData["catagory_id"];
                            //echo $catIdX."<br>";

                            if ($catIdX == 1) {
                                $mbl = $mbl + $sellDataX["qty"];
                            } else if ($catIdX == 2) {
                                $lap = $lap + $sellDataX["qty"];
                            } else if ($catIdX == 3) {
                                $pc = $pc + $sellDataX["qty"];
                            } else if ($catIdX == 4) {
                                $gpu = $gpu + $sellDataX["qty"];
                            }
                        }


                        ?>



                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="text-primary fw-bold m-0">Sales for Featured Catgory from all sellings</h6>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="small fw-bold">Laptops<span class="float-end"><?php echo ($lap / $totalSellings) * 100 ?>%</span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-danger" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($lap / $totalSellings) * 100 ?>%;"><span class="visually-hidden"><?php echo ($lap / $totalSellings) * 100 ?></span></div>
                                        </div>
                                        <h4 class="small fw-bold">GPUS<span class="float-end"><?php echo ($gpu / $totalSellings) * 100 ?>%</span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($gpu / $totalSellings) * 100 ?>%;"><span class="visually-hidden"><?php echo ($gpu / $totalSellings) * 100 ?>%</span></div>
                                        </div>
                                        <h4 class="small fw-bold">PCs<span class="float-end"><?php echo ($pc / $totalSellings) * 100 ?>%</span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-primary" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($pc / $totalSellings) * 100 ?>%;"><span class="visually-hidden">60%</span></div>
                                        </div>
                                        <h4 class="small fw-bold">Mobile phones<span class="float-end"><?php echo ($mbl / $totalSellings) * 100 ?>%</span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-info" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($mbl / $totalSellings) * 100 ?>%;"><span class="visually-hidden">80%</span></div>
                                        </div>

                                    </div>
                                </div>

                                


                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="text-primary fw-bold m-0">Requested Products</h6>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <?php

                                            $reqS = Database::s("SELECT * FROM `req`");
                                            $reqNr = $reqS->num_rows;

                                            for ($i = 0; $i < $reqNr; $i++) {
                                                # code...

                                                $reqData =  $reqS->fetch_assoc();
                                                $reqDate = $reqData["date"];
                                                $splitReqDate = explode(" ", $reqDate);
                                                $date1 = $splitReqDate[0];



                                            ?>

                                                <?php

                                                $prod = Database::s("SELECT * FROM `product` WHERE `id`='" . $reqData["product_id"] . "';");
                                                $srow = $prod->fetch_assoc();

                                                $productimg = Database::s("SELECT * FROM `image` WHERE `product_id`='" . $srow["id"] . "' ");
                                                $icode = $productimg->fetch_assoc();


                                                ?>

                                                <div class="row align-items-center no-gutters">
                                                    <div class="col me-2">
                                                        <h6 class="mb-0"><strong>Product <?php echo $reqData["product_id"] ?> From User: <?php echo $reqData["user"] ?></strong></h6><span class="text-xs"><?php echo $reqData["date"] ?></span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button class="btn btn-link" onclick="singleviewmodal('<?php echo $srow['id']; ?>');">View</button>
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

                                        </li>

                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-6 mt-3 mb-3 rounded bg-light border border-2 border-secondary" >
                                    <div class="row g-1">
                                        <?php

                                        $freq = Database::s("SELECT `product_id`, COUNT(`product_id`) AS `value_occurrence` FROM `invoice` WHERE `date` LIKE '%" . $day1 . "%' GROUP BY `product_id` ORDER BY `value_occurrence` DESC LIMIT 1");

                                        $freqnum = $freq->num_rows;

                                        if ($freqnum > 0) {
                                            for ($z = 0; $z < $freqnum; $z++) {
                                                $freqrow = $freq->fetch_assoc();
                                            }

                                        ?>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-4 fw-bold">Mostly Sold Item</label>
                                            </div>
                                            <?php

                                            $proimg = Database::s("SELECT * FROM `image` WHERE `product_id`='" .  $freqrow["product_id"] . "' ");
                                            $code = $proimg->fetch_assoc();

                                            $productDeatails = Database::s("SELECT * FROM `product` WHERE `id`='" .  $freqrow["product_id"] . "' ");
                                            $pdeatails = $productDeatails->fetch_assoc();

                                            $qtyrs = Database::s("SELECT SUM(`qty`) AS total FROM invoice WHERE `product_id`='" .  $freqrow["product_id"] . "' AND `date` LIKE '%" . $day1 . "%'; ");
                                            $qtytotal = $qtyrs->fetch_assoc();

                                            ?>

                                            <div class="col-12 text-center">
                                                <img src="<?php echo $code["code"]; ?>" class="img-fluid rounded-top" style="height: 250px;" />
                                                <hr />
                                            </div>

                                            <div class="col-12 text-center">
                                                <span class="fs-5 fw-bold"><?php echo $pdeatails["title"]; ?></span>
                                                <br />
                                                <span class="fs-6"><?php echo $qtytotal["total"]; ?> Items</span>
                                                <br />
                                                <span class="fs-6">Rs.<?php echo $pdeatails["price"]; ?>.00</span>
                                            </div>

                                            <div class="col-12">
                                                <div class="row justify-content-center">
                                                    <img src="resources/firstPlace.png" alt="" class="col-4">
                                                </div>

                                            </div>

                                        <?php
                                        } else {
                                        ?>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-4 fw-bold">Mostly Sold Item</label>
                                            </div>
                                            <hr />
                                            <div class="col-12">
                                                <img src="resources/211634_camera_icon (2).png" class="img-fluid rounded-top col-12"  />
                                            </div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-4 fw-bold">No Sellengs for today Untill now</label>
                                            </div>
                                        <?php
                                        }
                                        ?>


                                    </div>
                                </div>

                            <?php


                            ?>

                            <div class="col d-none">
                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <div class="card textwhite bg-primary text-white shadow">
                                            <div class="card-body">
                                                <p class="m-0">Primary</p>
                                                <p class="text-white-50 small m-0">#4e73df</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="card textwhite bg-success text-white shadow">
                                            <div class="card-body">
                                                <p class="m-0">Success</p>
                                                <p class="text-white-50 small m-0">#1cc88a</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="card textwhite bg-info text-white shadow">
                                            <div class="card-body">
                                                <p class="m-0">Info</p>
                                                <p class="text-white-50 small m-0">#36b9cc</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="card textwhite bg-warning text-white shadow">
                                            <div class="card-body">
                                                <p class="m-0">Warning</p>
                                                <p class="text-white-50 small m-0">#f6c23e</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="card textwhite bg-danger text-white shadow">
                                            <div class="card-body">
                                                <p class="m-0">Danger</p>
                                                <p class="text-white-50 small m-0">#e74a3b</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="card textwhite bg-secondary text-white shadow">
                                            <div class="card-body">
                                                <p class="m-0">Secondary</p>
                                                <p class="text-white-50 small m-0">#858796</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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