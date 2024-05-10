<?php
session_start();

$type = $_POST['subscriptionType'];
$duration = $_POST['subscriptionId'];
$status = $_SESSION['status'];
$username = $_SESSION['input_log']['username'];


if($status==="sub" || $status===$type){
    echo "Already Sub";
}
else{
    $today = date("Y-m-d");
    if ($duration === 'Month') {
        $end = date("Y-m-d", strtotime("+1 month"));
    } elseif ($duration === 'Quaterly') {
        $end = date("Y-m-d", strtotime("+3 months"));
    } elseif ($duration === 'Annual') {
        $end = date("Y-m-d", strtotime("+1 year"));
    }

    $lines = file('../data/users.csv', FILE_IGNORE_NEW_LINES);

    foreach ($lines as $i => $line) {
        $fields = explode(',', $line);
        if ($fields[2] === $username) {
            $fields[8] = $type;
            $fields[12] = $today;
            $fields[13] = $end;
            $lines[$i] = implode(',', $fields);
            break;
        }
    }


    file_put_contents('../data/users.csv', implode("\n", $lines));

    echo "Subscription successful!";
}
?>