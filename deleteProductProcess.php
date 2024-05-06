<?php

require "connection.php";

$pid = $_GET["id"];
echo $pid."hii";

$product = Database::s("SELECT * FROM `product` WHERE `id`='".$pid."' ;");
$pn = $product->num_rows;

if ($pn==1) {
   //Database::iud("DELETE FROM `image` WHERE `product_id`='".$pid."' ;");

   //Database::iud("DELETE FROM `product` WHERE `id`='".$pid."' ;");

   echo "success";

}else{
echo "Product Does nt Exist";

}    

;