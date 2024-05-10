<?php
session_start();

$data = $_POST['subscription'];
$status = $_SESSION['status'];
$username = $_SESSION['input_log']['username'];

if($status==="sub" || $status===$data){
    echo "Already Sub";
}
else{
    $today = date("Y-m-d");

    if ($data === '9.99$ Month') {
        $end = date("Y-m-d", strtotime("+1 month"));
    } elseif ($data === '49.99$ Quaterly') {
        $end = date("Y-m-d", strtotime("+3 months"));
    } elseif ($data === '149.99$ Annual') {
        $end = date("Y-m-d", strtotime("+1 year"));
    }

    $lines = file('../data/users.csv', FILE_IGNORE_NEW_LINES);

    foreach ($lines as $i => $line) {
        $fields = explode(',', $line);
        if ($fields[2] === $username) {
            $fields[8] = $data;
            $fields[7] = $today;
            $fields[] = $end;
            $lines[$i] = implode(',', $fields);
            break;
        }
    }

    file_put_contents('../data/users.csv', implode("\n", $lines));

    echo "Subscription successful!";
}
?>