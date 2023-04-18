<?php
$servername = "localhost";
$username = "root";
$password = "myat2000";
$dbname = "db_store";

$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
    die(mysqli_connect_error($conn));
}
$sql = "CREATE TABLE IF NOT EXISTS `lists` (
  id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(225) NOT NULL,
  content VARCHAR(225) NOT NULL,
  is_published VARCHAR(10),
  created_datetime timestamp default current_timestamp,
  updated_datetime timestamp default current_timestamp
  )";

if (mysqli_query($conn, $sql)) {
//echo "table created successfully";
}
