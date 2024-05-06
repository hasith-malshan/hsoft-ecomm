<?php

require "connection.php";



if (isset($_GET["id"])) {
    $id = $_GET["id"];

    if(empty($id)){
        echo "please Enter the product Id";
    }else{
        $productS = Database::s("SELECT * FROM `product` WHERE `id`='".$id."' ;");
        $productSNr = $productS->num_rows;

        if ($productSNr == 1) {

           $productD = $productS->fetch_assoc();
           $array["id"]= $productD["id"];
           $array["title"]= $productD["title"];


           $catagory_idS = Database::s("SELECT * FROM `catagory` WHERE `id`= '".$productD["catagory_id"]."'; ");
           if ($catagory_idS -> num_rows == 1) {

              $catagory_idD= $catagory_idS->fetch_assoc();
              $array["catagory"]= $catagory_idD["name"];

           }

           /*$brand_idS = Database::s("SELECT * FROM `brand` WHERE `id`= '".$productD["catagory_id"]."'; ");
           if ($catagory_idS -> num_rows == 1) {

              $catagory_idD= $catagory_idS->fetch_assoc();
              $array["catagory"]= $catagory_idD["name"];

           }

           $modle_idS = Database::s("SELECT * FROM `brand` WHERE `id`= '".$productD["catagory_id"]."'; ");
           if ($catagory_idS -> num_rows == 1) {

              $catagory_idD= $catagory_idS->fetch_assoc();
              $array["catagory"]= $catagory_idD["name"];

           }


           $color_id = Database::s("SELECT * FROM `catagory` WHERE `id`= '".$productD["catagory_id"]."'; ");
           if ($catagory_idS -> num_rows == 1) {

              $catagory_idD= $catagory_idS->fetch_assoc();
              $array["catagory"]= $catagory_idD["name"];

           }

           $condition_id = Database::s("SELECT * FROM `catagory` WHERE `id`= '".$productD["catagory_id"]."'; ");
           if ($catagory_idS -> num_rows == 1) {

              $catagory_idD= $catagory_idS->fetch_assoc();
             

           }*/

           $array["catagory"]= $catagory_idD["name"];
           echo json_encode($array);



        }else{
            echo "invalidProduct Id";
        }

    }

}

?>