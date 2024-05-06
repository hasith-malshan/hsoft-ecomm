<?php
session_start();

require "connection.php";

$pid = $_GET["id"];
$rate =  $_GET["r"];
$uid = $_SESSION["u"]["email"];

//echo $pid;
//echo $rate;
//echo $uid;

$alreadycheck = Database::s("SELECT * FROM `rate` WHERE `pid`='".$pid."' AND `uid`='".$uid."' ");

if ($alreadycheck->num_rows > 0) {
    Database::iud("UPDATE `rate` SET `rate`='".$rate."' WHERE `pid`='".$pid."' AND `uid`='".$uid."'");
   echo "001";
}else{

    Database::iud("INSERT INTO `rate`(`pid`,`uid`,`rate`) VALUES('".$pid."','".$uid."','".$rate."'); ");
    echo "000";
}



?>