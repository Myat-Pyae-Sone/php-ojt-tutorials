<?php
require_once '../db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="../libs/bootstrap-5.0.2/css/bootstrap.min.css">
</head>

<body>
    <?php

    session_start();
    if (isset($_POST['register'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']); //get sql string
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $password = md5(mysqli_real_escape_string($conn, $_POST['password']));
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $sql = "SELECT * FROM users
             WHERE name='$name'";
        $query = mysqli_query($conn, $sql); //get connection
        if ($query) {
            $totalRow = mysqli_num_rows($query); //total row in query
            if ($totalRow > 0) {
                $_SESSION['message'] = "User account Already Created";
                echo "<script>window.location='register.php'</script>";
                exit(0);
            } else {
                $sql = "INSERT INTO users ( `name`, `email`,`phone`,`password`,`address`)
                    VALUES ('$name', '$email','$phone','$password','$address')";
                $query = mysqli_query($conn, $sql);

                if ($query) {
                    $_SESSION['message'] = "User account Created Successfully...";
                    echo "<script>window.location='login.php'</script>";
                    exit(0);
                } else {
                    $_SESSION['message'] = "Fail account Creating !";
                    echo "<script>window.location='../index.php'</script>";
                }
            }
        }
    }

    ?>
    <div class="container w-75 mt-5 ">
        <?php
        if (isset($_SESSION['message'])) : ?>
            <div class="col-6 offset-3 alert alert-danger alert-dismissible fade
    show d-flex align-items-center justify-content-center mx-auto" role="alert">
                <?= $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['message']);
        endif; ?>
        <div class="card text-dark col-6 offset-3">
            <div class="card-header">
                <h1>Register</h1>
            </div>
            <div class="card-body">
                <form action="" method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" required class="form-control" placeholder="Name" aria-label="Username">
                        <div class="invalid-feedback">Name is required.</div>
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" required class="form-control" placeholder="name@example.com" aria-label="Username">
                        <div class="invalid-feedback">Email is required!</div>
                    </div>
                    <div class="mb-3">
                        <label for="">Phone</label>
                        <input type="text" name="phone" required class="form-control" placeholder="09**********" aria-label="Username">
                        <div class="invalid-feedback">Phone is required!</div>
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" name="password" required class="form-control" placeholder="Password" aria-label="Username">
                        <div class="invalid-feedback">Password is required!</div>
                    </div>
                    <div class="mb-3">
                        <label for="">Address</label>
                        <input type="text" name="address" required class="form-control" placeholder="Address" aria-label="Username">
                        <div class="invalid-feedback">Address is required!</div>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary w-100" value="Register" name="register">
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <p> <a href="login.php" class="text-primary text-decoration-none">Already Have an account ?</a></p>
            </div>
        </div>
    </div>
    <script src="../js/script.js"></script>
</body>

</html>