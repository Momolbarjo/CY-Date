<?php
/* Programme HTML/CSS/JS/PHP gérant l'affichage du profil d'un utilisateur X depuis le compte d'un utilisateur Y. Il permet aussi à l'utilisateur Y de signaler et/ou de bloquer l'utilisateur X. */

    session_start();

    include 'loadData.php';

    $username = $_GET['user'];

    $userData = loadUserData($username);

	$lines = file("../../data/visit.csv", FILE_IGNORE_NEW_LINES);
    
    $max = count($userData['pictures']);
    $visiter = $_SESSION['input_log']['username'];
    $photo = $_SESSION['profile_pic'];
    $visited = $username;
	$visits = 1;
	foreach($lines as $line){
		$data = str_getcsv($line);
		if($data[0] == $visiter && $data[1] == $visited){
			$visits = 0;
		}
	}

	if($visits){
		file_put_contents("../../data/visit.csv", "$visiter,$visited,$photo\n", FILE_APPEND); 
	}

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['blocker']) && isset($_POST['blocked'])){

		
		$blocker = $_POST['blocker'];
		$blocked = $_POST['blocked'];


		file_put_contents("../../data/blocked.csv", "$blocker,$blocked\n", FILE_APPEND);
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Profile.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Profil of <?php echo $username; ?></title>
</head>
<body onmouseenter="verif(<?php echo $max ?>)">
	<div id="errorMessage" class="error" style="display: none;"></div>
    <div id="profile">
    	<div class="first">
        	<img src="<?php echo $userData['profilePicPath']; ?>" alt="Profile pic">
        	<h1><?php echo $username; ?><i id="add" class="bx bx-user-plus"></i></h1>
        	<label>(<?php echo $userData['gender'] ?>)</label>
        	<br>
        </div>
        
        <div class="second">
        	<p id="p1">BIRTHDAY</p> <p id="p2"> <?php echo $userData['birthdate'] ?? 'No info'; ?></p>
        	<p id="p1">SIZE</p> <p id="p2"> <?php echo $userData['height'] ?? 'No info'; ?> cm</p>
        	<p id="p1">REGION</p> <p id="p2"> <?php echo $userData['region'] ?? 'No info'; ?></p>
        </div>
        
        <div class="third">
        	<p id="p1">DESCRIPTION</p><textarea id = "p2" cols="20" rows="6"    name="desc"><?php echo $userData['description'] ?? 'No info';  ?></textarea>
        </div>
    
    	<div class="four">
        	<button id="optionsBtn">ACTIONS</button>
        	<div id="optionsMenu" style="display: none;">
            		<a id="report" href="#">Report</a>
            		<a id="block" href="#">Block</a>
        	</div>
        </div>
    
    	<div class="five">
			<?php for ($i = 0; $i < count($userData['pictures']); $i++): ?>
				<img src="<?php echo file_exists($userData['pictures'][$i] ?? '') ? $userData['pictures'][$i] : "../../Pictures/carréVide.png"; ?>" onclick="zoom(<?php echo $max ?>)" alt="THE PERSON DON'T HAVE ANY PICTURES" id="img<?php echo $i+1;?>">
			<?php endfor; ?>
			<button id="btn1" onclick="changeImg(-1,<?php echo $max ?>)"><i class='bx bx-left-arrow-alt'></i></button>
    			<button id="btn2" onclick="changeImg(1,<?php echo $max ?>)"><i class='bx bx-right-arrow-alt' ></i></button>
				<br>
    	</div>

    </div>
    
    <button id="btn3" onclick="changeImg(-1,<?php echo $max ?>)"><i class='bx bx-left-arrow-alt'></i></button>
    <button id="btn4" onclick="changeImg(1,<?php echo $max ?>)"><i class='bx bx-right-arrow-alt' ></i></button>
    
    <textarea id="p3"  rows="2"> THE PERSON DON'T HAVE ANY PICTURES </textarea>
  	
	<div id="reportForm">
		<img id="cupid" src="../../Pictures/silver.png">
		<input type="text"  id="reported" value="<?php echo $userData['username']; ?>" readonly><br>
		<select id="reportReason" name="reason" required>
			<option value="">Reason</option>
			<?php
			$reasons = array("harassment", "blackmail", "insult", "sexual assault", "scam", "Bot","shocking Profile");
			foreach ($reasons as $reason) {
				echo "<option value=\"$reason\">$reason</option>";
			}
			?>
		</select><br>
		<button id="reportBtn">Report</button>
	</div>


    <script src="profilePage.js"></script>
	<?php 
		echo "<script>let subRecipient = " . json_encode($userData['statut']) . ";</script>"; 
		echo "<script>let userName = " . json_encode($_SESSION['input_log']['username']) . ";</script>";
		echo "<script>let recipientName = " . json_encode($userData['username']) . ";</script>";
		echo "<script>let recipientRole = " . json_encode($userData['role']) . ";</script>"  
	?>
</body>
</html>
