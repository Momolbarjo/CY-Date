<?php
    include 'loadData.php';

    $username = $_GET['user'];

    $userData = loadUserData($username);
    
    $max = count($userData['pictures'])
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Profile.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Profil of <?php echo $username; ?></title>
</head>
<body onmouseenter="verif(<?php echo $max ?>)">
    
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
        	<p id="p1">DESCRPTION</p><textarea id = "p2" cols="20" rows="6"    name="desc"><?php echo $userData['description'] ?? 'No info';  ?></textarea>
        </div>
    
    	<div class="four">
        	<button id="optionsBtn">ACTIONS</button>
        	<div id="optionsMenu" style="display: none;">
            		<a id="a1" href="#">Report</a>
            		<a id="a1" href="#">Block</a>
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
  	  
    <script src="profilePage.js"></script>
</body>
</html>
