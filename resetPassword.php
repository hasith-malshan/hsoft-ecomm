<?php

require "connection.php";

$e =$_POST["e"];
$np =$_POST["np"];
$rnp =$_POST["rnp"];
$vc =$_POST["vc"];

if (empty($e)) {
  echo "Missing Email address";
}
else if (empty($np)) {
    echo "Please Eter Your new Password";
}
else if(strlen($np) <5 || strlen($np)>20){
    echo "Password Lenghth must between 5 to 20";
}
else if (empty($rnp)) {
    echo "Please Re-type Password";
}else if(strlen($rnp) <5 || strlen($rnp)>20){
    echo "Re-type Password Lenghth must between 5 to 20";
}else if ($np != $rnp) {
    echo "Password and Re-trype Password does not match";
}else if (empty($vc)) {
    echo "Please Enter Your Verification Code";
}else{
    $rs = Database::s("SELECT * from `user` where `email`='".$e."' AND `verification_code`='".$vc."'  ");

    if ($rs->num_rows==1) {
      Database::iud("UPDATE `user`  set `password`='".$np."' where `email`='".$e."';");
      echo "success";
    }else{
        echo "Password Reset Fail";
    }
}



?>