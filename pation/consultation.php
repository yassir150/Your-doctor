<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>consultations</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
    <?php



    if (!isset($_COOKIE['user_email']) || !isset($_COOKIE['user_type']) || $_COOKIE['user_type'] != 'p') {
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


    $sqlmain= "select * from consultation inner join patient on consultation.pation_id = patient.pation_id WHERE consultation.pation_id =$userid";

    $result= $database->query($sqlmain);
    ?>
    <div class="container">
    <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%"><!-- change the picture here -->
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,13)  ?>.</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
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
                    <td class="menu-btn menu-icon-home " >
                        <a href="index.php" class="non-style-link-menu "><div><p class="menu-text">Accueil</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-appoinment menu-active menu-icon-appoinment-active">
                        <a href="consultation.php" class="non-style-link-menu menu-active non-style-link-menu-active"><div><p class="menu-text">Mes réservations</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu"><div><p class="menu-text">Paramètres</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="consultation.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Mes rendez-vous:</p>
                                           
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            La date d'aujourd'hui
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 

                        date_default_timezone_set('Africa/Casablanca');


                        $today = date('Y-m-d');
                        echo $today;

                        
                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
               
                
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                    
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Mes réservations (<?php echo $result->num_rows; ?>)</p>
                    </td>
                </tr>
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0" style="border:none">
                        
                        <tbody>
                        
                            <?php
                                for ( $x=0; $x<($result->num_rows);$x++){
                                        echo "<tr>";
                                        for($q=0;$q<3;$q++){
                                            $row=$result->fetch_assoc();
                                            if (!isset($row)){
                                            break;
                                            };
                                            $consultation_id=$row["consultation_id"];
                                            $consultationDate = $row["consultation_date"];
                                            $description = $row["consultation_description"];
                                            $dob = $row["pation_naissance"];
                                            $adresse = $row["pation_address"];
                                            $consultation_id = $row["consultation_id"];
                                            echo '
                                            <td style="width: 25%;">
                                                    <div  class="dashboard-items search-items"  >
                                                    
                                                        <div style="width:100%;">
                                                        <div class="h3-search">
                                                                    Date consultation: '.substr($consultationDate,0,30).'<br>
                                                                    <br>
                                                                    Nombre de reference: C-'.$consultation_id.'
                                                                </div>
                                                                <br>
                                                                <div class="h3-search">
                                                                adresse de pation : '.$adresse.'
                                                                </div>
                                                                <br>
                                                                <div class="h3-search">
                                                                Pation date de naissance: '.$dob.'
                                                                </div>
                                                                <br>
                                                                <div class="h3-search">
                                                                Le Cas pathologique: </div><div class="h1-search">'.$description.'</div>
                                                                <br> 
                                                                <a href="delete-consultation.php?id='.$consultation_id.'" ><button  class="login-btn btn-primary-soft btn "  style="padding-top:11px;padding-bottom:11px;width:100%"><font class="tn-in-text">Cancel Booking</font></button></a>
                                                        </div>
                                                                
                                                    </div>
                                                </td>';
                                        echo "</tr>";
                                        }
                                }
                                 
                            ?>
 
                            </tbody>

                        </table>
                        </div>
                        </center>
                   </td> 
                </tr>
                       
                        
                        
            </table>
        </div>
    </div>
    
</body>
</html>
