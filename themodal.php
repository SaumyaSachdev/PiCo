<?php
session_start();
$_SESSION['yay'] = $_POST['pid'];
header('location:photo.php');
?>