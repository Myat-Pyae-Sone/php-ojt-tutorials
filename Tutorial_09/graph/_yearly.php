<?php
include "../db.php";
$months_of_year = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$data = array_combine($months_of_year, array_fill(0, count($months_of_year), 0));

$query = "SELECT MONTHNAME(created_datetime) AS month_name, COUNT(*) AS num_posts
              FROM lists
              WHERE YEAR(created_datetime) = 2022
              GROUP BY month_name
              ORDER BY FIELD(month_name, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December')";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['month_name']] = $row['num_posts'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Monthly Posts</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../libs/bootstrap-5.0.2/css/bootstrap.min.css">
    <script src="../libs/chart.umd.js"></script>
</head>

<body>
    <div class="container">
        <div class="card  border-0">
            <div class="card-header border-bottom-0 bg-white  mb-3">
                <div class="btn  btn btn-secondary">
                    <a href="../index.php" class="text-decoration-none text-light">Back</a>
                </div>
                <div class="float-end  ">
                    <div class="btn btn-outline-secondary ">
                        <a href="../graph/_weekly.php" class="text-decoration-none text-dark">Weekly</a>
                    </div>
                    <div class="btn btn-outline-secondary">
                        <a href="../graph/_monthly.php" class="text-decoration-none  text-dark">Monthly</a>
                    </div>
                    <div class="btn btn-secondary">
                        <a href="#" class="text-decoration-none text-light">Yearly</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

    <script>
    var data = <?php echo json_encode($data); ?>;
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($months_of_year); ?>,
            datasets: [{
                label: '# Yearly Post Create',
                data: Object.values(data),
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
                }],
                xAxes: [{
                    ticks: {
                        autoSkip: false,
                        maxRotation: 0
                    }
                }]
            }
        }
    });
    </script>
</body>

</html>