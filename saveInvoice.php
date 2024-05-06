<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $order_id = $_POST["order_id"];
    $pid = $_POST["pid"];
    $email = $_POST["email"];
    $total = $_POST["total"];
    $qty1 = $_POST["qty"];

    $productS = Database::s("SELECT * FROM `product` WHERE `id`= '" . $pid . "' ;");
    //$productSNr = $productS->num_rows;
    $productSD = $productS->fetch_assoc();

    $qty = $productSD["qty"];
    $newQty = $qty - $qty1;

    Database::iud("UPDATE `product` SET `qty`='" . $newQty . "' WHERE `id`='" . $pid . "' ");

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice` (`order_id`,`product_id`,`user_email`,`date`,`qty`,`total`) VALUES ('" . $order_id . "','" . $pid . "','" . $email . "','" . $date . "','" . $qty1 . "','" . $total . "')");

    echo "000";

}
