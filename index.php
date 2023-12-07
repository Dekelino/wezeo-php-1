<?php

date_default_timezone_set("Europe/Bratislava");
$timestamp =  date("Y-m-d H:i:s") /* "2023-12-07 23:59:59" */;

$myFilePath = "logfile.txt";


function checkArrival($file)
{
    global $timestamp;

    $timestampUnix = strtotime($timestamp); // strtotime - https://www.php.net/manual/en/function.strtotime.php

    // Check if arrival time is between 20:00 and 24:00
    $checkTimeFrom = strtotime('20:00:00');
    $checkTimeTo = strtotime('23:59:59'); //00:00:00 is the new day

    if ($timestampUnix >= $checkTimeFrom && $timestampUnix <= $checkTimeTo) {
        die("Arrival between 20:00 and 24:00 is not allowed.");
    }

    $checkTime = strtotime('08:00:00');

    if ($timestampUnix > $checkTime) {
        fwrite($file, $timestamp . " " . "meškanie" . ";" . PHP_EOL);
    } else {
        fwrite($file, $timestamp . ";" . PHP_EOL);
    } /*PHP_EOL - 
    new line - https://stackoverflow.com/questions/128560/when-do-i-use-the-php-constant-php-eol
    */
}

if (file_exists($myFilePath)) {
    $file = fopen($myFilePath, "a"); /*append mode - allow write data to the end of the file
    File modes - https://www.w3schools.com/php/php_file_open.asp */

    checkArrival($file);
    fclose($file);
} else {
    $file = fopen($myFilePath, "a");
    checkArrival($file);
    fclose($file);
}
function getDatas()
{
    $myfile = fopen("logfile.txt", "r") or die("Unable to open file!");
    $logDatas = fread($myfile, filesize("logfile.txt"));
    fclose($myfile);
    $output = explode(';', $logDatas); // using delimeter ";" to split strings - https://www.tutorialkart.com/php/php-split-string-by-delimiter
    foreach ($output as $x) {
        echo $x;
        echo '<br>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wezeo PHP academy </title>
</head>

<body>
    <?php
    echo "Ahoj";
    ?>
    <h1> Last timestamp : <?php echo $timestamp; ?></h1>
    <p>Log data:</p>

    <?php $datas = getDatas() ?>

</body>

</html>