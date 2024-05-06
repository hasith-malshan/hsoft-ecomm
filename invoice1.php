<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $user_Email = $_SESSION["u"]["email"];
    $oid = $_GET["id"];
   
    //echo $user_Email;
    //echo $oid;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eshop | Invoice</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="style.css" />
</head>

<body class="mt-2 background_img1">


    <style>
        span,
        td,
        th {
            color: white;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <?php
            require "header.php"
            ?>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <hr />
            </div>




            <div class="col-12 btn-toolbar justify-content-between justify-content-lg-end">
                <button class="btn btn-dark me-2 col-5 col-lg-1" onclick="printDiv()"><i class="bi bi-printer-fill"></i> &nbsp; Print</button>
                <button class="btn btn-danger col-5 col-lg-1"><i class="bi bi-file-earmark-pdf-fill"></i> &nbsp;Save As PDF</button>

            </div>

            <div class="col-12">
                <hr />
            </div>
            <?php

            $addressS = Database::s("SELECT * FROM `user_has_address` WHERE `user_email`='" . $user_Email . "';");
            $addressSNr = $addressS->num_rows;
            if ($addressSNr == 1) {
                $addressD = $addressS->fetch_assoc();
            }

            ?>

            <!-- </div> test -->
            <div class="col-12" id="GFG">
                <div class="row">
                    <link rel="icon" href="resources/logo.svg" />
                    <link rel="stylesheet" href="bootstrap.min.css" />
                    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

                    <link rel="stylesheet" href="style.css" />
                    <div class="col-12">
                        <div class="row px-2">
                            <div class="col-6 ">
                                <img src="resources/HSOFT-logos_whiteX.png" alt="" class="col-2">
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12 text-end text-primary">
                                        <h2><a href="">eShop</a></h2>
                                    </div>

                                    <div class="col-12 text-end fw-bold">
                                        <span>Maradana, Colombo 10, Srilanka</span><br />
                                        <span>+9412345678</span><br />
                                        <span> eshop@gmail.com</span>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <?php 
                    $invoiceS = Database::s("SELECT * FROM `invoice` WHERE `order_id`='6182c0f9b8f07'");
                    $invoiceSNr = $invoiceS->num_rows;
                    $invoiceSD = $invoiceS->fetch_assoc();

                  

                    ?>

                    <div class="col-12">
                        <hr class="bg-primary" style="height: 3px;" />
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="text-white">INVOICE TO : </h5>
                                <h2 class="text-white"><?php echo $_SESSION["u"]["fname"] ?> &nbsp;<?php echo $_SESSION["u"]["lname"] ?></h2>
                                <span class="fw-bold"><?php echo $addressD["line1"] . "," . $addressD["line2"] ?></span><br />
                                <span class="fw-bold text-decoration-underline text-primary"><?php echo $user_Email; ?></span>
                            </div>
                            <div class="col-6 text-end">
                                <h1 class="text-primary">Invoice Id : <?php echo $invoiceSD["id"] ?></h1>
                                <span class="fw-bold">Data and Time of Invoice :</span>&nbsp; <span class="fw-bold"><?php echo $invoiceSD["date"] ?></span>
                            </div>
                        </div>
                    </div>





                    <div class=" col-12 mt-2">
                        <table class="table">
                            <thead>
                                <tr class="border border-1 border-white">
                                    <th>#</th>
                                    <th>Order Id and Product</th>
                                    <th class="text-end">Unit Price</th>
                                    <th class="text-end">Quantity</th>
                                    <th class="text-end">Total with Dilivery</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $gtotal = 0;

                                $invoiceS1 =  Database::s("SELECT * FROM `invoice` WHERE `order_id`='".$oid."' AND `user_email`='" . $user_Email . "' ;");
                                $invoiceS1Nr =  $invoiceS1->num_rows;
                                for ($i = 0; $i < $invoiceS1Nr; $i++) {
                                    $invoiceSD1 = $invoiceS1->fetch_assoc();
                                    $productS = Database::s("SELECT * FROM `product` WHERE `id`='" . $invoiceSD1["product_id"] . "' ;");
                                    $productSNr = $productS->num_rows;
                                    if ($productSNr == 1) {
                                        $productSD = $productS->fetch_assoc();
                                    }

                                ?>
                                    <tr style="height: 70px;">
                                        <td class="bg-primary text-white fs-3">01</td>
                                        <td><a href="#" class="fs-6"><?php echo $invoiceSD1["order_id"]; ?></a><br />
                                            <a href="#" class="fs-6"><?php echo $productSD["title"]; ?></a>
                                        </td>
                                        <td class="fs-6 text-end pt-3 bg-primary">Rs <?php echo $productSD["price"]; ?>.00</a></td>
                                        <td class="fs-6 text-end pt-3"><?php echo $invoiceSD1["qty"]; ?></td>
                                        <td class="fs-6 text-end pt-3 bg-primary text-white"> <span class="h2"> Rs. <?php echo $invoiceSD1["total"]; ?>.00</span> <br>
                                            <?php echo "(" . $productSD["price"] . "X" . $invoiceSD1["qty"] . ") + " . $invoiceSD1["total"] - $productSD["price"] * $invoiceSD1["qty"] ?></td>
                                    </tr>
                                <?php

                                $gtotal = $invoiceSD1["total"] + $gtotal;

                                }
                                ?>



                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="border-0"></td>
                                    <td colspan="2" class="fs-5 text-end">Subtotal</td>
                                    <td colspan="2" class="fs-5 text-end">Rs <?php echo $gtotal?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 "></td>
                                    <td colspan="2" class="fs-5 text-end border-primary">Discount</td>
                                    <td colspan="2" class="fs-5 text-end border-primary">00.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 "></td>
                                    <td colspan="2" class="fs-4 text-end border-primary text-uppercase text-primary">Grand Total</td>
                                    <td colspan="2" class="fs-4 text-end border-primary text-primary">Rs. <?php echo $gtotal; ?>.00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="col-4 text-center" style="margin-top: -100px; margin-bottom: 50px;">
                        <span class="fs-1">Thank You.!</span>
                    </div>

                    <div class="col-12 border border-start border-end-0 border-top-0 border-bottom-0 border-5 border-primary" style="background-color: #e7f2ff;">
                        <div class="row">
                            <div class="col-12 mt-3 mb-3">
                                <label for="" class="form-label fs-5 fw-bold">Notice :</label>
                                <label for="" class="form-label fs-5 ">Purchaced Items can return before 7 days of dilivery</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 my-3 text-center">
                        <div class="label text-white">Invoice is created on a coputer and valid without Signature and seal</div>
                    </div>

                    <div class="col-12">
                        <hr class="border-primary border-1 border" style="height: 3px;" />
                    </div>

                </div>
            </div>
            <!-- </div> test -->






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