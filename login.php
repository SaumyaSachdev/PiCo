<?php
  session_start();
?>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> LOGIN</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/css?family=Bitter|Josefin+Sans:400,700" rel="stylesheet"> 
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>
</head>

<center>
	<div class="loginc">
		<div class="login-i">
      		<div class="l-logo-t">PiC</div><div class="l-logo-i"><img class="l-logo" src="img/logo3.jpeg"></div>
      	</div>

      	<div id="login1">
    <form method="post" action="process_login.php">
      
        <table>
        <div class="stuff">
      	<tr>
        	<td><label>Username:</label></td>
        	<td><input type="text" placeholder="Enter Username" id="user" name="user"  /></td>
      	</tr>
      	<tr>
        	<td><label>Password:</label></td>
        	<td><input type="password" placeholder="Enter Password" id="pass" name="pass" /></td>
      	</tr>
        </div>
        </table>
      	<button class="btn btn-primary"  type="submit">Login</button>
      
  
    	
    </form>
    </div>
    <center>
    <div id="login1" class="login-op" style="background-color: #d4e6f1">
        	<div class="psw">Forgot <a href="#">password?</a></div>
			     <div class="psw">Don't have an account? <a href="">Sign up</a></div>      
      	</div>
        </center>
 	</div>

 	<span id="error">
  <?php

  if($_SESSION['fu'] == 1){
      echo '<div class="alert alert-danger"><strong>Username or Password is invalid!</strong></div>';
      $_SESSION['fu'] = 0;
  }
  if($_SESSION['fu'] == 2){
      echo '<div class="alert alert-success"><strong>Sucessfully Logged out!</strong></div>';
      $_SESSION['fu'] = 0;
  }
  ?>
</span>
</center>


</html>