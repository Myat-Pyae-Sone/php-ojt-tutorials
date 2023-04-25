<?php
require_once '../db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="stylesheet" href="../libs/bootstrap-5.0.2/css/bootstrap.min.css">
</head>

<body>
    <?php
session_start();
$uEmail = $_SESSION['email'];
if (isset($_POST['confirm'])) {
    $newEmail = mysqli_real_escape_string($conn, $_POST['email']); //get sql string
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));
    $comfirmpassword = md5(mysqli_real_escape_string($conn, $_POST['comfirmpassword']));

    if (isset($_SESSION['email'])) {
        if ($password == $comfirmpassword) {
            $sql = "UPDATE users
                    SET `password` = '$password'
                     WHERE (`email` = '$uEmail')";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                echo "<script>alert('Password changes sucessfully..');</script>";
                echo "<script>window.location='login.php'</script>";
            } else {
                echo "<script>alert('Password Changes fail!');</script>";
            }

        } else {
            echo "<script>alert(' Password Unmatch!');</script>";
        }
    } else {
        echo "Email is unmatch! ";
    }
}

?>
    <div class="container">
        <div class="mt-5 d-flex align-items-center justify-content-center mx-auto w-50">
            <div class="card">
                <div class="card-header">
                    <h3>Reset Password</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="<?php echo $uEmail ?>" required>
                            <div class="invalid-feedback">Email field is required.</div>
                        </div>
                        <div class="mb-3">
                            <label for="">New Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter your new Password"
                                class="form-control" required>
                            <div class="invalid-feedback">Password is required.</div>
                        </div>
                        <div class="mb-3">
                            <label for="">Confirm Password</label>
                            <input type="password" name="comfirmpassword" id="comfirmpassword"
                                placeholder="enter your confirm password" class="form-control" required>
                            <div class="invalid-feedback">Confirm Password is required.</div>
                        </div>
                </div>
                <div class="card-footer">
                    <div class="mb-3">
                        <input type="submit" name="confirm" value="Confirm" class="btn btn-primary float-end">
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/script.js"></script>
</body>

</html>