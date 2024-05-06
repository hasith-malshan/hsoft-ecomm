<?php

session_start();
require "connection.php";

$userEmail = $_SESSION["a"]["email"];

$pid = $_SESSION["p"]["id"];


$title = $_POST["t"];
$qty = (int)$_POST["qty"];
$dwc = (int)$_POST["dwc"];
$doc = (int)$_POST["doc"];
$description = $_POST["des"];

if (isset($_FILES["img"])) {
    $imageFile = $_FILES["img"];
}

if (isset($_FILES["img2"])) {
    $imageFile2 = $_FILES["img2"];
}

if (isset($_FILES["img3"])) {
    $imageFile3 = $_FILES["img3"];
}

if (empty($title)) {
    echo "Please Add a title";
} else if (strlen($title) > 100) {
    echo "Title must contain 100 or less than 100 Charactors";
} else if ($qty == "0" || $qty == "e") {
    "Please add the quantity of your product";
} else if (!is_int($qty)) {
    echo "Please add a valid quantity";
} else if (empty($qty)) {
    echo "Please add a quantity for youur product";
} else if ($qty < 0) {
    echo "Add a valid Quantity";
} else if (empty($dwc)) {
    echo "Please enter the dilivery const inside Colombo";
} else if (!is_int($dwc)) {
    echo "please enter valid price";
} else if (empty($doc)) {
    echo "Please enter the dilivery const outside Colombo";
} else if (!is_int($doc)) {
    echo "please enter valid price";
} else if (empty($description)) {
    echo "please e enter the description of your product";
} else {

    Database::iud("UPDATE `product` SET `title`='" . $title . "',`qty`='" . $qty . "',`dic`='" . $dwc . "',`doc`='" . $doc . "',`description`='" . $description . "'  WHERE  `id`='" . $pid . "' ;");

    $last_id = Database::$connection->insert_id;

    $allowed_image_extention  = array("image/jpg", "image/png", "image/svg", "image/jpeg");


    if (isset($imageFile)) {
        $file_extension = $imageFile["type"];
        //echo $file_extension;

        if (!in_array($file_extension, $allowed_image_extention)) {
            echo "Please select a Valid image";
        } else {
            //echo $imageFile["name"];

            $imgS = Database::s("SELECT * FROM `image` WHERE `product_id`='" . $_SESSION["p"]["id"] . "';");
            $imgD = $imgS->fetch_assoc();

            $new_name = $imgD["code"];
            $iName = $new_name . ".png";

            $fileName = $new_name;
            move_uploaded_file($imageFile["tmp_name"], $fileName);
        }
    }


    if (isset($imageFile2)) {
        $file_extension = $imageFile2["type"];
        //echo $file_extension;

        if (!in_array($file_extension, $allowed_image_extention)) {
            echo "Please select a Valid image";
        } else {
            //echo $imageFile["name"];

            $imgS = Database::s("SELECT * FROM `image` WHERE `product_id`='" . $_SESSION["p"]["id"] . "';");
            $imgD = $imgS->fetch_assoc();

            $new_name = "";
            $fileName = "";

            if ($imgD["code1"] == "") {
                $new_name = uniqid();
                $iName = $new_name . ".png";
                $fileName = "resources//products//" . $new_name . ".png";
                Database::iud("UPDATE `image` SET `code1` = '" . $fileName . "' , `iName1`='" . $iName . "' WHERE `product_id`='" . $imgD["product_id"] . "' ;");
            } else if (isset($imgD["code1"])) {
                $new_name = $imgD["code1"];
                $iName = $new_name . ".png";
                $fileName = $new_name;
            } else {
            }

            move_uploaded_file($imageFile2["tmp_name"], $fileName);
        }
    }



    if (isset($imageFile3)) {
        $file_extension = $imageFile3["type"];
        //echo $file_extension;

        if (!in_array($file_extension, $allowed_image_extention)) {
            echo "Please select a Valid image";
        } else {
            //echo $imageFile["name"];

            $imgS = Database::s("SELECT * FROM `image` WHERE `product_id`='" . $_SESSION["p"]["id"] . "';");
            $imgD = $imgS->fetch_assoc();


            $new_name = "";
            $fileName = "";

            if ($imgD["code2"] == "") {
                $new_name = uniqid();
                $iName = $new_name . ".png";
                $fileName = "resources//products//" . $new_name . ".png";
                Database::iud("UPDATE `image` SET `code2` = '" . $fileName . "' , `iName2`='" . $iName . "' WHERE `product_id`='" . $imgD["product_id"] . "' ;");
            } else {
                $new_name = $imgD["code"];
                $iName = $new_name . ".png";
                $fileName = $new_name;
            }

            move_uploaded_file($imageFile3["tmp_name"], $fileName);
        }
    }

    echo "000";
}
