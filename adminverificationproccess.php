<?php

require "connection.php";

require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["e"])) {
    $email = $_POST["e"];

    if (empty($email)) {
        echo "Please enter your Email address.";
    } else {
        $adminrs = Database::s("SELECT * FROM `admin` WHERE `email` = '" . $email . "' ");
        $an = $adminrs->num_rows;

        if ($an == 1) {

            $code = uniqid();

            Database::iud("UPDATE `admin` SET `verification`='" . $code . "' WHERE `email`='" . $email . "' ");

            // email code
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'email@gmail.com';
            $mail->Password = 'PASSWORD HERE';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('malhash53@gmail.com', 'EShop');
            $mail->addReplyTo('malhash53@gmail.com', 'Eshop');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Admin Verification Code';
            $bodyContent = '<h1 style="color: red;">Your Verification Code for Eshop account: ' . $code . '</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending fail.Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo '000';
            }
        } else {
            echo "You are not a valid user";
        }
    }
}
