<?php

	session_start();

    include 'loadData.php';

    $username = $_GET['user'];

    $userData = loadUserData($username);
    

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
    <link rel="stylesheet" href="infos.css">
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
        	<p id="p1">Name :</p><p id="p2"> none</p>
        	<p id="p1">First Name :</p><p id="p2"> none</p>
        	<p id="p1">Email :</p><p id="p2"> none</p>
        </div>
        
        <div class="third">
        	<p id="p1">Username :</p><p id="p2"> none</p>
        	<p id="p1">Sub :</p><p id="p2"> none</p>
        </div>
    
        <div class="four">
        	<button id="delete" onclick="deleteAccount(0)">DELETE MY<NOBR> ACCOUNT</button>
        </div>
        
    </div>
    
    <div id="deleteMenu">
    	
    	<h2> Are you sure to delete your account ? </h2>
    	<br><br>
    	<button id="choice1" onclick="deleteAccount(1)">NO</button> &nbsp &nbsp &nbsp
    	<button id="choice2" onclick="deleteAccount(1)">YES</button>
    	
    </div>
    
    

    <script src="infos.js"></script>
</body>
</html>
