<?php
session_start();

if(isset($_SESSION["u"])){
    $_SESSION["u"] = null;
    session_destroy();
}else{
    echo "01";
}

?>