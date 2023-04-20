<?php

session_start();
if (isset($_POST['upload'])) {
    $folderName = $_POST['folder'];
    $imageName = $_FILES['image'];

    //old value
    $_SESSION['folderName'] = $folderName;

    if (!empty($folderName) && !empty($imageName['name'])) {

        //image extention validate
        $allowedExt = array('jpg', 'jpeg', 'png');
        $imgExt = strtolower(pathinfo($imageName['name'], PATHINFO_EXTENSION));

        if (!in_array($imgExt, $allowedExt)) {
            $_SESSION['errorMessage']['image'] = 'Image file extension must be jpg, jpeg or png.';
            header('Location: index.php');
            exit();
        }

        //Save image
        $folderPath = "images/$folderName";
        if (!is_dir($folderPath)) {
            mkdir($folderPath);
        }
        $imageFile = basename($imageName['name']);
        $targetFile = $folderPath . '/' . $imageFile;

        //if same image exists
        if (file_exists($targetFile)) {
            $_SESSION['errorMessage']['image'] = 'Image file already exists!';
            header('Location: index.php');
            exit();
        }

        if (move_uploaded_file($imageName['tmp_name'], $targetFile)) {
            $_SESSION['alertMessage'] = 'Upload Image Successfully!';
            unset($_SESSION['folderName']);
            header('Location: index.php');
        } else {
            $_SESSION['errorMessage']['image'] = 'Upload  Failed!';
            header('Location: index.php');
        }

        //image size validate
        $fileSize = $_FILES['image']['size'];
        if ($fileSize > 2097152) {
            $_SESSION['errors']['image'] = 'Image file size must be less than 2 MB.';
            header('Location: index.php');
            exit();
        }

    } else {
        if (empty($folderName['folder'])) {
            $_SESSION['errorMessage']['folder'] = 'folder name field is required.';
        }
        if (empty($imageName['name'])) {
            $_SESSION['errorMessage']['image'] = 'image name field is required.';
        }
        header('Location: index.php');
    }
}
