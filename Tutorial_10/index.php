<?php
require_once "db.php";
require_once "create_table.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="libs/bootstrap-5.0.2/css/bootstrap.min.css">
</head>
<style>
.user-img {
    width: 80px;
    height: 80px;
}
</style>

<body>
    <?php
session_start();
$uEmail = '';
if (isset($_SESSION['email'])) {
    $uEmail = $_SESSION['email'];
}
if (isset($_GET['email'])) {
    session_start();
    session_destroy(); //destory all data in current session
    echo "<script>window.location.href='index.php';</script>";
    exit;
}
$sql = "SELECT * FROM `user` WHERE email='$uEmail'";
$query = mysqli_query($conn, $sql); //get connection
$row = mysqli_num_rows($query); //number of row

?>
    <?php
if (isset($_SESSION['email'])) {
    ?>
    <div class="navbar navbar-light bg-light">
        <?php
if ($row > 0) {
        $user = mysqli_fetch_assoc($query); //fetch all data from query
        ?>
        <div class="container-fluid w-75">
            <h4>
                <a href="index.php" class="text-decoration-none text-dark">Home</a>
            </h4>
            <div class="float-end">
                <?php
if ($user['image'] == '') {
            echo "<img src='images/default.png' alt='default' class='user-img rounded-circle'>";
        } else {
            echo "<img src='images/" . $user['image'] . "' class='user-img rounded-circle'  alt='img'>";
        }
        ?>
            </div>
        </div>
    </div>
    <div class="userImg float-end w-25">
        <form action="index.php" method="post" class="border border-secondary rounded p-2 w-50">
            <a href="auth/profile.php" class="text-decoration-none text-dark">Profile</a><br>
            <a href="index.php?email=<?php echo $uEmail; ?>" class="text-decoration-none text-dark"
                name="logout">Logout</a>
        </form>
    </div>
    <div class="d-flex align-items-center justify-content-center w-100" style="height: 350px;">
        <h2>Welcome From My Website </h2>
    </div>
    <?php
}
} else {
    ?>
    <div class="navbar w-100 bg-light">
        <div class="container-fluid w-75  p-2">
            <h4>
                <a href="index.php" class="text-decoration-none text-dark">Home</a>
            </h4>

            <div class="float-end  p-2">
                <a href="auth/register.php" class="btn btn-primary me-2">Register</a>
                <a href="auth/login.php" class="btn btn-primary ps-3 pe-3">Login</a>
            </div>
        </div>
        <div class="d-flex bg-white align-items-center justify-content-center w-100" style="height: 500px;">
            <h2> Welcome From My Website</h2>
        </div>
    </div>
    <?php
}
?>
    </div>
</body>

</html>