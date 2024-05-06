<?php
require "connection.php";
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {
    $e = $_GET["e"];

    if (empty($e)) {
        echo "Please Enter Your Email Address";
    } else {
        $rs = Database::s("SELECT * from user where `email`='" . $e . "' ");
        if ($rs->num_rows == 1) {
            $code = uniqid();
            Database::iud("UPDATE `user` set `verification_code`='" . $code . "' where `email`='" . $e . "' ");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'email@email.com';
            $mail->Password = 'PASSWORD HERE';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('malhash53@gmail.com', 'EShop');
            $mail->addReplyTo('malhash53@gmail.com', 'Eshop');
            $mail->addAddress($e);
            $mail->isHTML(true);
            $mail->Subject = 'Eshop Fogot Password Verification Code';
            $bodyContent = '<h1 style="color: red;">Your Verification Code for Eshop account: ' . $code . '</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification Code sending fail';
            } else {
                echo "success";
            }
        } else {
            echo "Email address Not found";
        }
    }
} else {
    echo "please Eter your Email Address";
}
