<?php
  $_SESSION['fu'] = 0;
  $servername = "localhost";
  $username = "root";
  $password = "t00tTooT";
  $dbname = "web";


  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);


  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }


  ?>