<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
   
    $userEmail = $_SESSION["u"]["email"];

    $id = $_POST["id"];
    $txt = $_POST["txt"];

    $d= new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `feedback`(`user_email`,`product_id`,`feed`,`date`) VALUES('".$userEmail."','".$id."','".$txt."','".$date."');");
}

?>