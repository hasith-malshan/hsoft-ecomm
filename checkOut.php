<?php
session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $idArr = $_POST['idx'];
    $qtyArr = $_POST['qtyx'];
    $userEmail = $_SESSION["u"]["email"];

    $splitId = explode(",", $idArr);
    $size = sizeof($splitId);

    $splitQty = explode(",", $qtyArr);
    $size1 = sizeof($splitQty);

    $billId = uniqid();

    $total = 0;
    $dilivery = 0;
    $total_dilivery = 0;

    $cityS = Database::s("SELECT * FROM `user_has_address` WHERE `user_email`='" . $userEmail . "' ;");
    $citySNr = $cityS->num_rows;

    if ($citySNr == 1) {

        for ($i = 0; $i < $size; $i++) {
            $id = $splitId[$i];
            $qty = $splitQty[$i];

            Database::iud("UPDATE `cart` SET `qty`='".$qty."' WHERE `product_id`='".$id."' AND  `user_email`='".$userEmail."';");

            $data = Database::s("SELECT * FROM `product` WHERE `id`='" . $id . "' ");

            if ($data->num_rows == 1) {
                $productSD = $data->fetch_assoc();

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

                    if ($districtId == 1) {
                        $dilivery = $productSD["dic"];
                    } else {
                        $dilivery = $productSD["doc"];
                    }
                }
                $total_dilivery = $total_dilivery + $dilivery;
                $total = ($productSD["price"] * $qty) + $total + $dilivery;
            }
        }

        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $mobile = $_SESSION["u"]["mobile"];
        $address = $citySD["line1"] . "," . $citySD["line1"];
        $districtName = $districtNameSD["name"];

        $array['id'] = $billId;
        $array['item'] = "Bill No :" . $billId . " for " . $fname . " " . $lname;
        $array['amount'] = $total;
        $array['fname'] = $fname;
        $array['lname'] = $lname;
        $array['email'] = $userEmail;
        $array['mobile'] = $mobile;
        $array['address'] = $address;
        $array['districtName'] = $districtName;
        $array['prods'] = $idArr;
        $array['prodQty'] = $qtyArr;

        echo json_encode($array);
    }else{
        echo "001";
    }

} else {
    echo "0X0";
}
