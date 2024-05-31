<?php

    if (!isset($_COOKIE['user_email']) || !isset($_COOKIE['user_type']) || $_COOKIE['user_type'] != 'a') {
    header("location: ../login.php");
    exit;
  }

    include("../connection.php");

    if($_POST){
        $id=$_POST["id"];
        $desc=$_POST["desc"];
        $date=$_POST["date"];
        $sql= $database->query("update consultation set consultation_description='$desc', consultation_date='$date',where consultation_id=$id;");
    }
    

    header("location: consultation.php");
    ?>