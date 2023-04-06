<?php

if (isset($_POST['upload'])) {
    $folderName = $_POST['file'];
    $path = "images/$folderName";
    if (!file_exists($path)) {
        $newFolder = mkdir("images" . "/$folderName", 0777, true); //create directory of folder
        $imgName = $_FILES['fileimg']['name'];
        $tmp = $_FILES['fileimg']['tmp_name'];
        $target_file = "images/$folderName/" . $imgName;
        $image_file = "images/$folderName/$imgName";
        if (file_exists("images/$folderName/$imgName")) {
            echo "<script>alert('Your image is already exit.')</script>";
        } else {
            if (move_uploaded_file($tmp, $target_file)) {
                move_uploaded_file($tmp, $target_file);
                echo "<p class='alert alert-info  col-4 offset-4 mt-3  p-3 text-primary'>Upload Image Successfully!</p>";
            } else {
                echo "error";
            }
        }
    }
}
