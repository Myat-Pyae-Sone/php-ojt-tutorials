<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Image Upload</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="libs/bootstrap-5.0.2/css/bootstrap.min.css">
    <style>
    .img-size {
        height: 200px;
    }
    </style>
</head>

<body>
    <div class="container col-10">
        <div class="col-5 mx-auto my-5">
            <div class="alert-info p-4 my-3 text-primary
                <?php echo empty($_SESSION['alertMessage']) ? 'collapse' : '' ?>">
                <?php echo $_SESSION['alertMessage']; ?>
            </div>
            <div class="card">
                <h1 class="text-center p-3 bg-light">Upload Image</h1>
                <form action="upload.php" class="px-3 py-3" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="folder" class="form-label">Folder Name</label>
                        <input type="text" class="form-control
                    <?php echo isset($_SESSION['errorMessage']['folder']) ? "is-invalid" : ""; ?>"
                            value="<?php echo !empty($_SESSION['folderName']) ? $_SESSION['folderName'] : ""; ?>"
                            name="folder" placeholder="Enter folder Name...">
                        <div class="invalid-feedback">
                            <?php echo $_SESSION['errorMessage']['folder']; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Choose Image</label>
                        <input type="file" name="image" id="image" class="form-control
                    <?php echo isset($_SESSION['errorMessage']['image']) ? "is-invalid" : ""; ?>
                    ">
                        <div class="invalid-feedback">
                            <?php echo $_SESSION['errorMessage']['image']; ?>
                        </div>
                    </div>
                    <input type="submit" value="Upload" class="btn btn-primary w-100" name="upload">
                </form>
            </div>
        </div>
        <div class="row m-auto bg-light">
            <?php

ob_start();
$files = glob('images/*/*.{jpg,jpeg,png}', GLOB_BRACE);
foreach ($files as $file): ?>
            <?php $folder = basename(dirname($file));?>
            <div class="col">
                <div class='card m-auto w-75 d-flex flex-column me-2 mt-4 ms-5 mt-3'>
                    <img class='img-size' src='<?php echo $file; ?>' class='w-100 mt-3 '>
                    <p class='text-center mb-0 fs-4'><?php echo $folder; ?></p><br>
                    <p class='ms-2 mt-0 w-100'><a href='<?php echo $file; ?>'
                            class=' mt-0 '>localhost/php-ojt-tutorials/Tutorial_06/<?php echo $file ?></a></p>

                    <form method='post' class='w-100'>
                        <input type='hidden' name='file_path' value='<?php echo $file; ?>'>
                        <input type='submit' class='w-100 p-2 text-dark btn btn-danger border-0 mb-2' name='delete'
                            value='delete'>
                    </form>
                </div>
            </div>
            <?php endforeach;?>
            <?php if (isset($_POST['delete'])) {
    $filePath = $_POST['file_path'];
    if (file_exists($filePath)) {
        unlink($filePath);
        header("Refresh:0");
    }
}
ob_end_flush(); //delete file

?>
        </div>
    </div>
</body>

</html>

<?php
unset($_SESSION['errorMessage']);
unset($_SESSION['alertMessage']);
unset($_SESSION['folderName']);
?>