<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $mail = $_SESSION["u"]["email"];

    $invoicers = Database::s("SELECT * FROM `invoice` WHERE `user_email`='" . $mail . "' ");
    $in = $invoicers->num_rows;
?>


    <!DOCTYPE html>

    <html>

    <head>
        <title>Hsoft| My Purchase History</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg">
        <link rel="stylesheet" href="bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">

        
    </head>




    <body class="background_img1">
        <div class="container-fluid">
            <div class="row">
                <?php require "header.php"; ?>
            </div>

        </div>
        <div class="container-fluid">
            <div class="row">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Purchase History</li>
                    </ol>
                </nav>


                <div class="col-12 text-center mb-3">
                    <span class="fs-1 fw-bold text-primary">Purchase History</span>
                </div>

                <?php

                if ($in == 0) {
                ?>
                    <div class="col-12 text-center bg-light" style="height: 450px;">
                        <span class="fs-1 fw-bold text-black-50 d-block" style="margin-top: 200px;">You have no item in your Transaction history yet...</span>
                    </div>

                <?php
                } else {
                ?>
                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 d-none d-lg-block">
                                <div class="row">
                                    <div class="col-1 bg-light">
                                        <label class="form-label fw-bold">#</label>
                                    </div>
                                    <div class="col-3 bg-light text-center">
                                        <label class="form-label fw-bold">Order Details</label>
                                    </div>
                                    <div class="col-1 bg-light text-end">
                                        <label class="form-label fw-bold">Quantity</label>
                                    </div>
                                    <div class="col-2 bg-light text-end">
                                        <label class="form-label fw-bold">Amount</label>
                                    </div>
                                    <div class="col-2 bg-light text-end">
                                        <label class="form-label fw-bold">Purchased Date & Time</label>
                                    </div>
                                    <div class="col-3 bg-light text-end"></div>
                                    <div class="col-12">
                                        <hr />
                                    </div>
                                </div>
                            </div>

                            <?php
                            for ($i = 0; $i < $in; $i++) {
                                $ir = $invoicers->fetch_assoc();
                            ?>

                                <div class="col-12 shadow">
                                    <div class="row shadow-lg">
                                        <div class="col-12 col-lg-1 bg-info text-center">
                                            <label class="form-label text-label text-white fs-6 fw-bold"><?php echo $ir["order_id"] ?></label>
                                        </div>
                                        <div class="col-12 col-lg-3 bg-white">
                                            <div class="row ">
                                                <div class="card">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">
                                                            <?php
                                                            $pid = $ir["product_id"];
                                                            $imagers = Database::s("SELECT * FROM `image` WHERE `product_id`='" . $pid . "' ");
                                                            $nrs = $imagers->fetch_assoc();
                                                            ?>
                                                            <img src="<?php echo $nrs["code"]; ?>" class="img-fluid rounded-start" alt="...">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body">
                                                                <?php
                                                                $productrs = Database::s("SELECT * FROM `product` WHERE `id`='" . $pid . "' ");
                                                                $pr = $productrs->fetch_assoc();

                                                                /*$puser = Database::s("SELECT * FROM `user` WHERE `email`='" . $pr["user_email"] . "' ");
                                                                $urs = $puser->fetch_assoc();*/
                                                                ?>
                                                                <h5 class="card-title"><?php echo $pr["title"]; ?></h5>

                                                                <p class="card-text"><b>Price :</b> Rs. <?php echo $pr["price"]; ?> .00</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-1 text-start text-lg-end text-center bg-primary">
                                            <label class="form-label fs-4 pt-5"><?php echo $ir["qty"] ?></label>
                                        </div>

                                        <div class="col-12 col-lg-2 text-start text-lg-end bg-info text-center">
                                            <label class="form-label fs-5 px-3 py-5 fw-bold">Rs <?php echo $ir["total"] ?> .00</label>
                                        </div>

                                        <div class="col-12 col-lg-2 text-start text-lg-end text-center bg-primary">
                                            <label class="form-label fs-4 pt-5"><?php echo $ir["date"] ?></label>
                                        </div>

                                        <div class="col-12 col-lg-3 bg-info">
                                            <div class="row">
                                                <div class="col-6 d-grid">
                                                    <button class="btn btn-secondary rounded border border-1 border-primary mt-5 fs-5" onclick="addFeedback(<?php echo $pid; ?>);"><i class="bi bi-info-circle-fill"></i> Feedback</button>
                                                </div>
                                                <div class="col-6 d-grid">
                                                    <button class="btn btn-danger rounded mt-5 fs-5" onclick="rate(<?php echo $ir['product_id'] ?>)"><i class="bi bi-star"></i> Rate Product</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <hr />
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="feedbackModal<?php echo $pid; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $pr["title"]; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <textarea id="feedtxt" cols="30" rows="10" class="form-control fs-5"></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary" onclick="saveFeedback(<?php echo $pid; ?>);">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        

                                        <!-- Modal -->
                                        <div class="modal fade" id="ratemodal<?php echo $pid; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">rate <?php echo $pr["title"]; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <i class="bi bi-star-fill me-2 fs-1 <?php echo $strC1?>" id="st1<?php echo $pid; ?>" onclick="saverate(1,<?php echo $pid ?>)" onmouseover="colorStar(1,<?php echo $pid ?>);" onmouseout="resetstar(1,<?php echo $pid ?>)" data-bs-toggle="tooltip" data-bs-placement="top" title="rate 1 star"></i>
                                                                <i class="bi bi-star-fill me-2 fs-1 <?php echo $strC2?>" id="st2<?php echo $pid; ?>" onclick="saverate(2,<?php echo $pid ?>)" onmouseover="colorStar(2,<?php echo $pid ?>);" onmouseout="resetstar(2,<?php echo $pid ?>)" data-bs-toggle="tooltip" data-bs-placement="top" title="rate 2 star"></i>
                                                                <i class="bi bi-star-fill me-2 fs-1 <?php echo $strC3?>" id="st3<?php echo $pid; ?>" onclick="saverate(3,<?php echo $pid ?>)" onmouseover="colorStar(3,<?php echo $pid ?>);" onmouseout="resetstar(3,<?php echo $pid ?>)" data-bs-toggle="tooltip" data-bs-placement="top" title="rate 3 star"></i>
                                                                <i class="bi bi-star-fill me-2 fs-1 <?php echo $strC4?>" id="st4<?php echo $pid; ?>" onclick="saverate(4,<?php echo $pid ?>)" onmouseover="colorStar(4,<?php echo $pid ?>);" onmouseout="resetstar(4,<?php echo $pid ?>)" data-bs-toggle="tooltip" data-bs-placement="top" title="rate 4 star"></i>
                                                                <i class="bi bi-star-fill me-2 fs-1 <?php echo $strC5?>" id="st5<?php echo $pid; ?>" onclick="saverate(5,<?php echo $pid ?>)" onmouseover="colorStar(5,<?php echo $pid ?>);" onmouseout="resetstar(5,<?php echo $pid ?>)" data-bs-toggle="tooltip" data-bs-placement="top" title="rate 5 star"></i>
                                                                <br />
                                                                <p>select Number of starts to rate</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal -->

                                        </div>
                                    </div>
                                </div>
                        </div>


                    <?php
                            }
                    ?>

                    <div class="col-12">
                        <hr />
                    </div>

                    <div class="col-12 mb-3 d-none">
                        <div class="row">
                            <div class="col-lg-10 d-none d-lg-block"></div>
                            <div class="col-lg-2 col-12 d-grid">
                                <button class="btn btn-danger fs-4"><i class="bi bi-trash-fill"></i> Clear All Records</button>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>



                    </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <?php require "footer.php"; ?>
                </div>

            </div>

            <script src="bootstrap.bundle.js"></script>
            <script>
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                })
            </script>

            <script src="script,.js"></script>
            <script src="bootstrap.js"></script>
    </body>

    </html>

<?php
}
?>