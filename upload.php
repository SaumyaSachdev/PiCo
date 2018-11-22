<?php
session_start();
include 'dbconn.php';
echo "".$_POST["imageUpload"];
if(isset($_POST['imageUpload'])) {
echo "we in";
    //Process the image that is uploaded by the user

    $target_dir = "img/";
    $image = $target_dir . $_POST["imageUpload"];
    echo "<br> ".$image;
    $user=$_SESSION['userid'];
    $sql= "INSERT INTO posts (uid, url) VALUES ('$user','$image');";
    if (mysqli_query($conn, $sql)) {
    $_SESSION['uploaded']=1;
	} else {
    $_SESSION['uploaded']=2;
	}

	
    
    
    header("location:home.php");
}

?>
