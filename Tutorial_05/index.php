<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Read Files</title>
  <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="libs/PHPWord-master/">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="col-8 offset-2 ms-2 border border-light p-3">
  <div class="file">
    <div class="text-file">
      <h1>Text File</h1>
      <hr>
      <?php readTextFile();?>
    </div>
    <div class="doc-file">
      <h1 class="pt-5">Document File</h1>
      <hr>
      <?php readDocFile();?>
    </div>
    <div class="csv-file">
      <h1 class="pt-5">Csv File</h1>
      <hr>
      <?php readCsvFile();?>
    </div>
    <div class="excel-file">
      <h1 class="pt-5">Excel File</h1>
      <hr>

      <?php readExcelFile();?>

    </div>

  </div>
</body>

</html>
<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
require "vendor/autoload.php";
/**
 * function read text file
 *
 *
 * @return void
 */
function readTextFile()
{
    $file = "./files/sample.txt";
    $sampleFile = file_get_contents($file); //get contents from txt file
    $lines = explode("\n", $sampleFile); //string file to array with a new line
    foreach ($lines as $newLine) {
        echo $newLine . '<br>';
    }
}

/**
 * function read document file
 *
 *
 * @return void
 */

function readDocFile()
{
    $filename = './files/sample.doc';
    $openFile = fopen($filename, 'r'); //open file with readonly mode
    if (file_exists($filename)) {
        if (($fh = $openFile) !== false) {
            $headers = fread($fh, 0xA00); //formula for charatacters

            // 1 = (ord(n)*1) ; Document has from 0 to 255 characters
            $n1 = (ord($headers[0x21C]) - 1);

            // 1 = ((ord(n)-8)*256) ; Document has from 256 to 63743 characters
            $n2 = ((ord($headers[0x21D]) - 8) * 256);

            // 1 = ((ord(n)*256)*256) ; Document has from 63744 to 16775423 characters
            $n3 = ((ord($headers[0x21E]) * 256) * 256);

            // 1 = (((ord(n)*256)*256)*256) ; Document has from 16775424 to 4294965504 characters
            $n4 = (((ord($headers[0x21F]) * 256) * 256) * 256);

            // Total length of text in the document
            $textLength = ($n1 + $n2 + $n3 + $n4);

            $extracted_plaintext = fread($fh, $textLength); //read data
            echo nl2br($extracted_plaintext); // output characters  without new lines
        }
    }
    fclose($openFile); //close file
}

/**
 * function read Csv file
 *
 *
 * @return void
 */
function readCsvFile()
{
    $html = "<table class='table'>";
    $csvFile = "./files/sample.csv";
    $file = fopen($csvFile, 'r'); //file open with read only
    $data = fgetcsv($file); //read and output from open csv file
    $html .= '<thead>';
    foreach ($data as $d) {
        $headers = preg_split('/\s+/', $d); //split whitespace between headers
        foreach ($headers as $header) {
            $html .= "<th>" . $header . "</th>"; //put table headers

        }

    }
    $html .= '</thead>';
    $html .= '<tbody>';
    while ($lines = fgetcsv($file)) {
        $html .= '<tr>';
        foreach ($lines as $line) {
            $cells = preg_split('/\s+/', $line); //split whitespace between contents

            foreach ($cells as $cell) {
                $html .= "<td>" . $cell . "</td>"; //put table contents

            }

        }
        $html .= '</tr>';

    }
    $html .= '</tbody>';
    $html .= '</table>';
    fclose($file); //close the file
    echo $html; //ouput table
}

/**
 * function read Csv file
 *
 *
 * @return void
 */
function readExcelFile()
{
    $file = 'files/sample.xlsx';
    $sheet = IOFactory::load($file);
    $reader = $sheet->getActiveSheet();
    $lines = $reader->toArray(); //change to array
    $html = "<table class='table'>";
    foreach ($lines as $line) {
        $html .= "<tr>";
        foreach ($line as $data) {
            $html .= "<td>" . $data . "</td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table>";
    echo $html; //output table
}