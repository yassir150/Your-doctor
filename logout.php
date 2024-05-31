<?php 
	if (isset($_COOKIE['user_email']) || isset($_COOKIE['user_type'])) {
		setcookie("user_email", "",time()-3600);
		setcookie("user_type", "",time()-3600);
      }
	header('Location: login.php');

 ?>