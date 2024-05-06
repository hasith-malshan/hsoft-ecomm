<?php

session_start();

require "connection.php";

if(isset($_SESSION["u"] ) or isset($_SESSION["a"]) ){


    if(isset($_POST["ad"])) {
        $sender = $_SESSION["a"]["email"];
        } else {
        $sender = $_SESSION["u"]["email"];
        }

  

    // /$sender = $_SESSION["u"]["email"];
    $recever = $_POST["e"];
    $msg = $_POST["t"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    if(empty($msg)){
        echo "Please enter a message to send";
    }else{

        //echo $sender;
        //echo $recever;
        //echo $msg;
        //echo $date;

        Database::iud("INSERT INTO `chat` (`from`,`to`,`content`,`date`,`status_id`) VALUES ('".$sender."','".$recever."','".$msg."','".$date."','1')");
        echo "success";

    }

}else if(isset($_SESSION["a"])){

    $sender = $_SESSION["a"]["email"];
    $recever = $_POST["e"];
    $msg = $_POST["t"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    if(empty($msg)){
        echo "Please enter a message to send";
    }else{

        //echo $sender;
        //echo $recever;
        //echo $msg;
        //echo $date;

        Database::iud("INSERT INTO `chat_a` (`from`,`to`,`content`,`date`,`status_id`) VALUES ('".$sender."','".$recever."','".$msg."','".$date."','1')");
        echo "success";

    }

}
