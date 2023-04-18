<?php
require_once 'db.php';
$num_data = 100;
$start_date = '2022-01-01';
$end_date = '2022-12-31';
for ($i = 0; $i < $num_data; $i++) {
    $rand_time = mt_rand(strtotime($start_date), strtotime($end_date));
    $created_datetime = date('Y-m-d H:i:s', $rand_time);
    $updated_datetime = date('Y-m-d H:i:s', $rand_time);
    $title = "Post " . ($i + 1);
    $content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";
    $is_published = mt_rand(0, 1);
    $query = "SELECT * FROM `lists`
     WHERE `title` = '$title'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO `lists` (`title`, `content`, `is_published`, `created_datetime`, `updated_datetime`)
             VALUES ('$title', '$content', $is_published, '$created_datetime', '$updated_datetime')";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
}
