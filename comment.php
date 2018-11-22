<?php
include 'dbconn.php';
session_start();
 $comment=$_POST['comment'];
 $user=$_SESSION['userid'];
 $pid=$_POST['pid'];



if(isset($_POST['comment'])) {
		$sql= "INSERT INTO comments (pid,uid, ctext) VALUES ('$pid','$user','$comment');";
		if (mysqli_query($conn, $sql)) {
    	header('location:home.php');

	}
}

?>