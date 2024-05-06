<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $order_id = $_POST["order_id"];
    $email = $_POST["email"];
    //$total1 = $_POST["total"];
    $prod = $_POST["prod"];
    $prodQty = $_POST["prodQty"];

    //echo $order_id;
    //echo $total;
    //echo $email;
    //echo $prod;
    //echo $prodQty;

    $splitId = explode(",", $prod);
    $size = sizeof($splitId);

    $splitQty = explode(",", $prodQty);
    $size1 = sizeof($splitQty);

    for ($i = 0; $i < $size; $i++) {

        $pid = $splitId[$i];
        //echo $pid;

        $productS = Database::s("SELECT * FROM `product` WHERE `id`= '" . $pid . "' ;");
        //$productSNr = $productS->num_rows;

        $productSD = $productS->fetch_assoc();
        $qty = $productSD["qty"];
        $newQty = $qty - $splitQty[$i];

        Database::iud("UPDATE `product` SET `qty`='" . $newQty . "' WHERE `id`='" . $pid . "' ");


        //Save Bill
        $cityS = Database::s("SELECT * FROM `user_has_address` WHERE `user_email`='" . $_SESSION["u"]["email"] . "' ;");
        $citySNr = $cityS->num_rows;

        $total = 0;
        $dilivery = 0;

        if ($citySNr == 1) {

            $citySD = $cityS->fetch_assoc();
            $cityId = $citySD["city_id"];

            $districtS = Database::s("SELECT * FROM `city` WHERE `id`='" . $cityId . "' ;");
            $districtSD = $districtS->fetch_assoc();
            $districtId = $districtSD["district_id"];

            $districtNameS = Database::s("SELECT * FROM `district` WHERE `id`='" . $districtId . "' ;");
            $districtNameSD = $districtNameS->fetch_assoc();

            if ($districtId == 1) {
                $dilivery = $productSD["dic"];
            } else {
                $dilivery = $productSD["doc"];
            }

            $total = $productSD["price"] * $splitQty[$i] + $dilivery;
        }

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `invoice` (`order_id`,`product_id`,`user_email`,`date`,`qty`,`total`) VALUES ('" . $order_id . "','" . $pid . "','" . $email . "','" . $date . "','" . $splitQty[$i] . "','" . $total . "')");
        Database::iud("DELETE FROM `cart` WHERE `user_email`='".$email."' ;");
        
    }
    echo "000";
}
