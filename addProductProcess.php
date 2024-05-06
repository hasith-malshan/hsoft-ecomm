<?php
session_start();
require "connection.php";

$userEmail = $_SESSION["a"]["email"];



$category = (int)$_POST["c"];
$brand = (int)$_POST["b"];
$modle = (int)$_POST["m"];
$title = $_POST["t"];
$condition = (int)$_POST["co"];
$color = (int)$_POST["clr"];
$price = (int)$_POST["p"];
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



$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date =  $d->format("Y-m-d H:i:s");



if ($category == "0") {
    echo "Please Select Catagory";
} else if ($brand == "0") {
    echo "Please Select Brand";
} else if ($modle == "0") {
    echo "Please Select Modle";
} else if (empty($title)) {
    echo "Please Add a title";
} else if (strlen($title) > 100) {
    echo "Title must contain 100 or less than 100 Charactors";
} else if ($qty == "0" || $qty == "e") {
    "Please add the quantity of your product";
} else if (!is_int($qty)) {
    echo "Please add a valid quantity";
} else if (empty($qty)) {
    echo "Please add a quantity for youur product";
} else if ($qty <= 0) {
    echo "Add a valid Quantity";
} else if (empty($price)) {
    echo "Please enter the price of your product";
} else if (!is_int($price)) {
    echo "please enter valid price";
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

    $status = 1;

    $modeleHasBrand = Database::s("SELECT `id` FROM `modle_has_brand` WHERE `brand_id` ='" . $brand . "' AND `model_id` = '" . $modle . "'; ");

    /* echo $userEmail;
    echo " : userEmail<br>";
    echo $category;
    echo " : category<br>";
    echo $color;
    echo " : color<br>";
    echo $price;
    echo " : price<br>";
    echo $title;
    echo " : title<br>";
    echo $qty;
    echo " : qty<br>";
    echo $description;
    echo " : description<br>";
    echo $condition;
    echo " : condition<br>";
    echo $status;
    echo " : status<br>";
    echo $date;
    echo " : date<br>";*/


    if ($modeleHasBrand->num_rows == 0) {
        echo "This product doesnt exist";
    } else {
        $f = $modeleHasBrand->fetch_assoc();
        $modeleHasBrand = $f["id"];
        /*echo $modeleHasBrand;
        echo ": modeleHasBrand<br>";*/

        Database::iud(
            "INSERT INTO product(
                `user_email`,
                `catagory_id`,
                `modle_has_brand_id`,
                `color_id`,
                `price`,
                `title`,
                `qty`,
                `description`,
                `condition_id`,
                `status_id`,
                `datetime_added`,
                `dic`,
                `doc`
                ) 
                VALUES(
                    '" . $userEmail . "',
                    '" . $category . "',
                    '" . $modeleHasBrand . "',
                    '" . $color . "',
                    '" . $price . "',
                    '" . $title . "',
                    '" . $qty . "',
                    '" . $description . "',
                    '" . $condition . "',
                    '" . $status . "',
                    '" . $date . "',
                    '" . $dwc . "',
                    '" . $doc . "')
                    ;"
        );
        echo "000";
        //echo "Product Added Successfully";

        $last_id = Database::$connection->insert_id;

        $allowed_image_extention  = array("image/jpg", "image/png", "image/svg", "image/jpeg");

   

        if (isset($imageFile)) {
            $file_extension = $imageFile["type"];
            //echo $file_extension;

            if (!in_array($file_extension, $allowed_image_extention)) {
                echo "Please select a Valid image 1";
            } else {
                //echo $imageFile["name"];

                $new_name = str_replace(' ', '_', $title) . uniqid();
                $iName = $new_name . ".png";

                $fileName = "resources//products//" . $new_name . ".png";
                move_uploaded_file($imageFile["tmp_name"], $fileName);

                Database::iud("INSERT INTO `image`(`code`,`product_id`,`iName`) VALUES ('" . $fileName . "','" . $last_id . "','" . $iName . "')");
            }
        } else {
            echo "Please Select an image 1";
        }

        if (isset($imageFile2)) {
            $file_extension = $imageFile2["type"];
            //echo $file_extension;

            if (!in_array($file_extension, $allowed_image_extention)) {
                echo "Please select a Valid image 2";
            } else {
                //echo $imageFile["name"];

                $new_name = str_replace(' ', '_', $title) . uniqid();
                $iName = $new_name . ".png";

                $fileName2 = "resources//products//" . $new_name . ".png";
                //echo $fileName2;
                move_uploaded_file($imageFile2["tmp_name"], $fileName2);

                //Database::iud("INSERT INTO `image`(`code1`,`iName1`) VALUES ('" . $fileName2 . "','" . $iName . "')");
                Database::iud("UPDATE `image` SET `code1` = '".$fileName2."' , `iName1`='".$iName."' WHERE `product_id`='".$last_id."' ;");
            }
        }

        if (isset($imageFile3)) {
            $file_extension = $imageFile3["type"];
            //echo $file_extension;

            if (!in_array($file_extension, $allowed_image_extention)) {
                echo "Please select a Valid image 3";
            } else {
                //echo $imageFile["name"];

                $new_name = str_replace(' ', '_', $title) . uniqid();
                $iName = $new_name . ".png";

                $fileName3 = "resources//products//" . $new_name . ".png";
                //echo $fileName3;
                move_uploaded_file($imageFile3["tmp_name"], $fileName3);

                //Database::iud("INSERT INTO `image`(`code2`,`iName2`) VALUES ('" . $fileName3 . "','" . $iName . "')");
                Database::iud("UPDATE `image` SET `code2` = '".$fileName3."' , `iName2`='".$iName."' WHERE `product_id`='".$last_id."' ;");
            }
        } 

    }
}
