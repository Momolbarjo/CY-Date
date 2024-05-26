<!DOCTYPE html>
<html lang="en">
<?php /* Programme HTML/CSS/PHP qui permet d'afficher un message prevenant l'utilisateur X qu'il a bloqué Y quand X essaye d'accéder au profil de Y. Permet à X de débloquer Y*/ ?>
	
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blocked Message</title>
    <link rel="stylesheet" href="blocker.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="blocker-message">
        <p>You have blocked this person, do you want to give a second chance?</p>
        <div class="button">
            <a href="../../dash/dashboard.php" id="dont-unblock">Pfffffff no !</a>
            <a href="../../dash/dashboard.php" id="unblock">Why not ?</a>
        </div>
    </div>
    <?php 
        session_start();
        $blockedUser = $_GET['user'];
		echo "<script>let userName = " . json_encode($_SESSION['input_log']['username']) . ";</script>";
		echo "<script>let recipientName = " . json_encode($blockedUser) . ";</script>";
	?>
<script>
    document.getElementById('unblock').addEventListener('click', function () {
        $.ajax({
            url: '../../../admin/unblock.php',
            type: 'post',
            data: {
                'asker': userName,
                'receiver': recipientName
            },
            success: function (response) {

            }
        });
    });
</script>
</body>
</html>
