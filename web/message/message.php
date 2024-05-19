<?php
session_start();

if (isset($_GET['error'])){
    echo '<div class="error">' . htmlspecialchars($_GET['error']) . '</div>';
    unset($_SESSION['error']);
}
else if(isset($_GET['success'])){
    echo '<div class="success">' . htmlspecialchars($_GET['success']) . '</div>';
    unset($_SESSION['success']);
}

$contactsLines = file("../../data/request.csv", FILE_IGNORE_NEW_LINES);
$index = 0;

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    $sender = $_SESSION['input_log']['username'];
    $recipient = $_POST['recipient'];
    $message = $_POST['message'];
    $uniqueID = uniqid();
    file_put_contents("../../data/message.csv", "$sender;$recipient;$message;$uniqueID\n", FILE_APPEND);
} 


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteID'])){
    $deleteID = $_POST['deleteID'];
    $lines = file("../../data/message.csv");
    $output = "";
    foreach ($lines as $line){
        $data = explode(";", $line);
        if ($data[3] != $deleteID){
            $output .= $line;
        }
    }
    file_put_contents("../../data/message.csv", $output);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My messages</title>
    <link rel="stylesheet" href="message.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">

        <div class="sidebar">
            <h2>Contacts</h2>
            <ul>
                <?php
                $usedIds = [];

                foreach($contactsLines as $contactLine) 
                {
                    $data = str_getcsv($contactLine);
                    if($data[0] == $_SESSION['input_log']['username'] && !in_array($data[1], $usedIds))
                    {
                        $usedIds[] = $data[1];
                        echo "<li id='$data[1]'>{$data[1]}</li>";
                    }
                    elseif($data[1] == $_SESSION['input_log']['username'] && !in_array($data[0], $usedIds))
                    {
                        $usedIds[] = $data[0];
                        echo "<li id='$data[0]'>{$data[0]}</li>";
                    }
                }
                ?>

            </ul>
        </div>

        <div class="chat-area">
            <div class="chat">
                <!-- C'est pas un truc inutile la team -->
            </div>
            <input type="text" id="messageInput" placeholder="Talk about your favorite food :3">
            <button id="sendButton">Send</button>
        </div>

    </div>
    <script>
    var currentUser = "<?php echo $_SESSION['input_log']['username']; ?>";
    </script>
    <script src="message.js"></script>
    
</body>
</html>
