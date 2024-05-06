<?php
require "connection.php";

session_start();

$e = $_POST["email"];
$p = $_POST["password"];
$r = $_POST["remember"];

if(empty($e)){
    echo "Please enter Email to sign in";
}else if(empty($p)){
    echo "Please Enter Your Password";
}else{

    $rs = Database::s("SELECT * from `user` where `email`='".$e."' and `password`='".$p."' ;");
    $n = $rs-> num_rows;

    $rsData = $rs->fetch_assoc();

    
    
    if($n==1){

        if ($rsData["status_id"] == 1) {
            echo "Success";
            //$d = $rs-> fetch_assoc();
            $_SESSION["u"]= $rsData;
        
            if($r== "true"){
                setcookie("e",$e,time()+(60*60*24*365));
                setcookie("p",$p,time()+(60*60*24*365));
            }else{
                setcookie("e","",-1);
                setcookie("p","",-1);
            }
        }else{
            echo "00X";
        }
    
    }else{
        echo "Invalid details";
    }

}
