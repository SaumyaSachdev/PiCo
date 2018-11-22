<?php
  session_start();
?>
<html>
<title>Update details</title>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/css?family=Bitter|Josefin+Sans:400,700" rel="stylesheet">
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>
</head>

<?php
  $pass = $uname = "";
  $perr = $uerr = "";

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['uname'])) {
			$uerr = "Username is reqired!";
		} else {
			$uname = testInput($_POST['uname']);
			if(!preg_match("/^[a-zA-Z0-9 .'!]*$/", $uname)) {
				$uerr = "Only letters and numbers allowed!";
			}
		}
    if(empty($_POST['pass'])) {
      $perr = "Please enter password.";
    } else {
      $pass = testInput($_POST['pass']);
    }
  }
  function testInput($data) {
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>

<body>
  <h2>Enter username:</h2><br>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
    <label>Username:</label><input type="text" name="uname"></input>
    <span class="error"><?php echo $uerr;?></span><br>
    <label>Password:</label><input type="password" name="pass"></input>
    <span class="error"><?php echo $perr;?></span><br>
    <button type="submit">Find</button><?php echo "<br>"; ?>

  </form>
</body>
<?php
  include 'dbconn.php';
  $check = "SELECT * FROM users WHERE uname='" . $uname . "'";
  $check2 = "SELECT * FROM login WHERE uname='" . $uname . "'";
  $result = mysqli_query($conn, $check);
  $result2 = mysqli_query($conn, $check2);
  $row = mysqli_fetch_assoc($result);
  $row2 = mysqli_fetch_assoc($result2);
  if($pass = $row2['passwd']) {
     if (isset($row['uid'])) {
        $_SESSION['uid'] = $row['uid'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['dob'] = $row['dob'];
        $_SESSION['city'] = $row['city'];
        $_SESSION['country'] = $row['country'];
        $_SESSION['uname'] = $uname;
        $_SESSION['passwd'] = $row2['passwd'];
        $_SESSION['sid'] = $row2['sid'];
        $_SESSION['ans'] = $row2['ans'];
		     header("Location: update2.php");
         //echo "username: ".$uname."<br>";
         //echo "row: ".$row['uname']."<br>";
         //echo "User found";
		     //exit();
	      }
        else if(empty($row)){
          echo "Username not found";
        }
    } else {
      echo "Password incorrect!";
    }
?>


</html>
