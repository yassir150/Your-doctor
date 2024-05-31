<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
        
    <title>S'inscrire</title>
    
</head>
<body>
<?php

//learn from w3schools.com
//Unset all the server side variables

// session_start();

$_SESSION["user"]="";
$_SESSION["usertype"]="";

// Set the new timezone
date_default_timezone_set('Africa/Casablanca');

$date = date('Y-m-d');

$_SESSION["date"]=$date;



if ($_POST) {

  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $address = $_POST['address'];
  $dob = $_POST['dob'];

  $expire = time() + 60 * 60;

  setcookie("fname", $fname, $expire);
  setcookie("lname", $lname, $expire);
  setcookie("address", $address, $expire);
  setcookie("dob", $dob, $expire);

  header("location: create-account.php");
}


?>


    <center>
    <div class="container">
        <table border="0">
        <tr>
                <td colspan="2">
                    <p class="header-text">S'inscrire</p>
                    <p class="sub-text">Ajoutez vos informations personnelles pour continuer</p>
                </td>
            </tr>
        <tr>

        <form action="" method="POST" >
                <td class="label-td" colspan="2">
                    <label for="name" class="form-label">Nom: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="text" name="fname" class="input-text" placeholder="First Name" required>
                </td>
                <td class="label-td">
                    <input type="text" name="lname" class="input-text" placeholder="Last Name" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="address" class="form-label">Prenom: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="address" class="input-text" placeholder="Address" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="dob" class="form-label">Date de naissance: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="date" name="dob" class="input-text" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                </td>
            </tr>

            <tr>
                <td>
                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >
                </td>
                <td>
                    <input type="submit" value="Next" class="login-btn btn-primary btn">
                </td>

            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Vous avez déjà un compte&#63; </label>
                    <a href="login.php" class="hover-link1 non-style-link">Se connecter</a>
                    <br><br><br>
                </td>
            </tr>
        </form>
            </tr>
        </table>

    </div>
</center>
</body>
</html>