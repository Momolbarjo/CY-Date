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
<div id="content">
    <header class="navMenu">
        <a href="#"><img class="logo" src="../../Pictures/cupid.png"></a>
        <nav class="navigationBar">
            <a href="../logOut.php">Log Out<i class='bx bxs-log-out-circle'></i></a>
            <a href="#" id="searchBtn">Search<i  class='bx bx-search-alt' ></i></a>
            <a href="#" id="sub">Subscription<i class='bx bx-money' ></i></a>
            <label for="imageUpload">
                <img src="<?php session_start();  if(!$_SESSION['role']){header('Location: ../index.php');}echo $_SESSION['profile_pic']; ?>" class="round-image" alt="cantFoundPic" id="profilePic">
                <div id="submenu" >
                    <a href="../profile/customProfile.php">My Profile<i class='bx bxs-user-account'></i></a>
                    <a href="#">My Messages<i class='bx bx-message-square-dots' ></i></a>
                    <a href="#">My settings<i class='bx bx-cog'></i></a>
                </div>
            </label>
        </nav>
    </header>
</div>
<div id="displaySearch">
    <input type="text" id="searchInput" placeholder="Looking for someone...">
    <div id="Results" class="profile-container"></div>
    <i id="set" class='bx bx-cog'></i>
    <div id="filters" style="display: none;">
        <input type="text" placeholder="Region" value="region"></input>
        <input type="number" placeholder="Year" value="year" min="1960" max="2006" ></input>
        <input type="number" placeholder="Size(cm)" value="size" min="120" max="220"></input>
    </div>
</div>
<div id="subOpt">
    <div id="opt1" class="option">
        <img src="../../Pictures/silver.png" alt="cant find pic">
        <p>
            <i class='bx bxs-star'></i>Access to the messaging service<br>
            <i class='bx bxs-star'></i>100 messages a day<br>
            <i class='bx bxs-star'></i>Send Friend Request<br>
            <i class='bx bx-star' ></i>Seen History<br>
            <i class='bx bx-star' ></i>Charism<br>
            <i class='bx bx-star'></i>Randomized date<br><br><br>
            <i class='bx bx-money' ></i>9.99$ per month<br>
        </p>
        <button id="silBtn"><i class='bx bx-badge-check' ></i></button>
    </div>
    <div id="opt2" class="option">
        <img src="../../Pictures/gold.png" alt="cant find pic">
        <p>
            <i class='bx bxs-star'></i>∞ messages a day<br>
            <i class='bx bxs-star'></i>Send Friend Request<br>
            <i class='bx bxs-star'></i>Seen History<br>
            <i class='bx bxs-star'></i>Charism<br>
            <i class='bx bxs-star'></i>CEO<br>
            <i class='bx bxs-star'></i>Randomized date<br><br><br>
            <i class='bx bx-money' ></i>19.99$ per month<br>
        </p>
        <button id="gldBtn"><i class='bx bx-badge-check' ></i></button>
    </div>
</div>
    <script src="../../Browser/disable.js"></script>
    <script src="subMenu.js"></script>
    <script>
        var silBtn = document.getElementById('silBtn');
        silBtn.addEventListener('mouseover', function () {
            silBtn.innerHTML = "<i class='bx bxs-error'></i>";
        });
        silBtn.addEventListener('mouseout', function () {
            silBtn.innerHTML = "<i class='bx bx-badge-check'></i>";
        });
    </script>
</body>

</html>