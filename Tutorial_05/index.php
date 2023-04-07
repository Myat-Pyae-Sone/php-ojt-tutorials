<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
require 'vendor/autoload.php';
/**
 * readTxtFile function
 *
 * @return string
 */
function readTxtFile()
{
    $file = "./files/sample.txt";
    $sampleFile = file_get_contents($file); //get contents from txt file
    $lines = explode("\n", $sampleFile); //string file to array with a new line
    foreach ($lines as $newLine) {
        echo $newLine . '<br>';
    }

}
/**
 * readWord function
 *
 * @param string $filename
 * @return string
 */
function readDocumentFile($filename)
{
    if (file_exists($filename)) {
        if (($fh = fopen($filename, 'r')) !== false) {
            $headers = fread($fh, 0xA00);

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

            $extracted_plaintext = fread($fh, $textLength);
            return nl2br($extracted_plaintext);
        }
    }
}

/**
 * readCsvFile function
 *
 *
 * @return string
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
 * readExcelFile function
 *
 * @return void
 */
function readExcelFile()
{
    // Load the Excel file
    $inputFileName = 'files/sample.xlsx';
    $spreadsheet = IOFactory::load($inputFileName);

    // Get the data from the Excel file
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();

    // Display the data in a table
    $html = "<table class='table'>";
    foreach ($rows as $row) {
        $html .= "<tr>";
        foreach ($row as $cell) {
            $html .= "<td>" . $cell . "</td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table>";
    echo $html;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reading Files</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="libs/bootstrap-5.0.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">

</head>

<body>
  <div class="card col-10 offset-1 p-4 mt-5">
    <div class="txt-file mb-5">
      <h1 class="fs-3">Text File</h1>
      <hr>
      <?php echo readTxtFile(); ?>
    </div>
    <div class="doc-file mb-5">
      <h1 class="fs-3">Document File</h1>
      <hr>
      <?php echo readDocumentFile('files/sample.doc'); ?>
    </div>
    <div class="csv-file mb-5">
      <h1 class="fs-3">CSV File</h1>
      <hr>
      <?php echo readCsvFile('files/sample.csv'); ?>
    </div>
    <div class="excel-file mb-5">
      <h1 class="fs-3">Excel File</h1>
      <hr>
      <?php echo readExcelFile(); ?>
    </div>
  </div>
</body>

</html>