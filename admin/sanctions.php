<?php
$filename = "../data/users.csv";
$banfile = "../data/banned.csv";
$unbanfile = "../data/unban.csv";
$reportfile = "../data/reports.csv";


if (isset($_POST['delete_index']) && isset($_POST['filename'])) {
    $indexToDelete = intval($_POST['delete_index']);
    $file = $_POST['filename']; 

    $lines = file($file, FILE_IGNORE_NEW_LINES);

    if ($indexToDelete >= 0 && $indexToDelete < count($lines)) {
        unset($lines[$indexToDelete]);

        file_put_contents($file, implode(PHP_EOL, $lines) . PHP_EOL);
    }
}

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
    if ($sanction === "ban" || $userData[10] >= 3) {
        $reason = $_POST["ban_reason"];
        if(empty($_POST["ban_reason"])){
            $reason = "you have been warned more than 3 times";
        }
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        $userData = str_getcsv($lines[$index]);
        $bannedData = array();
        $bannedData[0] = $userData[3];
        $userData[11] = 'banned';
        $lines[$index] = implode(",", $userData);
        file_put_contents($filename, implode(PHP_EOL, $lines) . PHP_EOL);
        $bannedData[1] = $reason;
        $bannedlines = "$bannedData[0],$bannedData[1]";
        file_put_contents($banfile, $bannedlines, FILE_APPEND);
    }
    else if ($sanction === "deban"){
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        $userData = str_getcsv($lines[$index]);
        $userData[11] = 'user';
        $userData[10] = 0 ;
    
        $banLines = file($banfile, FILE_IGNORE_NEW_LINES);
        foreach ($banLines as $i => $line) {
            $banData = str_getcsv($line);
            if ($banData[0] == $userData[3]) { 
                unset($banLines[$i]); 
                break;
            }
        }
    
        $lines[$index] = implode(",", $userData);
        file_put_contents($filename, implode(PHP_EOL, $lines) . PHP_EOL);
        file_put_contents($banfile, implode(PHP_EOL, $banLines) . PHP_EOL); 
    }
    else if ($sanction === "debanfromBanned"){
        $lines = file($banfile, FILE_IGNORE_NEW_LINES);
        $banData = str_getcsv($lines[$index]);
        $email = $banData[0];
        
        $userLines = file($filename, FILE_IGNORE_NEW_LINES);
        foreach ($userLines as $i => $line) {
            $userData = str_getcsv($line);
            if ($userData[3] == $email) { 
                $userData[11] = 'user';
                $userData[10] = 0 ;
                $userLines[$i] = implode(",", $userData);
                break;
            }
        }
        file_put_contents($filename, implode(PHP_EOL, $userLines) . PHP_EOL);
        
        unset($lines[$index]);
        file_put_contents($banfile, implode(PHP_EOL, $lines) . PHP_EOL);
    }
    else if ($sanction === "request"){
        $unbanLines = file($unbanfile, FILE_IGNORE_NEW_LINES);
        $unbanData = str_getcsv($unbanLines[$index]);
        $username = $unbanData[0];
    
        
        $userLines = file($filename, FILE_IGNORE_NEW_LINES);
        foreach ($userLines as $i => $line) {
            $userData = str_getcsv($line);
            if ($userData[2] == $username) { 
                $userData[11] = 'user';
                $userData[10] = 0 ;
                $userLines[$i] = implode(",", $userData);
                break;
            }
        }
        file_put_contents($filename, implode(PHP_EOL, $userLines) . PHP_EOL);
    
        
        unset($unbanLines[$index]);
        file_put_contents("../data/unban.csv", implode(PHP_EOL, $unbanLines) . PHP_EOL);
    }
    else if ($sanction === "reportByReports"){
        $reportLines = file($reportfile, FILE_IGNORE_NEW_LINES);
        $reportData = str_getcsv($reportLines[$index]);
        $reportedUser = $reportData[1];
    
        
        $userLines = file($filename, FILE_IGNORE_NEW_LINES);
        foreach ($userLines as $i => $line) {
            $userData = str_getcsv($line);
            if ($userData[2] == $reportedUser) { 
                $userData[10] += 1 ;
                $userLines[$i] = implode(",", $userData);
                break;
            }
        }
        file_put_contents($filename, implode(PHP_EOL, $userLines) . PHP_EOL);
    
        
        unset($reportLines[$index]);
        file_put_contents($reportfile, implode(PHP_EOL, $reportLines) . PHP_EOL);
    }
    else if ($sanction === "banByReports"){
        $reason = $_POST["ban_reason"];
        $banByReportsLines = file($reportfile, FILE_IGNORE_NEW_LINES);
        $banByReportsData = str_getcsv($banByReportsLines[$index]);
        $username = $banByReportsData[1];

        $bannedByReportsData = array();
        $userLines = file($filename, FILE_IGNORE_NEW_LINES);
        foreach ($userLines as $i => $line) {
            $userData = str_getcsv($line);
            if ($userData[2] == $username) { 
                $userData[11] = 'banned';
                $bannedByReportsData[0] = $userData[3];
                $userLines[$i] = implode(",", $userData);
                break;
            }
        }
        file_put_contents($filename, implode(PHP_EOL, $userLines) . PHP_EOL);
    
        $bannedByReportsData[1] = $reason;
        $bannedByReportsDataLines = "$bannedByReportsData[0],$bannedByReportsData[1]\n";
        file_put_contents($banfile, $bannedByReportsDataLines, FILE_APPEND);

        unset($banByReportsLines[$index]);
        file_put_contents($reportfile, implode(PHP_EOL, $banByReportsLines) . PHP_EOL);
    }
}
header("Location: Dash.php");
exit;
?>