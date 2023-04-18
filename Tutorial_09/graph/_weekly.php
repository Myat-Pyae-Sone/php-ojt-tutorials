<?php
include "../db.php";
$days_of_week = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
$data = array_combine($days_of_week, array_fill(0, count($days_of_week), 0));

$query = "SELECT DAYNAME(created_datetime) AS day_name, COUNT(*) AS num_posts
            FROM lists
            GROUP BY day_name
            ORDER BY FIELD(day_name, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['day_name']] = $row['num_posts'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weekly Posts</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>

</body>

</html>
<!DOCTYPE html>
<html>

<head>
  <title>Daily Posts</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
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
          <div class="btn  btn btn-secondary">
            <a href="#" class="text-decoration-none text-light">Weekly</a>
          </div>
          <div class="btn btn-outline-secondary">
            <a href="../graph/_monthly.php" class="text-decoration-none text-secondary">Monthly</a>
          </div>
          <div class="btn btn-outline-secondary">
            <a href="../graph/_yearly.php" class="text-decoration-none text-secondary">Yearly</a>
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
      labels: <?php echo json_encode($days_of_week); ?>,
      datasets: [{
        label: '#Weekly Post Create',
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