<?php

session_start();

require "connection.php";


if (isset($_SESSION["u"])) {

    $pid = $_GET["id"];
    $qty  = $_GET["qty"];
    $userEmail = $_SESSION["u"]["email"];

    $array;

    $orderID = uniqid();

    $productS = Database::s("SELECT * FROM `product` WHERE `id`= '" . $pid . "' ;");
    $productSNr = $productS->num_rows;

    if ($productSNr == 1) {
        $productSD = $productS->fetch_assoc();



        $cityS = Database::s("SELECT * FROM `user_has_address` WHERE `user_email`='" . $userEmail . "' ;");
        $citySNr = $cityS->num_rows;

        if ($citySNr == 1) {

            $citySD = $cityS->fetch_assoc();
            $cityId = $citySD["city_id"];

            $districtS = Database::s("SELECT * FROM `city` WHERE `id`='" . $cityId . "' ;");
            $districtSD = $districtS->fetch_assoc();
            $districtId = $districtSD["district_id"];

            $districtNameS = Database::s("SELECT * FROM `district` WHERE `id`='" . $districtId . "' ;");
            $districtNameSD = $districtNameS->fetch_assoc();

            $dilivery = 0;

            if ($districtId == "1") {
                $dilivery = $productSD["dic"];
            } else {
                $dilivery = $productSD["doc"];
            }

            $item = $productSD["title"];
            $amount = $productSD["price"] * $qty + $dilivery;

            $fname = $_SESSION["u"]["fname"];
            $lname = $_SESSION["u"]["lname"];
            $mobile = $_SESSION["u"]["mobile"];
            $address = $citySD["line1"] . "," . $citySD["line1"];
            $districtName = $districtNameSD["name"];

            $array['id'] = $orderID;
            $array['item'] = $item;
            $array['amount'] = $amount;
            $array['fname'] = $fname;
            $array['lname'] = $lname;
            $array['email'] = $userEmail;
            $array['mobile'] = $mobile;
            $array['address'] = $address;
            $array['districtName'] = $districtName;

            echo json_encode($array);
           

        } else {
            echo "002";
        }
    }
} else {
    echo "x0x";
}
