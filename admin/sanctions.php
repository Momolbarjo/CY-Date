<?php
$filename = "../data/users.csv";

if (isset($_POST["sanction"]) && isset($_POST["index"])) {
    $sanction = $_POST["sanction"];
    $index = (int)$_POST["index"];

    if ($sanction === "report") {
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        $userData = str_getcsv($lines[$index]);
        $userData[10] = intval($userData[10]) + 1;
        $lines[$index] = implode(",", $userData);
        file_put_contents($filename, implode(PHP_EOL, $lines) . PHP_EOL);
    } 
    elseif ($sanction === "ban") {
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        $userData = str_getcsv($lines[$index]);
        $userData[11] = 'banned';
        $lines[$index] = implode(",", $userData);
        file_put_contents($filename, implode(PHP_EOL, $lines) . PHP_EOL);
    }
    elseif ($sanction === "deban"){
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        $userData = str_getcsv($lines[$index]);
        $userData[11] = 'user';
        $userData[10] = 0 ;
        $lines[$index] = implode(",", $userData);
        file_put_contents($filename, implode(PHP_EOL, $lines) . PHP_EOL);
    }
}
header("Location: Dash.php");
exit;
?>