

<?php

date_default_timezone_set("Europe/Bratislava");
$timestamp = date("Y-m-d H:i:s");

$myFilePath = "logfile.txt";

$lateArrival = strtotime($timestamp) > strtotime(date("Y-m-d") . " 08:00:00");


if (file_exists($myFilePath)) {
    $file = fopen($myFilePath, "a"); /*append mode - allow write data to the end of the file

    File modes - https://www.w3schools.com/php/php_file_open.asp */

    fwrite($file, $timestamp . ";" . PHP_EOL); /*PHP_EOL - 
    new line - https://stackoverflow.com/questions/128560/when-do-i-use-the-php-constant-php-eol
    */
    fclose($file);
} else {
    file_put_contents($myFilePath, $timestamp . ";"  . PHP_EOL);
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
