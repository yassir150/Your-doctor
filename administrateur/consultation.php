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
                    <td class="menu-btn menu-icon-dashbord" >
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">Tableau de bord</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment menu-active menu-icon-appoinment-active">
                        <a href="consultation.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">consultation</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu"><div><p class="menu-text">Patients</p></a></div>
                    </td>
                </tr>

            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="index.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Management des consultation</p>
                                           
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

                        $list110 = $database->query("select  * from  consultation;");

                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                    
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Toutes les consultations (<?php echo $list110->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                    </table>
                    </center>
                    </td>
                    
                </tr> 
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0" style="border-spacing:0;">
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
                                    Date de consultation 
                                </th>
                                <th class="table-headin">
                                    numero telephone
                                </th>
                                <th class="table-headin">
                                    Events
                                </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sqlmain= "select * from consultation inner join patient on consultation.pation_id=patient.pation_id;";
                                $result= $database->query($sqlmain);

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="7">
                                    <br><br><br><br>
                                    <center>
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Nous n\'avons trouvé aucun rendez-vous !</p>
                                    <a class="non-style-link" href="consultation.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all consultations &nbsp;</font></button>
                                    </a>
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
                                    $desc=$row["consultation_description"];
                                    $Cdate=$row["consultation_date"];
                                    $tele = $row["pation_tel"];
                                    $Cid = $row["consultation_id"];
                                    echo '<tr >
                                        <td> &nbsp;'.
                                        
                                        substr($pid,0,25)
                                        .'</td >
                                        <td style="font-weight:600;">
                                        '.$pname.'
                                        
                                        </td>
                                        <td style="font-weight:600;">
                                        '.substr($lname,0,25).'
                                        </td>
                                        <td>
                                        '.substr($desc,0,15).'
                                        </td>
                                        <td style="text-align:center;font-size:17px;">
                                            '.substr($Cdate,0,10).'
                                        </td>
                                        
                                        <td style="text-align:center;">
                                            '.$tele.'
                                        </td>
                                        <td width=5%>
                                        <div style="display:flex;justify-content: center;width:fit-content;">
                                       <a href="?action=drop&id='.$Cid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="margin:5px;font-size:12px;"><font class="tn-in-text">Cancel</font></button></a>
                                       <a href="?action=edit&id='.$Cid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-edit"  style="margin:5px;font-size:12px;"><font class="tn-in-text">Edit</font></button></a>
                                       </div>
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
            </table>
        </div>
    </div>
    <?php
    
    if($_GET){
        $id=$_GET["id"];
        $action=$_GET["action"];
        if($action=='drop'){
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="consultation.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br><br>
                            Patient Name: &nbsp;<b>'.substr($pname,0,40).'</b><br>
                            consultation date &nbsp; : <b>'.substr($Cdate,0,40).'</b><br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-consultation.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="consultation.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            '; 
        }elseif ($action=="edit") {
            $sqlmain= "select * from patient inner join consultation on patient.pation_id = consultation.pation_id where consultation.consultation_id=?";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row=$result->fetch_assoc();
            $name=$row["pation_name"];
            $lname = $row["pation_prenom"];
            $tele=$row['pation_tel'];
            $desc=$row["consultation_description"];
            $Cdate=$row["consultation_date"];
            
            echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                                <a class="close" href="consultation.php">&times;</a> 
                                <div style="display: flex;justify-content: center;">
                                <div class="abc">
                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Modifiez Rendez-vous.</p>
                                        <br>
                                        </td>
                                    </tr>
                                    <form action="edit-consultation.php" method="POST" class="add-new-form">
                                    <tr>
                                        <td colspan="2">
                                            <input type="hidden" value="'.$id.'" name="id">
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
                                            <input type="text" name="desc" class="input-text" placeholder="Ex: malade" value="'.$desc.'" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="date" name="date" class="input-text" placeholder="Date consultation" value="'.$Cdate.'" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="submit" value="Modifier" class="login-btn btn-primary btn">
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
    </div>
</body>
</html>