<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["user"];
    $password = $_POST["password"];

    if ($username === "momo" && $password === "milou") {
        header("Location: ../web/dashboard.html");
        exit; 
    } else {
        header("Location: ../../index.html");
        exit;
    }
} else {
    header("Location: ../../index.html");
    exit;
}
?>
