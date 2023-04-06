<?php
$errorMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["qrName"])) {
        $errorMessage = "QR name field is required";
    } else {
        $qrCode = $_POST["qrName"];
    }
}
