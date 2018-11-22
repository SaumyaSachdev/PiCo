<?php
include 'dbconn.php';
session_start();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/css?family=Merriweather|Slabo+27px" rel="stylesheet">  
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>
	<title>Home</title>
</head>
<body class="body">

<!--------------------------------------------------TOP NAV------------------------------>
<nav class="top-nav">

	  <table class="nav-ele" >
	  	<tr>

	  	<form class="nav-search" action="search.php" method="get">
  		<td width="60%"><input type="text" class="form-control" name="findp" placeholder="Find People" height="30%"></td>
      	<td width="20%"><button type="submit">&#128270;</button></td>
    	</form>
    	<td width="20%"><button type="button" class="upload-button" class="btn btn-success" onclick="document.getElementById('id01').style.display='block'">Post</button></td> 
	</tr>
	</table>
</nav>
<!-- --------------------------------------SIDE NAV--------------------------- -->
<nav class="side-nav">
<div class="l-o-g-o"><div class="logo-t">PiC</div><div class="the-logo-i"><img class="the-logo" src="img/logo3.jpeg"></div></div>
<?php
session_start();
include 'dbconn.php';
$_SESSION['res']=$_SESSION["userid"];
$_SESSION['cur']=1;
$uid=$_SESSION["userid"];
$sql = "SELECT * FROM users WHERE uid =".$uid;
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
				echo '<div class="con"><img id="dp" src="'.$row["url"].'">';
				#echo '<div class="overlay"><button type="button" class="upload-button" class="btn btn-success" onclick="document.getElementById('id01').style.display='block'"></button></div></div>';
				$name = $row["fname"]." ".$row["lname"];
				$name=strtoupper($name);
				$sql1 = "SELECT * FROM login WHERE uid =".$uid;
				$result1 = mysqli_query($conn, $sql1);
				$row1 = mysqli_fetch_assoc($result1);
				echo '<div class="nav-text">';
				echo '<div id="name">'.$name.'</div>';
				echo '<div id="uname">'.'@'.$row1["uname"].'</div>';
				
    		
			
       	}

?>
	<div id="nav-link">
		<a href="photo.php">Photos</a><br>
		<a href="#">Setting</a><br>
		<a href="signout.php">Sign Out</a>
	</div>
</div>
</div>
</nav>


  
<!-- The Modal -->
  <div id="id01" class="modal">
    <span onclick="document.getElementById('id01').style.display='none'"
  class="close" title="Close Modal">&times;</span>

  <!-- Modal Content -->
    <form class="modal-content animate" method="post" action="upload.php">
      <div class="imgcontainer">
        
      </div>

      <div class="container" id="form">
      <input type="file" name="imageUpload" id="imageUpload">
    
    </div>

      <div class="container" style="background-color:#f1f1f1">
        <button class="submit-pic" type="submit">Upload</button>
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        
      </div>
    </form>
  </div>



<!-- ---------------------------------------------------- Main display -------------------------------->

<div class="main-display">
<center>
<?php
include 'dbconn.php';
session_start();
#echo ' sesssssssssssion '.$_SESSION['userid'];
$sql = "SELECT * FROM posts ORDER BY pid DESC";
$result = mysqli_query($conn, $sql);
$count=0;
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while(($row = mysqli_fetch_assoc($result)) && $count<10) {
      $pid = $row['pid'];
     	echo '<div class="post">';
		echo '<div id = "pic-space"><img id="post-pic" src="'.$row["url"].'"></div>';
    echo '<div class="space">';
    $uid=$_SESSION["userid"];
    $sqldp = "SELECT * FROM users WHERE uid =".$row["uid"];
    $resultdp = mysqli_query($conn, $sqldp);
   
    $rowdp = mysqli_fetch_assoc($resultdp);
      
    
    echo '<div class="cap"><div class="tny-dp"><img id="t-dp" src="'.$rowdp["url"].'"></div><div id="tny-uname">'.$rowdp['fname'].'</div></div>';
    echo '<div class="com-space">';
    echo '<div class="com-in"> <form method="post" action="comment.php"><input type="text" name="comment" id="com-box"><input type="hidden" name="pid" value="'.$pid.'"><button type="submit">&#8827;</button></form></div>';
    
          $sql2 = "SELECT * FROM comments where pid=".$pid.";";
          $result2 = mysqli_query($conn, $sql2);
          if (mysqli_num_rows($result2) > 0) {
              while($row2 = mysqli_fetch_assoc($result2)) {
                $sql3 = "SELECT * FROM users WHERE uid =".$row2['uid']; //selecting user info who commented
                $result3 = mysqli_query($conn, $sql3);
                $row3 = mysqli_fetch_assoc($result3);
                echo '<div class="dis-comm"><div class="com-p"><div class="com-img"><img id="com-img-img" src="'.$row3["url"].'"></div><div class="com-t">'.$row2['ctext'].'</div></div></div>';
              }
          }

    
    echo '</div>';
		echo '</div></div>';
      $count=$count+1; 
    }
}

if($_SESSION["uploaded"]==1){
	$_SESSION["uploaded"]=0;
	echo '<script type="text/javascript"> alert("Photo uploaded sucessfully!!"); </script>';
} else if($_SESSION["uploaded"]==2){
	$_SESSION["uploaded"]=0;
	echo '<script type="text/javascript"> alert("Failed to upload picture!"); </script>';
}
if($_SESSION['res'] == -1){
      echo '<div class="alert alert-danger"><strong>No result!</strong></div>';
      $_SESSION['res'] = 0;
  }


?>

</center>
</div>



</body>
</html>