<?php
include "generate.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generate QR code</title>
  <link rel="stylesheet" href="libs/bootstrap-5.2.3-dist/css/bootstrap.min.css">
</head>

<body>
  <div class="card col-4 offset-4 mt-3">
    <div class="card-header">
      <h1>QR code Generator</h1>
    </div>
    <div class="card-body">
      <form action="" method="POST" enctype="multipart/form-data">
        <label for="">QR Name</label>
        <input type="text" class="form-control mt-2" name="qrName" id="" placeholder="Enter QR name">
        <small class="text-danger"><?php echo $errorMessage; ?></small>
        <input type="submit" name="create" class="btn btn-primary mt-2 w-100" value="Genterate">
      </form>
    </div>
  </div>
</body>

</html>
<?php

if (isset($_POST['create'])) {
    $qrCode = $_POST["qrName"];
    require_once 'libs/phpqrcode/qrlib.php';
    $path = 'images/';
    $code = $path . $qrCode . ".png";
    if (!file_exists($code)) {
        QRcode::png($qrCode, $code, 'H', 6, 6);
        echo "<p class='text-center mt-4'><img src='$code' ></p>";

    } else {
        echo "<p class='text-center w-25 ms-auto me-auto mb-2'><img src='$code' class='w-50' ></p";
    }
}

echo "<br>";
echo "<div class='card col-8 offset-2 mt-2'>";
echo "<div class='card-header bg-light p-3'>";
echo "<h2 class=' bg-light'>QR List</h2>";

$target_dir = "images/";
$file = scandir($target_dir);
echo "<div class='card-body bg-white'>";
for ($i = 0; $i < count($file); $i++) {
    if ($file[$i] != '.' && $file[$i] != '..') {
        $filePath = 'images/$fileName/$fileImage[$i]';
        echo "<div class='w-25 d-inline-block bg-white'>";
        echo "<img src='$target_dir$file[$i]' class='ms-5 w-75'>";
        echo "<p class='text-center'>$file[$i]</p>";
        echo "</div>";
    }
}
echo "</div>";
echo "</div>";
echo "</div>";