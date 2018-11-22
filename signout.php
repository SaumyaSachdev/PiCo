<?php
 include 'dbconn.php';
session_start();



        	$_SESSION['userid'] = 0;
        	
            $_SESSION['fu'] = 2;
            header('location:login.php');
   


?> 