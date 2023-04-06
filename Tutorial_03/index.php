<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Age Caculator</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">
</head>

<body>
  <div class="ageCaculator col-4 offset-4">
    <div class=" mt-5" role="alert">
      <!-- alert user birth date-->
      <?php if (isset($_GET['dateOfBirth']) && $_GET['dateOfBirth'] != '') {?>
      <div class="alert alert-primary mb-3">
        <?php echo calculateAge($_GET['dateOfBirth']); ?>
      </div>
      <?php } elseif (!empty($_GET['calculate'])) {?>
      <div class="alert text-danger alert-danger mb-3">
        <?php echo "Required !" ?>
      </div>
      <?php }?>
    </div>
    <div class="card text-center">
      <div class="card-header bg-light">
        <h2>Age Calculator</h2>
      </div>
      <div class="card-body">
        <form method="GET">
          <label>Date of Birth:</label>
          <input type="date" name="dateOfBirth"><br>
          <input class="btn btn-primary mt-4 w-100" name="calculate" type="submit" value="Calculate">
        </form>

      </div>
    </div>
  </div>
</body>

</html>

<?php

/**
 * function calcute age
 *
 * @param $dateOfBirth
 * @return string  birth date
 */

function calculateAge($dateOfBirth)
{
    $birthDate = new DateTime($dateOfBirth); //input from user
    $today = new DateTime(date('m.d.y')); // today date
    if ($birthDate >= $today) {
        return "Your age must not equal or greater than tomorrow!";
    } else {
        $diff = $today->diff($birthDate); //calculate the time difference between two datess
        return 'Your age is  ' . $diff->y . ' years, ' . $diff->m . ' months and ' . $diff->d . ' days ';
    }

}