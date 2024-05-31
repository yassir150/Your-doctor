<?php

if (!isset($_COOKIE['user_email']) || !isset($_COOKIE['user_type']) || $_COOKIE['user_type'] != 'a') {
    header("location: ../login.php");
    exit;
  }


//import database
include("../connection.php");
$useremail=$_COOKIE['user_email'];
$sqlmain= "select * from patient where pation_email=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s",$useremail);
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch=$userrow->fetch_assoc();
$userid= $userfetch["pation_id"];
$username=$userfetch["pation_name"];

    
    if($_GET){
        //import database
        include("../connection.php");
        $id=$_GET["id"];
        $sqlmain= "select * from patient where pation_id=?";
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result001 = $stmt->get_result();
        $email=($result001->fetch_assoc())["pation_email"];

        $sqlmain= "delete from webuser where email=?;";
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();


        $sqlmain= "delete from patient where pation_email=?";
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();

        //print_r($email);
        header("location: /patient.php");
    }


?>