<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Diamond Pattern</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <h2>Diamond Pattern</h2>
  <div class="diamond">
    <?php makeDiamondShape(9);?>
  </div>
</body>

</html>


<?php
/**
 *function make diamond shape pattern
 *
 * @param $row
 * @return void
 */
function makeDiamondShape($row)
{
    if (!is_int($row)) {
        echo '$row must be a number!';
    } elseif ($row % 2 == 0 && $row != 0) {
        echo '$row must be an odd number!';
    } elseif ($row <= 0) {
        echo '$row must be greater than 0';
    } else {
        for ($k = 0; $k < $row; $k++) {
            $blank = abs($row - 2 * $k - 1) / 2;
            $star = $row - $blank * 2;

            for ($i = 0; $i < $blank; $i++) {
                echo "&nbsp ";
            }

            for ($i = 0; $i < $star; $i++) {
                echo "*";
            }

            echo "<br>";
        }
    }
}