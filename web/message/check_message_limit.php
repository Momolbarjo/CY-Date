<?php
/* Programme PHP permettant la vérification du nombre de messages envoyé sur une conversation dans la messagerie. */

session_start();
$statut = $_SESSION['status'];

define('MESSAGE_LIMIT', 5);
define('TIME_FRAME', 24);

$cookie_name = "messageLimit";

if (!isset($_COOKIE[$cookie_name])) {

    $messageData = ['count' => 1, 'timestamp' => time()];
    setcookie($cookie_name, json_encode($messageData), time() + TIME_FRAME, "/");
    $response = ['canSend' => true];
} else {

    $messageData = json_decode($_COOKIE[$cookie_name], true);
    $currentTime = time();

    if ($currentTime - $messageData['timestamp'] > TIME_FRAME) {
        
        $messageData = ['count' => 1, 'timestamp' => $currentTime];
        setcookie($cookie_name, json_encode($messageData), $currentTime + TIME_FRAME, "/");
        $response = ['canSend' => true];
    } else {
        if ($messageData['count'] < MESSAGE_LIMIT || $statut !== "sil" ) {
            
            $messageData['count']++;
            setcookie($cookie_name, json_encode($messageData), $currentTime + TIME_FRAME, "/");
            $response = ['canSend' => true];
        } else {
           
            $response = ['canSend' => false];
        }
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
