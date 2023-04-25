<?php
require_once '../db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="../libs/bootstrap-5.0.2/css/bootstrap.min.css">
</head>

<body>
    <?php
    session_start();

    if (isset($_POST['login'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $userPwd = mysqli_real_escape_string($conn, $_POST['password']);
        $password = md5($userPwd);
        $sql = "SELECT * FROM users WHERE email='$email' and password='$password'";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            $totalRow = mysqli_num_rows($query);
            if ($totalRow > 0) {
                $_SESSION['email'] = $email;
                echo "<script>alert('Login Successfully...');</script>";
                echo "<script>window.location='../index.php'</script>";
                exit(0);
            } else {
                echo "<script>window.location='login.php'</script>";
                exit(0);
            }
        }
    }

    ?>
    <div class="container w-75 mt-5 ">
        <div class="card text-dark col-6 offset-3">
            <div class="card-header">
                <h1>Login</h1>
            </div>
            <div class="card-body">
                <form action="login.php" method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" required class="form-control" placeholder="example@gmail.com" aria-label="email">
                        <div class="invalid-feedback">Email is required.</div>
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" name="password" required class="form-control" placeholder="password" aria-label="password">
                        <div class="invalid-feedback">Password is required.</div>
                        <a href="forget_password.php" class="text-decoration-none mt-3">forget password?</a>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary w-100" value="Login" name="login">
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <p>Not a member ? <a href="register.php" class="text-primary text-decoration-none">Sign Up</a></p>
            </div>
        </div>
    </div>
    <script src="../js/script.js"></script>
</body>

</html>