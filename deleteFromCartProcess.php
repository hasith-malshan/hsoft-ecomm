<?php
require "connection.php";
$id = $_GET["id"];

Database::iud("DELETE FROM `cart` WHERE `id`='".$id."' ;");
echo "000";


?>