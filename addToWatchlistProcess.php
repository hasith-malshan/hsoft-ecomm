<?php

session_start();

if (isset($_SESSION["u"])) {
    $uemail = $_SESSION["u"]["email"];

    require "connection.php";

    // if (isset($_GET["id"])) {
    //   echo $_GET["id"];
    // }


    $pId = $_GET["id"];

    $alreadyAddedCheck = Database::s("SELECT * FROM `watchlist` WHERE `product_id` = '" . $pId . "' AND `user_email` = '" . $uemail . "';");
    $alreadyAddedChechkNr = $alreadyAddedCheck->num_rows;

    //echo $alreadyAddedChechkNr;

    if ($alreadyAddedChechkNr == 0) {
        $insetitem = Database::iud("INSERT INTO `watchlist`(`product_id`,`user_email`) VALUES('" . $pId . "','" . $uemail . "');");
        echo "000";
    } else {
        echo "already added";
    }

}else{
echo "001";
}
?>