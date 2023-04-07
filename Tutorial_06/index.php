<?php
include 'upload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Image Upload</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="lib/boostrap/css/bootstrap.min.css">

</head>

<body>
  <div class="card col-4 offset-4 mt-5">
    <div class="card-header">
      <h1 class="mt-2 text-center fs-3">Upload Image</h1>
    </div>
    <div class="card-body ">
      <form class="needs-validation form-group" action="" method="POST" novalidate enctype="multipart/form-data">
        <label class="form-label">Folder Name</label>
        <input type="text" name="file" id="" class="form-control" placeholder="Enter Folder Name" required>
        <small class="invalid-feedback">folder name field is required! </small>
        <label class="form-label mt-3">Choose Image</label>
        <input type="file" name="fileimg" id="" class="form-control" aria-label="file example" required>
        <small class="invalid-feedback">Image name field is required! </small>
        <input type="submit" value="Upload" name="upload" class="btn btn-primary text-light w-100 mt-3 border-0">
      </form>
    </div>
  </div>
  <script src="lib/boostrap/js/form_validation.js"></script>
</body>

</html>

<?php
echo "<div class='card col-8 offset-2 mt-3 bg-light' >";
$files = glob('images/*/*.jpg'); //find file path
echo "<div class='ms-2 ps-2 mt-5'>";
foreach ($files as $file) {
    $folder = basename($file); //file name from path
    echo "<div class='d-inline-block ms-3'>";
    echo "<img src='$file' class='w-100 ms-2  p-3 me-2' style='height:250px'>";
    echo "<p class=' mb-0 ms-5 fs-5'>$file</p><br>";
    echo "<p class='mt-0 w-100 ms-2 p-3 me-2'><a href='$file' class=' mt-2 '>localhost/Tutorial_06/$file</a></p>";

    echo "<form method='post' class='w-100'>";
    echo "<input type='hidden' name='file_path' value='$file'>";
    echo "<input type='submit' class='btn btn-danger w-100   mb-3 pt-2 pb-3  text-dark' name='delete' value='Delete'>";
    echo "</form>";
    echo "</div>";
}
echo "</div>";
if (isset($_POST['delete'])) {
    $filePath = $_POST['file_path'];
    if (file_exists($filePath)) {
        unlink($filePath); //delete a file
        header("Refresh:0");
        ob_end_flush();
    }
}