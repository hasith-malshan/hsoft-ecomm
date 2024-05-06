<?php
require "connection.php";
$pid = $_GET["id"];

Database::iud("DELETE FROM `watchlist` WHERE `product_id`='".$pid."' ;");
echo "000";


?>