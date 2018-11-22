 <?php
 include 'dbconn.php';
session_start();


$rn =0;

$username = $_POST['user'];
$password = $_POST['pass'];

$sql = "SELECT * FROM login";
$result = mysqli_query($conn, $sql);
$rn=0;
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
       // echo "userid: " . $row["userid"]. "  password " . $row["passwd"]. " " . "<br>";
        //echo "entered userid: $username Password: $password <br>";
        if ($row["uname"] == $username && $row["passwd"] == $password) {
        	//echo "yassssssssssssssss!!!1 <br>";
        	$_SESSION['userid'] = $row["uid"];
        	header('location:home.php');

        $rn = 1;
        }

        
    }
} 
if ($rn ==0) {
            $_SESSION['fu'] = 1;
            header('location:login.php');
    }




?> 