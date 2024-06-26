<?php

/* Programme PHP permettant l'envoie de messages à un utilisateur via la messagerie du site. */ 

session_start();


$contactsLines = file("../../data/request.csv", FILE_IGNORE_NEW_LINES);
$index = 0;

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    $sender = $_SESSION['input_log']['username'];
    $recipient = $_POST['recipient'];
    $message = $_POST['message'];
    
    if (strpos($message, ',') !== false) {
        $_SESSION['error'] = "You cannot use : ','.";    
    }
    else{
        $uniqueID = uniqid();
        file_put_contents("../../data/message.csv", "$sender,$recipient,$message,$uniqueID\n", FILE_APPEND);
    }
} 


if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user'])){
    $currentUser = $_POST['user'];
    $admin = 1;
}
else{
    $currentUser = $_SESSION['input_log']['username'];
    $admin = 0;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My messages</title>
    <link rel="stylesheet" href="message.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <div id="errorMessage" class="error" style="display: none;"></div>
        <div class="sidebar">
            <h2>Contacts</h2>
            <ul>
                <?php
                $usedIds = [];

                foreach($contactsLines as $contactLine) 
                {
                    $data = str_getcsv($contactLine);
                    if($data[0] == $currentUser && !in_array($data[1], $usedIds))
                    {
                        $usedIds[] = $data[1];
                        echo "<li id='$data[1]'>{$data[1]}</li>";
                    }
                    elseif($data[1] == $currentUser && !in_array($data[0], $usedIds))
                    {
                        $usedIds[] = $data[0];
                        echo "<li id='$data[0]'>{$data[0]}</li>";
                    }
                }
                ?>
            </ul>
        </div>

        <div class="chat-area">
            <div class="chat"></div>
            <div class="message-container">
                <input type="text" id="messageInput" placeholder="Talk about your favorite food :3">
                <i id="sendButton" class='bx bx-send'></i>
            </div>
        </div>
    </div>
    <script>
        var currentUser = "<?php echo htmlspecialchars($currentUser, ENT_QUOTES, 'UTF-8'); ?>";
        let admin = <?php echo $admin; ?>;
    </script>
    <script src="message.js"></script>
</body>

</html>

