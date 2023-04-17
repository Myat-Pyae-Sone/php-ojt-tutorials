<?php include "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>post list</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="libs/bootstrap-5.0.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <div class="container mt-5">

    <div class="btn btn-primary mb-3">
      <a href="create.php" class="text-decoration-none text-light"> create</a>
    </div>
    <div class="card">
      <div class="card-header">
        <h2>Post List</h2>
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Title</th>
              <th scope="col">Content</th>
              <th scope="col">Is Published</th>
              <th scope="col">Created Date</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
$sql = "Select * from  lists";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $title = $row['title'];
        $content = $row['content'];
        $is_published = $row['is_published'];
        $created_datetime = $row['created_datetime'];
        $formatted_date = date("M d, Y", strtotime($created_datetime));
        $is_published = $row['is_published'];
        if ($is_published == 0) {
            $check_public = "Unpublished";
        } else {
            $check_public = "published";
        }

        if (strlen($content) > 50) {
            $content = substr($content, 0, 50) . "...";
        }
        if (strlen($title) >= 10) {
            $title = substr($title, 0, 10) . "...";
        }
        echo '
                                    <tr>
                                        <th scope="row">' . $id . '</th>
                                        <td>' . $title . '</td>
                                        <td>' . $content . '</td>
                                        <td>' . $check_public . '</td>
                                        <td>' . $formatted_date . '</td>
                                        <td>
                                        <button type="button" class="btn btn-info">
                                            <a href="detail.php? viewid=' . $id . ' " class="text-dark text-decoration-none">View</a>
                                        </button>
                                            <button type="button" class="btn btn-success">
                                                <a href="edit.php? updateid=' . $id . ' " class="text-light text-decoration-none">Edit</a>
                                            </button>
                                            <button type="button" class="btn btn-danger delete-btn" data-id="' . $id . '">
                                                Delete
                                            </button>
                                        </td>
                                    </tr> ';

    }
}

?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="libs/js/jquery-3.6.0.min.js"></script>
  <script src="libs/bootstrap-5.0.2/js/bootstrap.min.js"></script>
  <script>
  $(document).ready(function() {
    $('.delete-btn').on('click', function() {
      var id = $(this).data('id');
      if (confirm("Are you sure to delete this post?")) {
        window.location.href = 'delete.php?deleteid=' + id;
      }
    });
  });
  </script>

</body