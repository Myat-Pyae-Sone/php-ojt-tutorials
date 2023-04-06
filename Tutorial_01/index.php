<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>ChessBoard</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <h1>Chessboard</h1>
  <div class="chess">
    <table>
      <?php drawChessBorad('5', 9);?>
    </table>
  </div>
</body>

</html>
<?php
/**
 *function Draw chess board
 *
 * @param $row
 * @param $col
 * @return void
 */
function drawChessBorad($row, $col)
{
    if ($row <= 0 && $col <= 0) {
        echo '$row and $col must be a greater than 0!';
    } elseif (!is_int($row) && !is_int($col)) {
        echo '$row and $col must be a number!';
    } elseif ($row <= 0 && !is_int($col)) {
        echo '$row must be greater than 0 and $col must be a number!';
    } elseif (!is_int($row) && $col <= 0) {
        echo '$row must be a number and $col must be greater than 0';
    } elseif ($row <= 0) {
        echo '$row must be greater than 0!';
    } elseif ($col <= 0) {
        echo '$col must be greater than 0!';
    } elseif (!is_int($row)) {
        echo '$row must be a number!';
    } elseif (!is_int($col)) {
        echo '$col must be a number!';
    } else {
        for ($i = 1; $i <= $row; $i++) {
            echo "<tr>";

            for ($j = 1; $j <= $col; $j++) {
                $box = ($j + $i) % 2 == 0 ? 'blank' : 'color';
                echo "<td class='{$box}'></td>";
            }

            echo "</tr>";
        }
    }
}
?>