<?php
require_once '../db.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
require '../libs/phpmailer/src/Exception.php';
require '../libs/phpmailer/src/PHPMailer.php';
require '../libs/phpmailer/src/SMTP.php';

if (isset($_POST["reset"])) {
    $email = $_POST["email"];
    $sql = "SELECT * FROM user
        WHERE email='" . $email . "'";
    $query = mysqli_query($conn, $sql);
    $totalRow = mysqli_num_rows($query); //total row
    if ($totalRow > 0) {
        $_SESSION['email'] = $email;
        $mail = new PHPMailer(true);
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'myatpyaesone007@gmail.com';
        $mail->Password = 'aulpznhytrsnmnaj';
        $mail->setFrom('myatpyaesone007@gmail.com');
        $mail->addAddress($_POST['email']);
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->isHTML(true);

        $mail->Subject = "send your password";
        $mail->Body = "<b>Dear User</b>
        <h3>We received a request to reset your password.</h3>
        <p>Kindly click the below link to reset your password</p>
        http://localhost/php-ojt-tutorials/Tutorial_10/auth/reset_password.php?email= " . $_SESSION['email'] . "
        <br><br>
        <b>Hello</b>";
        $mail->send();
        echo "<script>alert('Message Sent');</script>";
    } else {
        echo "Fail";
    }
}

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
    <div class="container">
        <div class="w-50 d-flex align-items-center mx-auto mt-5 justify-content-center ">
            <div class="card w-75">
                <div class="card-header">
                    <h3> Forget Password</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="email_address" class="mb-2">Email</label>
                            <input type="text" class="form-control" placeholder="name@example.com" name="email"
                                required>
                            <div class="invalid-feedback">Email is required.</div>
                        </div>
                </div>
                <div class="card-footer">
                    <div class="mb-3">
                        <a href="login.php" class="text-decoration-none text-primary">Login</a>
                        <input type="submit" value="Send" name="reset" class="btn btn-primary float-end">
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/script.js"></script>
</body>

</html>
