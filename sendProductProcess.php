<?php

session_start();

require "connection.php";

$uid = $_SESSION["a"]["email"];

$id = $_GET["id"];
//echo $id;

$productS = Database::s("SELECT * FROM `product` WHERE `id`='".$id."' ;");
$productSNr = $productS -> num_rows;

if ($productSNr == 1 ) {
   $_SESSION["p"] = $productS->fetch_assoc();
   //echo $_SESSION["p"]["title"];
   echo "000";
}else{
    echo "There is no such a product";
}
