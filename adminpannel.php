<?php

session_start();
require "connection.php";

$Admintest = Database::s("SELECT * FROM `ADMIN` WHERE `lname`='Admin2'; ");
$_SESSION["a"] = $Admintest->fetch_assoc();

if (isset($_SESSION["a"])) {
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eshop | Admin Pannel</title>
        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-lg-2 border-start-0 border-end border-success border-2">
                    <div class="row">

                        <div class="col-12 mt-5">
                            <h4 class="text-success fs-1 fw-bold text-center"><?php echo $_SESSION["a"]["fname"] . " " . $_SESSION["a"]["lname"]; ?></h4>
                            <hr class="border border-1 border-white">
                        </div>

                        <div class="d-flex align-items-start col-12">


                            <div class="col-12 ">
                                <div class="row dashItem">
                                    <div class="col-1 bottom text-end"><i class=" bi bi-ui-checks-grid fs-2"></i></div>
                                    <div class="col-10"> <a class="nav-link fw-bold fs-4 dashtext" aria-current="page" href="#">Dashboard</a></div>
                                </div>

                                <div class="row dashItem">
                                    <div class="col-1 bottom text-end"><i class=" bi bi-people fs-2"></i></div>
                                    <div class="col-10"> <a class="nav-link fw-bold fs-4 dashtext" href="manageUsers.php">Manage Users</a></div>
                                </div>
                                <div class="row dashItem">
                                    <div class="col-1 bottom text-end"><i class=" bi bi-pencil-square fs-2"></i></div>
                                    <div class="col-10"> <a class="nav-link fw-bold fs-4 dashtext" href="manageProducts.php">Manage Products</a></div>
                                </div>
                                <div class="row dashItem">
                                    <div class="col-1 bottom text-end"><i class=" bi bi-plus-square fs-2"></i></div>
                                    <div class="col-10"> <a class="nav-link fw-bold fs-4 dashtext" href="add_product.php">Add Products</a></div>
                                </div>

                                <div class="row  dashItem">
                                    <div class="col-1 bottom text-end"><i class=" bi bi-recycle fs-2"></i></div>
                                    <div class="col-10"> <a class="nav-link fw-bold fs-4 dashtext" href="sellerProductView.php">Update Products</a></div>
                                </div>

                            </div>


                        </div>

                        <div class="col-12 mt-3">

                            <h4 class="text-white text-center"><a href="sellinghistory.php" class="text-decoration-none"><span class="text-success fs-1 fw-bold">Selling History</span></a></h4>

                        </div>

                        <div class="col-12 mt-2 d-grid">
                            <label for="" class="form-label text-center ">From Date</label>
                            <input type="date" class="form-control" id="fromdate">

                            <label for="" class="form-label text-center mt-2">To Date</label>
                            <input type="date" class="form-control" id="todate">

                            <button class="btn btn-primary mt-3" onclick="dailyselling();">Search</button>

                            <hr class="border border-1 border-white">

                        </div>

                    </div>
                </div>



                <div class="col-12 col-lg-10">

                    <?php

                    $dateStart = new DateTime("2021-10-01 00:00:00");
                    $tdate = new DateTime();
                    $tz = new DateTimeZone("Asia/Colombo");
                    $tdate->setTimezone($tz);
                    $endDate = new DateTime($tdate->format("Y-m-d H:i:s"));
                    $difference = $endDate->diff($dateStart);

                    ?>
                    <div class="col-12 bg-dark text-white text-center">
                        <label for="" class="fs-4">HSOFT active Time &nbsp;&nbsp; <span class="text-success">

                                <?php

                                echo $difference->format('%Y') . "Years " . $difference->format('%m') . "Months " .
                                    $difference->format('%d') . "Days " . $difference->format('%H') . "Hours " . $difference->format('%i') . "Minutes "
                                    . $difference->format('%s') . "Secons "

                                ?>

                            </span></label>
                    </div>
                    <div class="row gy-2 gx-2">
                        <div class="col-12 mt-3 mb-3 text-white">
                            <h2 class="fw-bold">Dashboard</h2>
                            <hr class="border border-1 border-dark">
                        </div>
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

                        <div class="col-12 col-lg-4 px-1">
                            <div class="row g-1">
                                <div class="col-12 rounded sum_div sum_div1" style="height: 100px;">

                                    <div class="row">
                                        <div class="col-9">
                                            <span class="fs-1">LKR <?php echo $DailyEarnings; ?></span>
                                            <br /><span class="fs-6">Daily Earnings</span>
                                            <br />
                                        </div>
                                        <div class="col-3 text-center"><img src="resources/6617668_earning_finance_growth_money_profit_icon (1).png" alt="" class="col-9 py-3"></div>

                                    </div>

                                </div>


                            </div>
                        </div>

                        <div class="col-12 col-lg-4 px-1">
                            <div class="row g-1">

                                <div class="col-12 rounded sum_div sum_div2" style="height: 100px;">

                                    <div class="row">
                                        <div class="col-9">
                                            <span class="fs-1">LKR <?php echo $MonthlyEarnings; ?></span>
                                            <br />
                                            <span class="fs-6">Monthly Earnings</span>
                                            <br />

                                        </div>
                                        <div class="col-3 text-center"><img src="resources/6617668_earning_finance_growth_money_profit_icon (1).png" alt="" class="col-9 mt-2 mb-2"></div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <?php

                        $usersrs = Database::s("SELECT * FROM `user`");
                        $un = $usersrs->num_rows;

                        ?>
                        <div class="col-12 col-lg-4 px-1">
                            <div class="row g-1">

                                <div class="col-12  rounded sum_div sum_div3" style="height: 100px;">
                                    <div class="row">
                                        <div class="col-9">
                                            <span class="fs-1"><?php echo $un ?></span><br />
                                            <span class="fs-6">Total Engagements</span>
                                            <br />

                                        </div>
                                        <div class="col-3 text-center py-2"><img src="resources/4243325_users_people_icon.png" alt="" class="col-9 mt-2 mb-2"></div>
                                    </div>

                                </div>


                            </div>
                        </div>

                        <div class="col-12 col-lg-4 px-1">
                            <div class="row g-1">

                                <div class="col-12    rounded sum_div sum_div4" style="height: 100px;">
                                    <div class="row">
                                        <div class="col-9">
                                            <span class="fs-1"><?php echo $todaySellings; ?> Items </span><br />
                                            <span class="fs-6">Today Sellings</span>
                                            <br />

                                        </div>
                                        <div class="col-3 text-center"><img src="resources/877015_basket_cart_purchase_shop_shopping_icon (1).png" alt="" class="col-9 mt-2 mb-2"></div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="col-12 col-lg-4 px-1">
                            <div class="row g-1">

                                <div class="col-12 rounded sum_div sum_div5" style="height: 100px;">

                                    <div class="row">
                                        <div class="col-9">
                                            <span class="fs-1"><?php echo $monthlySellings; ?> Items</span><br />
                                            <span class="fs-6 fw-bold">Monthly Sellings</span>
                                            <br />

                                        </div>
                                        <div class="col-3 text-center"><img src="resources/877015_basket_cart_purchase_shop_shopping_icon (1).png" alt="" class="col-9 mt-2 mb-2"></div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="col-12 col-lg-4 px-1">
                            <div class="row g-1">

                                <div class="col-12 rounded sum_div sum_div6" style="height: 100px;">
                                    <div class="row">
                                        <div class="col-9">
                                            <span class="fs-1"><?php echo $totalSellings; ?> Items</span><br />
                                            <span class="fs-6 fw-bold">Total Sellings</span>
                                            <br />

                                        </div>
                                        <div class="col-3 text-center"><img src="resources/877015_basket_cart_purchase_shop_shopping_icon (1).png" alt="" class="col-9 mt-2 mb-2"></div>
                                    </div>

                                </div>

                            </div>
                        </div>








                        <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light border border-2 border-secondary" style="height: 600px;">
                            <div class="row g-1">
                                <?php

                                $freq = Database::s("SELECT `product_id`, COUNT(`product_id`) AS `value_occurrence` FROM `invoice` WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurrence` DESC LIMIT 1");

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

                                    $qtyrs = Database::s("SELECT SUM(`qty`) AS total FROM invoice WHERE `product_id`='" .  $freqrow["product_id"] . "' AND `date` LIKE '%" . $today . "%'; ");
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
                                        <img src="resources/211634_camera_icon (2).png" class="img-fluid rounded-top" style="height: 250px;margin-left: 120px;" />
                                    </div>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold">No Sellengs for today Untill now</label>
                                    </div>
                                <?php
                                }
                                ?>


                            </div>
                        </div>

                        <div class="col-12 col-lg-6 ">
                            <div class="row justify-content-center mb-5 ">
                                <div class="col-12">
                                    <h1 class="text-center">Requested Products</h1>
                                </div>
                                <div class="col-12 col-lg-10 tblBOx" style="height: 600px;">
                                    <table class="table table-dark">
                                        <thead>
                                            <tr class="">
                                                <th scope="col-2">Date</th>
                                                <th scope="col-2">Product ID</th>
                                                <th scope="col-8">User ID</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php

                                            $reqS = Database::s("SELECT * FROM `req`");
                                            $reqNr = $reqS->num_rows;

                                            for ($i = 0; $i < $reqNr; $i++) {
                                                $reqData =  $reqS->fetch_assoc();
                                                $reqDate = $reqData["date"];
                                                $splitReqDate = explode(" ", $reqDate);
                                                $date1 = $splitReqDate[0];



                                            ?>
                                                <tr class="">
                                                    <td class="col-2"><?php echo $date1 ?></td>
                                                    <td class="col-2">
                                                        <div class="row">
                                                           
                                                            <div class="col-12 d-grid"><button class="btn btn-info"><?php echo $reqData["product_id"] ?></button></div>
                                                        </div>
                                                    </td>
                                                    <td class="col-8">
                                                        <div class="row">
                                                            
                                                            <div class="col-12 d-grid"><button class="btn btn-warning"><?php echo $reqData["user"] ?></button></div>
                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>






            </div>
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