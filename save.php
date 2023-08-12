<?php
session_start();

$commatag = $_SESSION['converted'] ?? '';
$hashtags = $_SESSION['hashtags'] ?? '';
session_abort();

$text = "
Original Tags:
$hashtags 
<br>
Converted Tags:
$commatag";

$fname = $_POST['fname'];
$ftype = $_POST['ftype'];
$fstream = 'saved tags/' . $fname . '.' . $ftype;

if (!empty($fname) && !empty($ftype)) {
    $your_tags = fopen($fstream, 'w');

    if ($your_tags) {
        fwrite($your_tags, $text);
        fclose($your_tags);

        $msg = '<div class="result-container"><h1>File Saved</h1>
        <div class="resultBox"><p id="resultText">File Saved Successfully</p></div>
        <div class="btn-holder">
          <div class="tooltip">
            <button onclick="toMainPage()">
              <span class="tooltiptext" id="myTooltip">Go to Main page</span>
              Go Back
            </button>
          </div>
        </div></div>';
        header("Content-Type: text/html");
        header("Content-Length: " . strlen($msg));
        echo $msg;
        exit;
    } else {
        http_response_code(400);
        die("Unable to create file");
    }
} else {
    die("Invalid file name or type");
}
?>
