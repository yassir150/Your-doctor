<?php

    $database= new mysqli("medical-yassmann646-9328.h.aivencloud.com:21016","avnadmin","AVNS_OTsh3CX-qJZ92JUYsm2","medical");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>