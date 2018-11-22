<?php
  session_start();
?>
<?php
  $fname = $lname = $uname = $pass = $repass = $city = $country = $dob = $ans = "";
  $ferr = $lerr = $uerr = $perr = $rerr = $cerr = $coerr = $derr = $aerr = "";
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST['fname']))
      $ferr = "Please enter first name.";
    else {
      $fname = testInput($_POST['fname']);
      if(!preg_match("/^[a-zA-Z0-9 ']*$/", $fname))
        $ferr = "Only letters and numbers allowed!";
    }
    if(empty($_POST['lname']))
      $lerr = "Please enter last name.";
    else {
      $lname = testInput($_POST['lname']);
      if(!preg_match("/^[a-zA-Z0-9 ']*$/", $lname))
        $lerr = "Only letters and numbers allowed!";
    }
    if(empty($_POST['uname']))
      $uerr = "Please enter user name.";
    else {
      $uname = testInput($_POST['uname']);
      if(!preg_match("/^[a-zA-Z0-9 ']*$/", $uname))
        $uerr = "Only letters and numbers allowed!";
    }
    if(empty($_POST['password']))
      $perr = "Please enter password.";
    else {
      $pass = testInput($_POST['password']);
      if(!preg_match("/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/", $pass))
        $perr = "Password should have one alphanumeric character, one special character and minimum 6 characters long!";
    }
    if(empty($_POST['password']))
      $rerr = "Please retype password.";
    else {
      $repass = testInput($_POST['password']);
      if($repass != $pass)
        $rerr = "Retyped password does not match.";
    }
    if(empty($_POST['city']))
      $cerr = "Please enter city.";
    else {
      $city = testInput($_POST['city']);
      if(!preg_match("/^[a-zA-Z0-9 ']*$/", $city))
        $cerr = "Only letters and numbers allowed!";
    }
    if(empty($_POST['country']))
      $coerr = "Please enter country.";
    else {
      $country = testInput($_POST['country']);
      if(!preg_match("/^[a-zA-Z0-9 ']*$/", $country))
        $coerr = "Only letters and numbers allowed!";
    }
    if(empty($_POST['dob']))
      $derr = "Please enter date of birth.";

    $ques = $_POST['ques'];

    if(empty($_POST['ans']))
      $aerr = "Please enter an answer to security question.";
    else {
      $ans = testInput($_POST['ans']);
      if(!preg_match("/^[a-zA-Z0-9 ']*$/", $ans))
        $aerr = "Only letters and numbers allowed!";
    }

  }
  function testInput($data) {
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>
<?php
  if(isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $dob = $_SESSION['dob'];
    $city = $_SESSION['city'];
    $country = $_SESSION['country'];
    $uname = $_SESSION['uname'];
    $pass = $_SESSION['passwd'];
    $sid = $_SESSION['sid'];
    $ans = $_SESSION['ans'];
  }
 ?>

<html>
<title>Update Details</title>
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

<body>
  <h2>Enter updated details</h2><br>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
    <label>First Name:</label><input type="text" name="fname" value="<?php echo $fname; ?>"></input>
    <span class="error"> <?php echo $ferr;?></span><br>
    <label>Last Name:</label><input type="text" name="lname" value="<?php echo $lname; ?>"></input>
    <span class="error"> <?php echo $lerr;?></span><br>
    <label>Username:</label><input type="text" name="uname" value="<?php echo $uname; ?>"></input>
    <span class="error"> <?php echo $uerr;?></span><br>
    <label>Password:</label><input type="password" name="password"></input>
    <span class="error"> <?php echo $perr;?></span><br>
    <label>Retype Password:</label><input type="password" name="repassword"></input>
    <span class="error"> <?php echo $rerr;?></span><br>
    <label>Date of birth:</label><input type="date" name="dob"></input>
    <span class="error"> <?php echo $derr;?></span><br>
    <label>Gender: </label><input type="radio" name="gender" value="male" checked>
    Male <input type="radio" name="gender" value="female">Female <input type="radio" name="gender" value="other">Other<br>
    <label>City:</label><input type="text" name="city" value="<?php echo $city; ?>"></input>
    <span class="error"> <?php echo $cerr;?></span><br>
    <label>Country:</label><input type="text" name="country" value="<?php echo $country; ?>"></input>
    <span class="error"> <?php echo $coerr;?></span><br>
    <label>Security Question:</label>
    <select name=ques>
      <option value="1">Question 1</option>
      <option value="2">Question 2</option>
      <option value="3">Question 3</option>
      <option value="4">Question 4</option>
      <option value="5">Question 5</option>
    </select><br>
    <label>Answer:</label><input type="text" name="ans" value="<?php echo $ans; ?>"></input>
    <span class="error"> <?php echo $aerr;?></span><br>
    <button type="submit">Submit</button>
  </form>

  <?php
    include 'dbconn.php';
    $sql = "UPDATE users SET fname='".$fname."', lname='".$lname."', city='".$city."', country='".$country."' WHERE uname='".$uname."'";
    /*if($stmt = mysqli_prepare($conn, $sql) {
      mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $city, $country, $uname);
      mysqli_stmt_execute($stmt);
      echo "User updated";
    } else {
  				echo "ERROR : could not prepare query 1 " . mysqli_error($conn);
  	}*/
    $sql2 = "UPDATE login SET passwd=?, sid=?, ans=? WHERE uname='".$uname."'";
    if($stmt2 = mysqli_prepare($conn, $sql2) {
      mysqli_stmt_bind_param($stmt2, "siss", $pass,$sid,$ans,$uname);
      mysqli_stmt_execute($stmt2);
      echo "User updated";
    } else {
  				echo "ERROR : could not prepare query 1 " . mysqli_error($conn);
  	}

  ?>

</body>
</html>
