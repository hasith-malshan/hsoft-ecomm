<?php
require "connection.php";

$fname= $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];
$gender = $_POST["gender"];



if(empty($fname)){
    echo "Please enter First your name";
}else if(strlen($fname)>50){
    echo "Charactor limit for first name is 50";
}
else if(empty($lname)){
    echo "Please enter Last your name";
}else if(strlen($lname)>50){
    echo "Charactor limit for last name is 50";
}
else if(empty($email)){
    echo "Please enter Email to regester";
}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid Email Format";
}else if(strlen($email)>100){
    echo "Charactor limit for Email is 100";
}else if(empty($password)){
    echo "Please Enter Your Password";
}else if(strlen($password) <8 || strlen($password)>20){
    echo "Password must contain 08-20 charactors";
}else if(empty($mobile)){
    echo "Please Enter Your Mobile number";
}else if (strlen($mobile)!=10) {
    echo "Please Check mobile number";
}else if(preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/",$mobile)==0){
    echo "Invalid Mobile number";
}
else{

    $r =Database::s("SELECT * from `user` where `email`='".$email."'  ");
    if($r->num_rows >0){
        echo "This Email is Already regestered";
    }else{
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d-> setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");
        Database::iud("INSERT INTO `user` Values ('".$email."','".$fname."','".$lname."','".$password."','".$mobile."','".$date."','".$gender."','NSY','1');");
        echo "111";
     }
    }





?>