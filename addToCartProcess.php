<?php
    session_start();
    require "connection.php";

    if(isset($_SESSION["u"])) {
        $id = $_GET["id"];
        $qty = $_GET["qtyTxt"];
        $uemail = $_SESSION["u"]["email"];

        if($qty==0) {
            echo "Please add a quantity.";
        } else {
            $rs_cart = Database::s("SELECT * FROM `cart` WHERE `product_id`='".$id."' AND `user_email`='".$uemail."';");
            $nr_cart = $rs_cart->num_rows;

            if($nr_cart==1) {
                echo "This product is already exists in your cart.";
            } else {

                $rs_pro = Database::s("SELECT `qty` FROM `product` WHERE  `id`='".$id."';");
                $pro = $rs_pro->fetch_assoc();

                if($pro["qty"] >= $qty) {
                    Database::iud("INSERT INTO `cart`(`product_id`,`user_email`,`qty`) VALUES('".$id."','".$uemail."','".$qty."');");
                    echo "000";
                } else {
                    if($pro["qty"]==0) {
                        echo "Sorry! There are no products what you find in our Stock.";
                    } else if($pro["qty"]==1) {
                        echo "Sorry! There are ".$pro["qty"]." product in our Stock. Please select a valid quantity.";
                    } else {
                        echo "Sorry! There are ".$pro["qty"]." products in our Stock. Please select a valid quantity.";
                    }
                }
            }
        }
    }else{
      echo "00X";
    }
?>