<?php
session_start();

    include 'loadData.php';

    $username = $_SESSION['input_log']['username'];

    $userData = loadUserData($username);

if (isset($_GET['error'])){
    echo '<div class="error">' . htmlspecialchars($_GET['error']) . '</div>';
    unset($_SESSION['error']);
}
else if(isset($_GET['success'])){
    echo '<div class="success">' . htmlspecialchars($_GET['success']) . '</div>';
    unset($_SESSION['success']);
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="customize.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="box">  
        <form action="profileServ.php" method="POST" enctype="multipart/form-data">
            
            <div class="pic">
            <input type="file" id="imageUpload" name="profilPicture" accept=".png, .jpg, .jpeg, .gif"
                style="display:none">
            <label for="imageUpload">
            <img src="<?php  if(!$_SESSION['role']){header('Location: ../index.php');}echo $_SESSION['profile_pic']; ?>" class="round-image" alt="cantFoundPic" id="profilePic">
            </label>
            </div>
            
            <div class="inputBox">
                <input type="textbox" value="<?php  echo $_SESSION['input_log']['username'] ?? '';?>" readonly />
            </div>
            <div class="inputBox">
                <select name="region" required >
                    <option value="">Region</option>
                    <option value="Auvergne-Rhône-Alpes" <?php echo ($userData['region'] ?? '') === 'Auvergne-Rhone-Alpes' ? 'selected' : ''; ?>>Auvergne-Rhône-Alpes</option>
                    <option value="Bourgogne-Franche-Comté" <?php echo ($userData['region'] ?? '') === 'Bourgogne-Franche-Comté' ? 'selected' : ''; ?>>Bourgogne-Franche-Comté</option>
                    <option value="Bretagne" <?php echo ($userData['region'] ?? '') === 'Bretagne' ? 'selected' : ''; ?>>Bretagne</option>
                    <option value="Centre-Val de Loire" <?php echo ($userData['region'] ?? '') === 'Centre-Val de Loire' ? 'selected' : ''; ?>>Centre-Val de Loire</option>
                    <option value="Corse" <?php echo ($userData['region'] ?? '') === 'Corse' ? 'selected' : ''; ?>>Corse</option>
                    <option value="Grand Est" <?php echo ($userData['region'] ?? '') === 'Grand Est' ? 'selected' : ''; ?>>Grand Est</option>
                    <option value="Hauts-de-France" <?php echo ($userData['region'] ?? '') === 'Hauts-de-France' ? 'selected' : ''; ?>>Hauts-de-France</option>
                    <option value="Ile-de-France" <?php echo ($userData['region'] ?? '') === 'Ile-de-France' ? 'selected' : ''; ?>>Ile-de-France</option>
                    <option value="Normandie" <?php echo ($userData['region'] ?? '') === 'Normandie' ? 'selected' : ''; ?>>Normandie</option>
                    <option value="Nouvelle-Aquitaine" <?php echo ($userData['region'] ?? '') === 'Nouvelle-Aquitaine' ? 'selected' : ''; ?>>Nouvelle-Aquitaine</option>                 
                    <option value="Occitanie" <?php echo ($userData['region'] ?? '') === 'Occitanie' ? 'selected' : ''; ?>>Occitanie</option>
                    <option value="Pays de la Loire" <?php echo ($userData['region'] ?? '') === 'Pays de la Loire' ? 'selected' : ''; ?>>Pays de la Loire</option>
                    <option value="Provence Alpes Côte d`Azur" <?php echo ($userData['region'] ?? '') === 'Provence Alpes Côte d`Azur' ? 'selected' : ''; ?>>Provence Alpes Côte d`Azur</option>  
                </select>
                <i class='bx bxs-user-circle'></i>
            </div>

            <div class="inputBox">
                <input type="number" placeholder="Size"  min="120" max="240" name="size" value="<?php echo $userData['height'] ?? ''; ?>" required>
                <i class='bx bxs-user-circle'></i>
            </div>


            <div class="inputBox2">
                <textarea maxlength="144" cols="20" rows="5" placeholder="Write your description..."   name="desc" ><?php echo $userData['description'] ?? ''; ?></textarea>
            </div>
            
            <div class="pics">
                <?php for ($i = 0; $i < 6; $i++): ?>
                    <label for="imageUpload<?php echo $i + 1; ?>">
                        <input type="file" id="imageUpload<?php echo $i + 1; ?>" name="addPicture<?php echo $i + 1; ?>" accept=".png, .jpg, .jpeg, .gif" style="display:none">
                        <img src="<?php echo file_exists($userData['pictures'][$i] ?? '') ? $userData['pictures'][$i] : "../../Pictures/carréVide.png"; ?>" class="square-image square-image<?php echo $i + 1; ?>" alt="cantFoundPic" id="addPicture<?php echo $i + 1; ?>">
                    </label>
                <?php endfor; ?>
            </div>
            
            <button type="submit" class="button">Complete My Profil !</button>
        </form>
        <div class="vertical-bar"></div> 
    </div>
    <script src="../../login/picture.js"></script>
</body>

</html>
