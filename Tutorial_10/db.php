<?php
$servername = "localhost";
$username = "root";
$password = "myat2000";
$dbname = "auth";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed " . mysqli_connect_error());
} else {
    //echo "Connection Successfull";
}
