<?php
$filename = "../data/users.csv";
$banfile = "../data/banned.csv";

if (isset($_POST["sanction"]) && isset($_POST["index"])) {
    $sanction = $_POST["sanction"];
    $reason =$_POST["ban_reason"];
    $index = (int)$_POST["index"];

    if ($sanction === "report") {
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        $userData = str_getcsv($lines[$index]);
        $userData[10] = intval($userData[10]) + 1;
        $lines[$index] = implode(",", $userData);
        file_put_contents($filename, implode(PHP_EOL, $lines) . PHP_EOL);
    }
    if ($sanction === "ban" || $userData[10] >= 3) {
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        $userData = str_getcsv($lines[$index]);
        $bannedData = array();
        $bannedData[0] = $userData[3];
        $userData[11] = 'banned';
        $lines[$index] = implode(",", $userData);
        file_put_contents($filename, implode(PHP_EOL, $lines) . PHP_EOL);
        if(empty($_POST["ban_reason"])){
            $reason = "you have been warned more than 3 times";
        }
        $bannedData[1] = $reason;
        $bannedlines = "$bannedData[0],$bannedData[1]";
        file_put_contents($banfile, $bannedlines, FILE_APPEND);
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