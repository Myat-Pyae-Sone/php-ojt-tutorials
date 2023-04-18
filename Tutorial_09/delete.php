<?php
require_once "db.php";
if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
    $sql = "DELETE FROM Lists WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>window.location.href='index.php'</script>";
    } else {
        echo "<script>alert('Error deleting data.')</script>";
    }
}
