<?php
/* Programme HTML/CSS/JS/PHP permettant l'affichage des informations personnels d'un utilisateur. Et offre la possibilité à l'utilisateur de supprimer son comtpe. */

    session_start();

    include 'loadData.php';

    $username = $_SESSION['input_log']['username'];

    $userData = loadUserData($username);
    

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="infos.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>My Settings</title>
</head>
<body>
	
    <div id="errorMessage" class="error" style="display: none;"></div>
    
    <div id="settings">
    	<div class="first">
        	<h1>MY INFORMATIONS</h1>
        	<br>
        </div>
        
        <div class="second">
        	<p id="p1">Name :</p><p id="p2"> <?php echo $userData['name'];?></p>
        	<p id="p1">First Name :</p><p id="p2"> <?php echo $userData['surname'];?></p>
        	<p id="p1">Email :</p><p id="p2"> <?php echo $userData['email'];?></p>
        </div>
        
        <div class="third">
        	<p id="p1">Username :</p><p id="p2"> <?php echo $userData['username'];?></p>
        	<p id="p1">Sub :</p><p id="p2"> <?php echo $userData['statut'];?></p>
        </div>
    
        <div class="four">
        	<button id="delete" onclick="deleteAccount(0)">DELETE MY<NOBR> ACCOUNT</button>
        </div>
        
    </div>
    
    <div id="deleteMenu">
    	
    	<h2> Are you sure to delete your account ? </h2>
    	<br><br>
    	<button id="choice1" onclick="deleteAccount(1)">NO</button> &nbsp &nbsp &nbsp
    	<button id="choice2" onclick="deleteUser()">YES</button>
    	
    </div>
    
    <script>
    function deleteUser() {
        $.ajax({
            url: '../../admin/deleteUser.php',  
            type: 'POST',
            data: { username: '<?php echo $userData['username']; ?>' },
            success: function() {
                window.location.href = '../../index.php';
            }
        });
    }
</script>
    <script src="infos.js"></script>
</body>
</html>
