<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Dashboard</title>
    <style>
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table,.anime{
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
    
    include("../connection.php");

    $sqlmain= "select * from patient where pation_email=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s",$_COOKIE['user_email']);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch=$userrow->fetch_assoc();

    $userid= $userfetch["pation_id"];
    $username=$userfetch["pation_name"];
    $useremail=$userfetch["pation_email"];
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
                    <td class="menu-btn menu-icon-home menu-active menu-icon-home-active" >
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Accueil</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="consultation.php" class="non-style-link-menu"><div><p class="menu-text">Mes réservations</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu"><div><p class="menu-text">Paramètres</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
                        <tr >
                            
                            <td colspan="1" class="nav-bar" >
                            <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">Accueil</p>
                          
                            </td>
                            <td width="25%">

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
                    <td colspan="4" >
                        
                    <center>
                    <table class="filter-container doctor-header patient-header" style="border: none;width:95%" border="0" >
                    <tr>
                        <td >
                            <h3>Bonjour!</h3>
                            <h1><?php echo $username  ?>.</h1>
                            <p>Vous n'avez aucune idée des médecins ? pas de problème, passons à
                                 Rubrique « Tous les médecins » ou
                                 "Séances"
                                 Suivez l'historique de vos consultations passées et futures.<br>Découvrez également l'heure d'arrivée prévue de votre médecin ou consultant médical.<br><br>
                            </p>
                            <a class="login-btn btn-primary btn" href="?action=consulter&id=<?php echo $userid ?>" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">Prendre de Rendez-vous</a>
                            
                            <br>
                            <br>
                            
                        </td>
                    </tr>
                    </table>
                    </center>
                    
                </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table border="0" width="100%"">
                                <td width="50%">
                                    <center>
                                        <table class="filter-container" style="border: none;" border="0">
                                            <tr>
                                                <td colspan="4">
                                                    <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Status</p>
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
                                                                Tous les patients &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                        </table>
                    </td>
                <tr>
            </table>
        </div>
    </div>
<?php
if($_GET){
        $id=$_GET["id"];
        $action=$_GET["action"];
        if ($action=="consulter") {
            $sqlmain= "select * from patient where pation_id=?";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row=$result->fetch_assoc();
            $name=$row["pation_name"];
            $lname = $row["pation_prenom"];
            $tele=$row['pation_tel'];;
            
            echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                                <a class="close" href="index.php">&times;</a> 
                                <div style="display: flex;justify-content: center;">
                                <div class="abc">
                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Prendre de Rendez-vous.</p>
                                        <br>
                                        </td>
                                    </tr>
                                    <form action="add-consultation.php" method="POST" class="add-new-form">
                                    <tr>
                                        <td colspan="2">
                                            <input type="hidden" value="'.$id.'" name="idp">
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                    <td class="label-td" colspan="2">
                                            <label for="name" class="form-label">Name: </label><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                        <label for="prenom" class="form-label" style="color:#024b90;"> '.$name.' </label><br>
                                        </td>
                                        
                                    </tr>
                                    
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="prenom" class="form-label">prenom: </label><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                        <label for="prenom" class="form-label" style="color:#024b90;"> '.$lname.' </label><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="Tele" class="form-label">Telephone: </label><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                        <label for="prenom" class="form-label" style="color:#024b90;"> '.$tele.' </label><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="Tele" class="form-label">Le Cas pathologique: </label><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="desc" class="input-text" placeholder="Ex: "malade"" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="date" name="date" class="input-text" placeholder="Date consultation" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="submit" value="Ajouter" class="login-btn btn-primary btn">
                                        </td>
                                    </tr>
                                </form>
                                    </tr>
                                </table>
                                </div>
                                </div>
                            </center>
                            <br><br>
                    </div>
                    </div>
                    ';
        }
    }
?>
</body>
</html>