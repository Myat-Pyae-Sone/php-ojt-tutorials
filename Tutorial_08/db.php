<?php
$servername = "localhost";
$username = "root";
$password = "myat2000";
$dbname = "db_store";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    //echo "Connection establish";
}

$sql = "CREATE TABLE IF NOT EXISTS `lists` (
  id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  content TEXT(255) NOT NULL,
  is_published VARCHAR(55),
  created_datetime TIMESTAMP DEFAULT current_timestamp,
  updated_datetime TIMESTAMP DEFAULT current_timestamp
  )";

if (!mysqli_query($conn, $sql)) {
    echo " created fail" . mysqli_connect_error();
}
