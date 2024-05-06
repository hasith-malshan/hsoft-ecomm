<?php

use function PHPSTORM_META\type;

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $fname = $_POST["f"];
    $lname = $_POST["l"];
    $mobile = $_POST["m"];
    $line1 = $_POST["l1"];
    $line2 = $_POST["l2"];
    $city = $_POST["c"];
    $img;



    if (empty($fname)) {
        echo "Please enter First your name";
    } else if (strlen($fname) > 50) {
        echo "Charactor limit for first name is 50";
    } else if (empty($lname)) {
        echo "Please enter Last your name";
    } else if (strlen($lname) > 50) {
        echo "Charactor limit for last name is 50";
    } else if (empty($mobile)) {
        echo "Please Enter Your Mobile number";
    } else if (strlen($mobile) != 10) {
        echo "Please Check mobile number";
    } else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $mobile) == 0) {
        echo "Invalid Mobile number";
    } else if (empty($line1)) {
        echo "Please enter Address Line 1";
    } else if (empty($line2)) {
        echo "Please enter Address Line 1";
    } else if (empty($city)) {
        echo "Please enter your city";
    } else {
        Database::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`mobile`='" . $mobile . "' WHERE `email`='" . $_SESSION["u"]["email"] . "' ;");
        $userDetails = Database::s("SELECT * FROM `user` WHERE `email`='" . $_SESSION["u"]["email"] . "';");

        $userDetailsD = $userDetails->fetch_assoc();
        //echo $userDetailsD["fname"];

        $_SESSION["u"] =  $userDetailsD;

        //echo "USer Table Updated";

        $address = Database::s("SELECT * FROM `user_has_address` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'; ");
        $address_nr = $address->num_rows;

        if ($address_nr == 1) {
            //UPdate Exsisting address

            $citySearch = Database::s("SELECT * FROM `city` WHERE `name`='" . $city . "'; ");

            if ($citySearch->num_rows == 1) {
                $cityData = $citySearch->fetch_assoc();
                $city_id = (int)$cityData["id"];
                // /echo  gettype($city_id);

                Database::iud("UPDATE `user_has_address` SET `line1` = '" . $line1 . "', `line2` = '" . $line2 . "',`city_id` = '" . $city_id . "' WHERE `user_email`='" . $_SESSION["u"]["email"] . "';");
                //echo "Address Updated";

            } else {
                echo "There is no such a city in Database";
            }


            if (isset($_FILES["i"]["name"])) {
                //echo "update with Image";
                $img = $_FILES["i"];

                $allowed_image_extention  = array("image/jpg", "image/png", "image/svg", "image/jpeg");

                if (isset($img)) {
                    $file_extension = $img["type"];
                    //echo $file_extension;

                    if (!in_array($file_extension, $allowed_image_extention)) {
                        echo "Please select a Valid image";
                    } else {

                        $imgS = Database::s("SELECT * FROM `profile_img` WHERE `user_email`='" . $_SESSION["u"]["email"] . "';");
                        $imgSNr = $imgS->num_rows;

                        if ($imgSNr == 0) {



                            $new_name = "profileImg/".$_SESSION["u"]["email"] . uniqid() . ".png";

                            $fileName = $new_name;

                            Database::iud("INSERT INTO `profile_img`(`code`,`user_email`) VALUES('" . $new_name . "','" . $_SESSION["u"]["email"] . "');");

                            move_uploaded_file($img["tmp_name"], $fileName);

                            echo "009";

                            //echo "Data shuold enterd to database";
                        } elseif ($imgSNr == 1) {
                            $imgD = $imgS->fetch_assoc();

                            $new_name = $imgD["code"];
                            $iName = $new_name . ".png";

                            $fileName = $new_name;
                            move_uploaded_file($img["tmp_name"], $fileName);

                            echo "009";
                        }
                    }
                } else {
                    echo "Please Select an image";
                }
            }
        } else {


            $citySearch = Database::s("SELECT * FROM `city` WHERE `name`='" . $city . "'; ");


            if ($citySearch->num_rows == 1) {
                $cityData = $citySearch->fetch_assoc();

                $userNewAddress = Database::iud(
                    "INSERT INTO `user_has_address`(`user_email`,`line1`,`line2`,`city_id`) VALUES('" . $_SESSION["u"]["email"] . "','" . $line1 . "','" . $line2 . "','" . $cityData["id"] . "');"
                );

                if (isset($_FILES["i"]["name"])) {
                    //echo "update with Image";
                    $img = $_FILES["i"];

                    $allowed_image_extention  = array("image/jpg", "image/png", "image/svg", "image/jpeg");

                    if (isset($img)) {
                        $file_extension = $img["type"];
                        //echo $file_extension;

                        if (!in_array($file_extension, $allowed_image_extention)) {
                            echo "Please select a Valid image";
                        } else {

                            $imgS = Database::s("SELECT * FROM `profile_img` WHERE `user_email`='" . $_SESSION["u"]["email"] . "';");
                            $imgSNr = $imgS->num_rows;

                            if ($imgSNr == 0) {

                                $new_name = "profileImg/".$_SESSION["u"]["email"] . uniqid() . ".png";

                                $fileName = $new_name;

                                Database::iud("INSERT INTO `profile_img`(`code`,`user_email`) VALUES('" . $new_name . "','" . $_SESSION["u"]["email"] . "');");

                                move_uploaded_file($img["tmp_name"], $fileName);

                                echo "009";

                                //echo "Data shuold enterd to database";
                            } elseif ($imgSNr == 1) {
                                $imgD = $imgS->fetch_assoc();

                                $new_name = $imgD["code"];

                                $fileName = $new_name;
                                move_uploaded_file($img["tmp_name"], $fileName);
                            }
                        }
                    } else {
                        echo "Please Select an image";
                    }
                } else {
                    echo "009";
                }
            } else {
                echo "There is no city named in our Database";
            }





            //echo "New Address added";
            //echo "009";
        }
    }
} else {
    echo "00X";
}
