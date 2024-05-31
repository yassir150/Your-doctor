<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Tableau de bord</title>
    <style>
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
    
    
</head>
<body>
    <?php

    //learn from w3schools.com

    if (!isset($_COOKIE['user_email']) || !isset($_COOKIE['user_type']) || $_COOKIE['user_type'] != 'a') {
        header("location: ../login.php");
        exit;
      }
    

    //import database
    include("../connection.php");

    
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">Administrateur</p>
                                    <p class="profile-subtitle">admin@admin.com</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php" ><input type="button" value="Se déconnecter" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active" >
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Tableau de bord</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="consultation.php" class="non-style-link-menu"><div><p class="menu-text">Consultation</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu"><div><p class="menu-text">Patients</p></a></div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
                        <tr >
                            <td >
                                <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                                    La date d'aujourd'hui
                                </p>
                                <p class="heading-sub12" style="padding: 0;margin: 0;">
                                    <?php 
                                date_default_timezone_set('Africa/Casablanca');

        
                                $today = date('Y-m-d');
                                echo $today;


                                $patientrow = $database->query("select  * from  patient;");
                                $consultationrow = $database->query("select  * from  consultation where consultation_date>='$today';");


                                ?>
                                </p>
                            </td>
                            <td width="10%">
                                <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                            </td>
        
        
                        </tr>
                <tr>
                    <td colspan="4">
                        
                        <center>
                        <table class="filter-container" style="border: none;" border="0">
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Statut</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;">
                                        <div>
                                                <div class="h1-dashboard">
                                                    <?php    echo $patientrow->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard">
                                                    Patients &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="margin-left: auto;background-image: url('../img/icons/patients-hover.svg');"></div>
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex; ">
                                        <div>
                                                <div class="h1-dashboard" >
                                                    <?php    echo $consultationrow ->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard" >
                                                Les Nouveau Réservation &nbsp;&nbsp;
                                                </div>
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="margin-left: auto;background-image: url('../img/icons/book-hover.svg');"></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </center>
                    </td>
                </tr>






                <tr>
                    <td colspan="4">
                        <table width="100%" border="0" class="dashbord-tables" style="border-spacing:0;">
                            <tr>
                                <td >
                                    <p style="padding:10px;padding-left:48px;padding-bottom:0;font-size:23px;font-weight:700;color:var(--primarycolor);">
                                    Consultations à venir
                                    </p>
                                    <p style="padding-bottom:19px;padding-left:50px;font-size:15px;font-weight:500;color:#212529e3;line-height: 20px;">
                                        Voici un accès rapide aux consultations à venir.<br>
                                        Plus de détails disponibles dans la section @consultation.
                                    </p>

                                </td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    <center>
                                        <div class="abc scroll" style="height: 350px;">
                                        <table width="95%" class="sub-table scrolldown" border="0" style="border-spacing:0;">
                                        <thead>
                                        <tr>    
                                                <th class="table-headin">
                                                    id
                                                </th>
                                                <th class="table-headin">
                                                    nom
                                                </th>
                                                <th class="table-headin">
                                                    prenom
                                                </th>
                                                <th class="table-headin">
                                                    cas pathelogique
                                                </th>
                                                <th class="table-headin">
                                                    date consultation
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            $nextweek=date("Y-m-d",strtotime("+1 week"));
                                            $sqlmain= "select * from consultation inner join patient on consultation.pation_id=patient.pation_id";

                                                $result= $database->query($sqlmain);
                
                                                if($result->num_rows==0){
                                                    echo '<tr>
                                                    <td colspan="5">
                                                    <br><br><br><br>
                                                    <center>
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Nous n\'avons trouvé aucun rendez-vous !</p>
                                                    
                                                    </center>
                                                    <br><br><br><br>
                                                    </td>
                                                    </tr>';
                                                    
                                                }
                                                else{
                                                for ( $x=0; $x<$result->num_rows;$x++){
                                                    $row=$result->fetch_assoc();
                                                    $pid=$row["pation_id"];
                                                    $pname=$row["pation_name"];
                                                    $lname = $row["pation_prenom"];
                                                    $Cdate=$row["consultation_date"];
                                                    $desc=$row["consultation_description"];
                                                    echo '<tr>
                                                        <td style="text-align:center;font-size:20px;font-weight:500; color: var(--btnnicetext);padding:20px;">
                                                            '.$pid.'
                                                        </td>
                                                        <td style="font-weight:600;"> &nbsp;'.
                                                        substr($pname,0,25).'
                                                        </td>
                                                        <td style="font-weight:600;"> &nbsp;'.
                                                        substr($lname,0,25).'
                                                        </td>
                                                        <td>
                                                        '.substr($desc,0,15).'
                                                        </td>
                                                        <td>
                                                        '.substr($Cdate,0,15).'
                                                        </td>
                                                    </tr>';
                                                    
                                                }
                                            }
                                            ?>
                                            </tbody>
                
                                        </table>
                                        </div>
                                        </center>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <center>
                                        <a href="consultation.php" class="non-style-link"><button class="btn-primary btn" style="width:85%">Afficher tous les rendez-vous</button></a>
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
                </table>
                </center>
                </td>
                </tr>
            </table>
        </div>
    </div>


</body>
</html>