<?php

require_once '../db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Setting</title>
    <link rel="stylesheet" href="../libs/bootstrap-5.0.2/css/bootstrap.min.css">
</head>
<style>
    .user-pf {
        width: 60px;
        height: 58px;
    }

    .user-img {
        width: 100px;
        height: 100px;
    }
</style>

<body>
    <?php
    session_start();
    $uEmail = $_SESSION['email'];

    $sql = "SELECT * FROM users
         WHERE email='$uEmail'";
    $query = mysqli_query($conn, $sql);
    $totalRow = mysqli_num_rows($query);
    if ($totalRow == 1) {
        $row = mysqli_fetch_assoc($query); //fetch all data to row from query
        $name = $row['name'];
        $email = $row['email'];
        $userProfile = $row['image'];
    } else {
        header("Location: login.php");
        exit();
    }

    if (isset($_POST['update'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $image = mysqli_real_escape_string($conn, $_FILES['image']['name']);
        $tmp_img = mysqli_real_escape_string($conn, $_FILES['image']['tmp_name']);
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if ($image == '') {
            $image = $userProfile;
        }
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        if ($_SESSION['email'] == $email) {
            $sql = "UPDATE users
                SET `name` = '$name' , `email` = '$email' , `image` = '$image'
                WHERE (`email` = '$email')";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                echo "<script>alert('Successfully Changes..');</script>";
                $_SESSION['userProfile'] = $image;
                header("Location: profile.php");
                exit();
            } else {
                echo "<script>alert('Fail Changes..');</script>";
            }
        } else {
            echo "<script>alert('Do Not Match Email');</script>";
        }
    }

    ?>
    <div class="navbar navbar-light bg-light">
        <?php
        ?>
        <div class="container-fluid w-75">
            <h4>
                <a href="../index.php" class="text-decoration-none text-dark">Home</a>
            </h4>

            <div class="float-end">
                <?php
                if ($userProfile == '') {
                    echo "<img src='../images/default.png' alt='default' class='user-pf rounded-circle'>";
                } else {
                    echo "<img src='../images/" . $userProfile . "' class='user-pf rounded-circle'  alt='user img'>";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="card mt-5 w-50 d-flex align-items-center justify-content-center mx-auto">
        <div class="card-header w-100">
            <h4>My Profile Setting</h4>
        </div>
        <div class="card-body w-100">
            <form action="" method="post" class="needs-validation" enctype='multipart/form-data' novalidate>
                <div class="mb-3 row">
                    <div class="col-md-3">
                        <?php
                        if ($userProfile == '') {
                            echo "<img src='../images/default.png' alt='default' class='user-img rounded-circle'>";
                        } else {
                            echo "<img src='../images/" . $userProfile . "' class='user-img rounded-circle'  alt='user's profile'>";
                        }
                        ?>
                    </div>
                    <div class="col-md-3 mt-5">
                        <input style="display:none" type="file" name="image" id="my-file">
                        <button type="button" class="btn btn-outline-primary rounded-pill" onclick="document.getElementById('my-file').click()">Upload</button>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" placeholder="name" id="name" class="form-control" value="<?php echo $name; ?>" required>
                    <div class="invalid-feedback">Name is required.</div>
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="email" name="email" placeholder="email" id="email" class="form-control" value="<?php echo $email; ?>" required>
                    <div class="invalid-feedback">Email is required.</div>
                </div>
                <div class="mb-3">
                    <input type="submit" name="update" value="Update" class="btn btn-primary float-end">
                </div>
            </form>
        </div>
    </div>
    <script src="../js/script.js"></script>
</body>

</html>