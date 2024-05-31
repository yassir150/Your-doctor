<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/login.css">
        
    <title>Login</title>

    
    
</head>
<body>
    <?php
    include("connection.php");

    if($_POST){

        $email=$_POST['useremail'];
        $password=$_POST['userpassword'];
        
        $error='<label for="promter" class="form-label"></label>';

        $result= $database->query("select * from webuser where email='$email'");
        if($result->num_rows==1){
            $utype=$result->fetch_assoc()['usertype'];
            if ($utype=='p'){
                $checker = $database->query("select * from patient where pation_email='$email' and pation_password='$password'");
                if ($checker->num_rows==1){

                    $expire = time() + 60 * 60;
                    setcookie("user_email", $email, $expire);
                    setcookie("user_type", "p", $expire);

                    header('location: pation/index.php');

                }else{
                    $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }

            }elseif($utype=='a'){
                //TODO
                $checker = $database->query("select * from admin where admin_email='$email' and admin_password='$password'");
                if ($checker->num_rows==1){
                    $expire = time() + 60 * 60;
                    setcookie("user_email", $email, $expire);
                    setcookie("user_type", "a", $expire);
                    
                    header('location: administrateur/index.php');

                }else{$error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';}
    
            }else{
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We cant found any acount for this email.</label>';}
        }  
    }else{
        $error='<label for="promter" class="form-label">&nbsp;</label>';
    }

    ?>





    <center>
    <div class="container">
        <table border="0" style="margin: 0;padding: 0;width: 60%;">
            <tr>
                <td>
                    <p class="header-text">Content de te revoir!</p>
                </td>
            </tr>
        <div class="form-body">
            <tr>
                <td>
                    <p class="sub-text">Connectez-vous avec vos coordonnées pour continuer</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td">
                    <label for="useremail" class="form-label">Email: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="email" name="useremail" class="input-text" placeholder="Email Address" required>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <label for="userpassword" class="form-label">Password: </label>
                </td>
            </tr>

            <tr>
                <td class="label-td">
                    <input type="Password" name="userpassword" class="input-text" placeholder="Password" required>
                </td>
            </tr>


            <tr>
                <td><br>
                <?php echo $error ?>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Login" class="login-btn btn-primary btn">
                </td>
            </tr>
            </div>
            <tr>
                <td>
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">vous n'avez pas de compte ?&#63; </label>
                    <a href="signup.php" class="hover-link1 non-style-link">S'inscrire</a>
                    <br><br><br>
                </td>
            </tr>           
        </form>
        </table>

    </div>
</center>
</body>
</html>