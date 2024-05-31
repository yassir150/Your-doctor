<?php

if (!isset($_COOKIE['user_email']) || !isset($_COOKIE['user_type']) || $_COOKIE['user_type'] != 'a') {
    header("location: ../login.php");
    exit;
}
    
    if($_GET){
        //import database
        include("../connection.php");
        $id=$_GET["id"];
        $sql= $database->query("delete from consultation where consultation_id='$id';");
        header("location: consultation.php");
    }


?>