<?php
require_once "db.php";
$sql = "CREATE TABLE IF NOT EXISTS `user` (
  id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE ,
  password VARCHAR(255) NOT NULL,
  phone VARCHAR(255) NOT NULL,
  image VARCHAR(255) ,
  address TEXT(255) NOT NULL,
  created_datetime TIMESTAMP DEFAULT current_timestamp,
  updated_datetime TIMESTAMP DEFAULT current_timestamp
  )";

if (!mysqli_query($conn, $sql)) {
    echo "fail" . mysqli_connect_error();
}
