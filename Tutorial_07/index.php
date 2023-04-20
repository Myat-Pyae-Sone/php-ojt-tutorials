<?php session_start()?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate QR Code </title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="libs/bootstrap-5.0.2/css/bootstrap.min.css">
</head>
<style>
</style>

<body>
    <div class="card col-4 offset-4 mt-5 mb-3">
        <div class="card-header text-center">
            <h4>QR Code Generator</h4>
        </div>
        <div class="card-body">
            <form action="generate.php" method="POST" class="form-group p-3 needs-validation" novalidate
                enctype="multipart/form-data">
                <label for="" class="form-label">QR Name</label>
                <input type="text"
                    class="form-control  <?php echo (isset($_SESSION['errorMessage'])) ? 'is-invalid' : ""; ?>"
                    name="qrName" value="<?php echo isset($_SESSION['qrName']) ? $_SESSION['qrName'] : ''; ?>"
                    placeholder="Enter QR Name" required>
                <small class="invalid-feedback">
                    <?php echo $_SESSION['errorMessage']; ?>
                </small>
                <button type="submit" name="generate" class="btn btn-primary mt-4 w-100">Generate</button>
            </form>
        </div>
    </div>
    </div>
    </div>
    <div class="col-sm-2 text-center m-auto mb-2 mt-4">
        <div class="card w-75 ms-4 text-center <?php echo empty($_SESSION['generatedImg']) ? 'collapse' : '' ?> ">
            <img src="images/<?php echo (isset($_SESSION['generatedImg'])) ? $_SESSION['generatedImg'] : '' ?>   "
                alt="qrCode">
        </div>
    </div>
    <div class=" card w-50 m-auto mt-4">
        <div class="card-header bg-light">
            <h3>QR List</h3>
        </div>
        <div class="card-body row">
            <?php
$folder_dir = 'images/'; //folder_directory of img
$img = scandir($folder_dir);?>
            <?php for ($i = 0; $i < count($img); $i++): ?>
            <?php if ($img[$i] != '.' && $img[$i] != '..'): ?>
            <?php $filePath = 'images/$imgName/$fileImage[$i]';?>
            <div class='col-sm-4 '>
                <div class='card m-4'>
                    <p class='text-center'><img src='<?php echo $folder_dir . $img[$i] ?>' alt='Image' class=' w-75'>
                    </p>
                    <p class='text-center mb-0 pb-3'><?php echo $img[$i] ?></p>
                </div>
            </div>
            <?php endif;?>
            <?php endfor;?>
        </div>
    </div>
</body>

</html>
<?php
unset($_SESSION['errorMessage']);
unset($_SESSION['generatedImg']);
?>