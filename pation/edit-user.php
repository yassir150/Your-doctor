<?php
    if (!isset($_COOKIE['user_email']) || !isset($_COOKIE['user_type']) || $_COOKIE['user_type'] != 'p') {
        header("location: ../login.php");
        exit;
      }
    include("../connection.php");

    if($_POST){
        $result= $database->query("select * from webuser");
        $name=$_POST['name'];
        $lname=$_POST['prenom'];
        $oldemail=$_POST["oldemail"];
        $address=$_POST['address'];
        $email=$_POST['email'];
        $tele=$_POST['Tele'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $id=$_POST['id00'];
        
        if ($password==$cpassword){
            $error='3';

            $sqlmain= "select patient.pation_id from patient inner join webuser on patient.pation_email=webuser.email where webuser.email=?;";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("s",$email);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows==1){
                $id2=$result->fetch_assoc()["pation_id"];
            }else{
                $id2=$id;
            }
            

            if($id2!=$id){
                $error='1';

                    
            }else{

                $sql1="update patient set pation_email='$email',pation_name='$name',pation_password='$password',pation_tel='$tele',pation_address='$address',pation_prenom='$lname' where pation_id=$id ;";
                $database->query($sql1);
                echo $sql1;
                $sql1="update webuser set email='$email' where email='$oldemail' ;";
                $database->query($sql1);
                echo $sql1;
                $error= '4';
                
            }
            
        }else{
            $error='2';
        }
        
    }else{
        $error='3';
    }
    

    header("location: settings.php?action=edit&error=".$error."&id=".$id);
    ?>
    
   

</body>
</html>