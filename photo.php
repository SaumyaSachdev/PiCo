
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/styles2.css"> 
  <link href="https://fonts.googleapis.com/css?family=Merriweather|Slabo+27px" rel="stylesheet">  
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>
	<title>Photos</title>
</head>
<body class="photo-body">
<!--------------------------------------------------TOP NAV------------------------------>
<nav class="top-nav">
	  <table class="nav-ele" >
	  	<tr>
	  	<form class="nav-search" action="search.php" method="get">
  		<td width="40%"><input type="text" class="form-control" name="findp" placeholder="Find People" /></td>
      	<td width="20%"><button type="submit">Search</button></td>
    	</form>
    	<!-- <td width="20%"><button type="button" class="upload-button" class="btn btn-success" onclick="document.getElementById('id01').style.display='block'">Post</button></td> -->
	</tr>
	</table>
  <div class="l-o-g-o"><div class="logo-t">PiC</div><div class="the-logo-i"><img class="the-logo" src="img/logo3.jpeg"></div></div>
</nav>
<!-- --------------------------------------SIDE NAV--------------------------- -->
<!-- <nav class="dp-dis">
<?php
/*session_start();
include 'dbconn.php';
$_SESSION['cur']=2;
$uid=$_SESSION["res"];
		$sql = "SELECT * FROM users WHERE uid =".$uid;
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
				echo '<div class="dis-con"><img id="dp-img" src="'.$row["url"].'">';
				#echo '<div class="overlay"><button type="button" class="upload-button" class="btn btn-success" onclick="document.getElementById('id01').style.display='block'"></button></div></div>';
				$name = $row["fname"]." ".$row["lname"];
				$name=strtoupper($name);
				$sql1 = "SELECT * FROM login WHERE uid =".$uid;
				$result1 = mysqli_query($conn, $sql1);
				$row1 = mysqli_fetch_assoc($result1);
				echo '<div class="dis-text">';
				echo '<div id="dis-name">'.$name.'</div>';
				echo '<div id="dis-uname">'.'@'.$row1["uname"].'</div>';
				
    		
			
       	}
       		
*/
?>	
	</div>
</div>
</nav> -->

	<div class="boo">

  <div class="wasting-space"></div>
       	<?php
       	include 'dbconn.php';
	session_start();
#echo ' sesssssssssssion '.$_SESSION['userid'];

	if($_SESSION['res'] != -1){
     //  echo '<div class="other-pic-con">';
$sql = "SELECT * FROM posts where uid=".$_SESSION['res']." ORDER BY pid DESC;";
$result = mysqli_query($conn, $sql);
$count=0;
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while(($row = mysqli_fetch_assoc($result))) {
     	//echo '<center>';
     	
     	$pid= $row['pid'];
		//echo '<div id = "pic-con"><img class="the-pic" src="'.$row["url"].'"></div>';
		// echo '</div>';
      	//echo '</center>';
		echo '<div class="pics">';
		
      	echo '<div class="container2"><center><img src="'.$row["url"].'" class="image2"></center><div class="overlay2"><div class="text2">';


    echo '<div class="com-space com-space-d">';
    echo '<div class="com-in com-in-d"> <form method="post" action="comment.php"><input type="text" name="comment" id="com-box"><input type="hidden" name="pid" value="'.$pid.'"><button type="submit">&#8827;</button></form></div>';//com-in
    
          $sql2 = "SELECT * FROM comments where pid=".$pid." ORDER BY cid DESC;";
          $result2 = mysqli_query($conn, $sql2);
          if (mysqli_num_rows($result2) > 0) {
              while($row2 = mysqli_fetch_assoc($result2)) {
                $sql3 = "SELECT * FROM users WHERE uid =".$row2['uid']; //selecting user info who commented
                $result3 = mysqli_query($conn, $sql3);
                $row3 = mysqli_fetch_assoc($result3);
                echo '<div class="dis-comm dis-comm-d"><div class="com-p" ><div class="com-img com-img-p"><img id="com-img-img" src="'.$row3["url"].'"></div><div class="com-t com-t-d">'.$row2['ctext'].'</div></div></div>';//t,p,dis-com closes
              }
          }

    
    echo '</div>';//com space
		echo '</div></div>';//text2,overlay2

      	echo ' </div></div>';//container2,pics
      	
      	//echo '</div>';
    }
}
	//echo '</div>';
}
		?>
</div>

<div class="det-ails" >
      <?php
      include 'dbconn.php';
      session_start();


      if($_SESSION['res'] != -1){
    
    $sqlbo = "SELECT * FROM users where uid=".$_SESSION['res'].";";
    $resultbo = mysqli_query($conn, $sqlbo);
    $count=0;
    if (mysqli_num_rows($resultbo) > 0) {
    // output data of each row
      while(($rowbo = mysqli_fetch_assoc($resultbo))) {
        echo '<div id="bo-img"><img id="bo-dp" src="'.$rowbo["url"].'"></div>';
        $name = $rowbo["fname"]." ".$rowbo["lname"];
        $name=strtoupper($name);
        echo '<div id="bo-con"><div id="bo-name">'.$name.'</div>';
        echo '<div id="bo-city">'.$rowbo["city"].'</div>';
        echo '<div id="bo-indi">'.$rowbo["country"].'</div>';
        echo '</div>';//bo-con
      }
  
    }
  }
    ?>  


</div>

</body>
</html>

<?php
include 'dbconn.php';
session_start();
if($_SESSION['res'] == -1){
      echo '<div class="alert alert-danger"><strong>No result!</strong></div>';
      $_SESSION['res'] = 0;
  }

?>