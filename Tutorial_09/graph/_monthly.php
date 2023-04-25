<?php
require_once "../db.php";
/*
 * Show post data with monthly  graph
 * @param $conn, $day
 */
function count_posts_on_day($conn, $day)
{
    $query = "SELECT COUNT(*) as post_count FROM lists WHERE DATE(created_datetime) = '$day'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    return $data['post_count'];
}
$post_counts = array();
for ($day = 1; $day <= 31; $day++) {
    $date_string = '2022-01-' . str_pad($day, 2, '0', STR_PAD_LEFT);
    $post_counts[] = count_posts_on_day($conn, $date_string);
}
$post_counts_json = json_encode($post_counts);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Monthly Posts</title>
    <script src="../libs/chart.umd.js"></script>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../libs/bootstrap-5.0.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="card border-0">
            <div class="card-header border-bottom-0 bg-white mb-3">
                <div class="btn btn-secondary">
                    <a href="../index.php" class="text-decoration-none text-light">Back</a>
                </div>
                <div class="float-end">
                    <div class="btn btn-outline-secondary">
                        <a href="../graph/_weekly.php" class="text-decoration-none text-dark">Weekly</a>
                    </div>
                    <div class="btn btn-secondary">
                        <a href="#" class="text-decoration-none text-light">Monthly</a>
                    </div>
                    <div class="btn btn-outline-secondary">
                        <a href="../graph/_yearly.php" class="text-decoration-none  text-dark">Yearly</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['2022-01-01', '2022-01-02', '2022-01-03', '2022-01-04', '2022-01-05', '2022-01-06',
                    '2022-01-07',
                    '2022-01-08', '2022-01-09', '2022-01-10',
                    '2022-01-11', '2022-01-12', '2022-01-13', '2022-01-14', '2022-01-15', '2022-01-16',
                    '2022-01-17',
                    '2022-01-18', '2022-01-19', '2022-01-20',
                    '2022-01-21', '2022-01-22', '2022-01-23', '2022-01-24', '2022-01-25', '2022-01-26',
                    '2022-01-27',
                    '2022-01-28', '2022-01-29', '2022-01-30', '2022-01-31'
                ],
                datasets: [{
                    label: 'Posts Created in April 2023',
                    data: <?php echo $post_counts_json; ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>

</html>