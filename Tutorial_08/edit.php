<?php
require_once 'db.php';
$title_error = $content_error = '';
$title = $content = '';
$id = $_GET['updateid'];
$sql = "SELECT * FROM lists WHERE id=$id"; //select data from lists table
$query = mysqli_query($conn, $sql); //get connection
$data = mysqli_fetch_assoc($query); //get data

if (isset($_POST['edit'])) {
    if (empty($_POST['title'])) {
        $title_error = 'Title field is required';
    } else {
        $title = $_POST['title'];
    }

    if (empty($_POST['content'])) {
        $content_error = 'Content field is required';
    } else {
        $content = $_POST['content'];
    }
    if (empty($title_error) && empty($content_error)) {
        $publish = isset($_POST['publish']) ? 1 : 0;
        $sql = "UPDATE lists SET
                        title='$title',
                        content='$content',
                        is_published='$publish',
                        updated_datetime=NOW()
                        WHERE id=$id";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "success";
        } else {
            die(mysqli_connect_error($conn));
        }
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit page</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="libs/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Post</h2>
                    </div>

                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title"
                                    value="<?php echo $data['title'] ?>">
                                <span class="text-danger"><?php echo $title_error; ?></span>
                            </div>
                            <div class="mb-3">
                                <label>Content</label>
                                <textarea name="content" rows="5" cols="30"
                                    class="form-control"><?php echo $data['content'] ?></textarea>
                                <span class="text-danger"><?php echo $content_error; ?></span>
                            </div>
                            <div class="mb-3">
                                <input type="checkbox" name="publish" value="publish">
                                <label>publish</label>
                            </div>
                            <div class="mb-3">
                                <a href="index.php" class="btn btn-secondary">Back</a>
                                <input type="submit" value="update" class="btn btn-primary float-end" name="edit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>