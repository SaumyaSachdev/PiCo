<?php 
session_start();
include 'dbconn.php';
$key = $_GET['findp'];
echo "key is ".$_GET['findp'];

$key=strtolower($key);
echo " <br>to lower ".$key;

$sql = "SELECT * FROM users;";
$result = mysqli_query($conn, $sql);
$rn=0;


if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<br>we in!!";     
        $name = $row["fname"]." ".$row["lname"];
				$name=strtolower($name);
        echo "<br>   ".$name;
       if (strpos($name, $key) !== false ) {
        	echo "yassssssssssssssss!!!1 <br>";
       	$_SESSION['res'] = $row["uid"];
        	header('location:photo.php');

        
        }
        else {
            
        	$_SESSION['res'] = -1;
          //  header('location:home.php');
        	/*if($_SESSION['cur']==1)
        		header('location:home.php');
        	else if($_SESSION['cur']==2)
        	//	header('location:photo.php');
*/

        }

        
    }
} 
?>