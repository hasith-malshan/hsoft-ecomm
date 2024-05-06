<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $email =  $_SESSION["u"]["email"];

    $pid = $_GET["pid"];

    $stockS = Database::s("SELECT * FROM `product` WHERE `id`='" . $pid . "' ;");

    if ($stockS->num_rows == 1) {
        $stockData = $stockS->fetch_assoc();

        if ($stockData["qty"] == 0) {

            $alreadyAdedCheck = Database::s("SELECT * FROM `req` WHERE `product_id`='" . $pid . "' AND `user`='" . $email . "' ;");
            $alreadyAdedCheckNr = $alreadyAdedCheck->num_rows;

            if ($alreadyAdedCheckNr == 1) {
                echo "002";
                //echo "you have already reqested this Product";
            } else {
                $tdate = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $tdate->setTimezone($tz);
                $date = $tdate->format("Y-m-d H:i:s");

                Database::iud("INSERT INTO req(`product_id`,`user`,`date`) VALUES('" . $pid . "','" . $email . "','" . $date . "') ;");
                echo "000";
            }
        }
    } else {
        echo "001";
        //echo "This product is in stock you dont have to request it";
    }
}else{
    echo "00X";
}
