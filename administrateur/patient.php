<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Patients</title>
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
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="consultation.php" class="non-style-link-menu"><div><p class="menu-text">consultation</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient  menu-active menu-icon-patient-active">
                        <a href="patient.php" class="non-style-link-menu  non-style-link-menu-active"><div><p class="menu-text">Patients</p></a></div>
                    </td>
                </tr>

            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%">

                    <a href="patient.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    <!-- <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Management des patient</p>
                                           
                    </td> -->
                    <td>
                        
                        <form action="" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Rechercher le nom ou l'adresse e-mail du patient" list="patient">&nbsp;&nbsp;
                            
                            <?php
                                echo '<datalist id="patient">';
                                $list11 = $database->query("select  pation_name,pation_email from patient;");

                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $d=$row00["pation_name"];
                                    $c=$row00["pation_email"];
                                    echo "<option value='$d'><br/>";
                                    echo "<option value='$c'><br/>";
                                };

                            echo ' </datalist>';
?>
                            
                       
                            <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        
                        </form>
                        
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            La date d'aujourd'hui
                        </p>
                        <p class="heading-sub12" style="padding-left:auto;margin: 0;">
                            <?php 
                        date_default_timezone_set('Africa/Casablanca');


                        $date = date('Y-m-d');
                        echo $date;
                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>
                </tr>
                <?php
                    $sql="SELECT * FROM patient";
                    $list11 = $database->query($sql);
                ?>
               
                
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Tous les patients (<?php echo $list11->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <?php
                    if($_POST){
                        $keyword=$_POST["search"];
                        
                        $sqlmain= "select * from patient where pation_email='$keyword' or pation_name='$keyword' or pation_name like '$keyword%' or pation_name like '%$keyword' or pation_name like '%$keyword%' ";
                    }else{
                        $sqlmain= "select * from patient order by pation_id desc";

                    }



                ?>
                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown"  style="border-spacing:0;">
                        <thead>
                        <tr>
                                <th class="table-headin">                                
                                Nom
                                </th>
                                <th class="table-headin">
                                Prenom
                                </th>
                                <th class="table-headin">
                                Telephone
                                </th>
                                <th class="table-headin">
                                Email
                                </th>
                                <th class="table-headin">
                                Date de naissance
                                </th>
                                <th class="table-headin">
                                Events
                                </tr>
                        </thead>
                        <tbody>
                        
                            <?php

                                
                                $result= $database->query($sqlmain);

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="patient.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Patients &nbsp;</font></button>
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
                                    $name=$row["pation_name"];
                                    $lname=$row["pation_prenom"];
                                    $email=$row["pation_email"];
                                    $dob=$row["pation_naissance"];
                                    $tel=$row["pation_tel"];
                                    $adrss=$row["pation_address"];
                                    
                                    echo '<tr>
                                        <td> &nbsp;'.
                                        substr($name,0,35)
                                        .'</td>
                                        <td>
                                        '.substr($lname,0,12).'
                                        </td>
                                        <td>
                                        '.substr($tel,0,10).'
                                        </td>
                                        <td>
                                        '.substr($email,0,30).'
                                         </td>
                                        <td>
                                        '.substr($dob,0,10).'
                                        </td>
                                        <td width=5%>
                                        <div style="display:flex;justify-content: center;align-items: center;" width:fit-content;>
                                        
                                        <a href="?action=edit&id='.$pid.'&error=0" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-edit"  style="margin:5px;font-size:12px;"><font class="tn-in-text">Modifier</font></button></a>
                                        <a href="?action=drop&id='.$pid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="margin:5px;font-size:12px;"><font class="tn-in-text">Supprimer</font></button></a>
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
            $sqlmain= "select * from patient where pation_id='$id'";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $pid=$row["pation_id"];
            $name=$row["pation_name"];
            $lname=$row["pation_prenom"];
            $email=$row["pation_email"];
            $dob=$row["pation_naissance"];
            $tel=$row["pation_tel"];
            $adrss=$row["pation_address"];
            if($action=='drop'){
                $nameget=$name;
                echo '
                <div id="popup1" class="overlay">
                        <div class="popup">
                        <center>
                            <h2>Are you sure?</h2>
                            <a class="close" href="patient.php">&times;</a>
                            <div class="content">
                                Vous souhaitez supprimer votre compte<br>('.substr($nameget,0,40).').
                                
                            </div>
                            <div style="display: flex;justify-content: center;">
                            <a href="delete-account.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                            <a href="patient.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>
    
                            </div>
                        </center>
                </div>
                </div>
                ';
            }elseif($action=='edit'){
                //this one is for edit
                $sqlmain= "select * from patient where pation_id=?";
                $stmt = $database->prepare($sqlmain);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row=$result->fetch_assoc();
                $name=$row["pation_name"];
                $lname = $row["pation_prenom"];
                $email=$row["pation_email"];
                $address=$row["pation_address"];
                $dob=$row["pation_naissance"];
                $tele=$row['pation_tel'];;
    
                $error_1=$_GET["error"];
                    $errorlist= array(
                        '1'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Il y a déjà un compte pour cette adresse e-mail.</label>',
                        '2'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Erreur de confirmation du mot de passe ! Reconformer le mot de passe</label>',
                        '3'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                        '4'=>"",
                        '0'=>'',
    
                    );
    
                if($error_1!='4'){
                        echo '
                        <div id="popup1" class="overlay">
                                <div class="popup">
                                <center>
                                
                                    <a class="close" href="patient.php">&times;</a> 
                                    <div style="display: flex;justify-content: center;">
                                    <div class="abc">
                                    <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                    <tr>
                                            <td class="label-td" colspan="2">'.
                                                $errorlist[$error_1]
                                            .'</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Modifier les détails du compte utilisateur.</p>
                                            User ID : '.$id.' (Generation auto)<br><br>
                                            </td>
                                        </tr>
                                    <form action="edit-user.php" method="POST" class="add-new-form">
                                    <tr>
                                    
                                    <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td class="label-td" colspan="2">
                                    <input type="text" name="name" class="input-text" placeholder="Name" value="'.$name.'" required><br>
                                    </td>
                                    
                                    </tr>
                                    
                                    <tr>
                                    <td class="label-td" colspan="2">
                                    <label for="prenom" class="form-label">prenom: </label>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td class="label-td" colspan="2">
                                    <input type="text" name="prenom" class="input-text" placeholder="prenom" value="'.$lname.'" required><br>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td class="label-td" colspan="2">
                                            <label for="Email" class="form-label">Email: </label>
                                            <input type="hidden" value="'.$id.'" name="id00">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                        <input type="hidden" name="oldemail" value="'.$email.'" >
                                        <input type="email" name="email" class="input-text" placeholder="Email Address" value="'.$email.'" required><br>
                                        </td>
                                    </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="Tele" class="form-label">Telephone: </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" value="'.$tele.'" required><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="spec" class="form-label">Address</label>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                            <input type="text" name="address" class="input-text" placeholder="Address" value="'.$address.'" required><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            
                                                <input type="submit" value="Save" class="login-btn btn-primary btn">
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
        
            };
}

?>
</div>

</body>
</html>