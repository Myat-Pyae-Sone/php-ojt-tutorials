<?php
session_start();
require "libs/phpqrcode/qrlib.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['qrName'])) {
        $name = $_POST["qrName"]; //user input
        $_SESSION['qrName'] = $name;
        if (!empty($name)) {
            if (file_exists('images/' . $name . '.png')) {
                $_SESSION['errorMessage'] = "QR name already exist!";
                header("Location: index.php");
                exit();
            }
            $_SESSION['generatedImg'] = $name . ".png"; //generate images
            QRcode::png($name, "images/" . $_SESSION['generatedImg']);
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['errorMessage'] = "QR name field is required!";
            header('Location:index.php');
            exit();
        }
    }
}