<?php

    //learn from w3schools.com

    if (!isset($_COOKIE['user_email']) || !isset($_COOKIE['user_type']) || $_COOKIE['user_type'] != 'p') {
        header("location: ../login.php");
        exit;
    }
    

    //import database
    include("../connection.php");
    $useremail =$_COOKIE["user_email"];
    $sqlmain= "select * from patient where pation_email=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s",$useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pation_id"];
    $username=$userfetch["pation_name"];


    if($_POST){
        if(isset($_POST["idp"])){
            $userid=$_POST["idp"];
            $desc = $_POST["desc"];
            $date=$_POST["date"];
            $sql2="INSERT INTO consultation (pation_id, consultation_date, consultation_description) VALUES ($userid,'$date','$desc')";
            $result= $database->query($sql2);
            //echo $apponom;
            header("location: consultation.php");

        }
    }
 ?>