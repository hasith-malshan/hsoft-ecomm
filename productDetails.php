<?php

require "connection.php";
$pid = $_GET["id"];

$productDesS= Database::s("SELECT * FROM `product` WHERE `id`='".$pid."';");

$productDesSNr = $productDesS->num_rows;

if ($productDesSNr == 1) {
    $productDesSD = $productDesS->fetch_assoc();
    echo $productDesSD["description"];
}

?>