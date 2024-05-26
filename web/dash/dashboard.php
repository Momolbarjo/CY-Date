<?php
/* Programme HTML/CSS/JS/PHP gérant la page principal du site pour un utilisateur. Il va afficher la barre de navigation et ses fonctionnalités qui vont avec (recherche, abonnement, etc...). Il va aussi afficher la photo de profil de l'utilisateur et des fonctionnalité en plus si il clique dessus (modification de paramètre, de profil, messagerie, etc...). Et affiche aussi les profils récemment créer sur le site. */ 

session_start();
$username = $_SESSION['input_log']['username'];
include 'defaultProfile.php';


$filePath = '../../data/users.csv';
$blockedFilePath = '../../data/blocked.csv';
$users = getUsersData($filePath);
$blockedUsers = getBlockedUsersData($blockedFilePath);
$sortedUsers = sortUsersByRegistrationDate($users);
$latestUsers = array_slice($sortedUsers, 0, 7);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
<div id="successMessage" class="success" style="display: none;"></div>
<div id="errorMessage" class="error" style="display: none;"></div>
<div id="content">
    <header class="navMenu">
        <a href="#"><img class="logo" src="<?php  if($_SESSION['status']==="sil"){echo "../../Pictures/silver.png";}else if($_SESSION['status']==="gld"){echo "../../Pictures/gold.png";}else{echo "../../Pictures/cupid.png";}?>"></a>
        <nav class="navigationBar">
            <a href="../logOut.php">Log Out<i class='bx bxs-log-out-circle'></i></a>
            <a href="#" id="searchBtn">Search<i  class='bx bx-search-alt' ></i></a>
            <a href="#" id="sub">Subscription<i class='bx bx-money' ></i></a>
            <label for="imageUpload">
                <img src="<?php   if(!$_SESSION['role']){header('Location: ../../index.php');}echo $_SESSION['profile_pic']; ?>" class="round-image" alt="cantFoundPic" id="profilePic">
                <div id="submenu" >
                    <a href="../profile/customProfile.php">My Profile<i class='bx bxs-user-account'></i></a>
                    <a href="../message/message.php">My Messages<i class='bx bx-message-square-dots' ></i></a>
                    <a href="../profile/personnalInformations.php">My settings<i class='bx bx-cog'></i></a>
                </div>
            </label>
        </nav>
    </header>
    <h1 id="crampté">The New Crampteurs like Hackmoun :</h1>
        <?php foreach ($latestUsers as $user):
            if ($user[2] !== $username && !isUserBlocked($user[2], $blockedUsers, $username)): ?>
                <li>
                <?php echo "<a href='../profile/profilePage.php?user=$user[2]'><img class='roundOther-image' src='" . $user[9] . "' alt='Profile Picture'></a>"; ?>
                    <strong><?php echo htmlspecialchars($user[2]); ?></strong>
                </li>
            <?php endif;
            endforeach; 
        ?>

</div>
<div id="displaySearch">
    <input type="text" id="searchInput" placeholder="Looking for someone...">
    <div id="Results" class="profile-container"></div>
</div>
<div id="subOpt">
    <div id="opt1" class="option">
        <img src="../../Pictures/silversub.png" alt="cant find pic">
        <p>
            <i class='bx bxs-star'></i>Access to the messaging service<br>
            <i class='bx bxs-star'></i>100 messages a day<br>
            <i class='bx bxs-star'></i>Send Friend Request<br>
            <i class='bx bx-star' ></i>Seen History<br>
            <i class='bx bx-star' ></i>Charism<br><br><br>
            <i class='bx bx-money' ></i>9.99$ per month<br>
        </p>
        <div id="silSubOptions" style="display: none;">
            <input type="radio" name="sil" class="Month" required><i class='bx bx-star' ></i>9.99$ Month<br>
            <input type="radio" name="sil" class="Quaterly"><i class='bx bxs-star-half' ></i>19.99$ Quaterly<br>
            <input type="radio" name="sil" class="Annual"><i class='bx bxs-star'></i>79.99$ Annual<br>
        </div>
        <button id="silBtn"><i class='bx bx-badge-check' ></i></button>
    </div>
    <div id="opt2" class="option">
        <img src="../../Pictures/goldsub.png" alt="cant find pic">
        <p>
            <i class='bx bxs-star'></i>∞ messages a day<br>
            <i class='bx bxs-star'></i>Send Friend Request<br>
            <i class='bx bxs-star'></i>Seen History<br>
            <i class='bx bxs-star'></i>Charism<br>
            <i class='bx bxs-star'></i>CEO<br><br><br>
            <i class='bx bx-money' ></i>19.99$ per month<br>
        </p>
        <div id="gldSubOptions" style="display: none;">
            <input type="radio"  name="gld" class="Month" required><i class='bx bx-star' ></i>19.99$ Month<br>
            <input type="radio" name="gld" class="Quaterly"><i class='bx bxs-star-half' ></i>49.99$ Quaterly<br>
            <input type="radio" name="gld" class="Annual"><i class='bx bxs-star'></i>149.99$ Annual<br>
        </div>
        <button id="gldBtn"><i class='bx bx-badge-check' ></i></button>       
    </div>
</div>
    <script src="../../Browser/disable.js"></script>
    <script src="subMenu.js"></script>
    <?php echo "<script>let subs = " . json_encode($_SESSION['status']) . ";</script>"; ?>
</body>

</html> 
