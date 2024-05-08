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
                    <option value="Auvergne-Rhône-Alpes" <?php echo ($_SESSION['input_profil']['region'] ?? '') === 'Auvergne-Rhone-Alpes' ? 'selected' : ''; ?>>Auvergne-Rhône-Alpes</option>
                    <option value="Bourgogne-Franche-Comté" <?php echo ($_SESSION['input_profil']['region'] ?? '') === 'female' ? 'selected' : ''; ?>>Bourgogne-Franche-Comté</option>
                    <option value="Bretagne" <?php echo ($_SESSION['input_profil']['region'] ?? '') === 'others' ? 'selected' : ''; ?>>Bretagne</option>
                    <option value="Centre-Val de Loire" <?php echo ($_SESSION['input_profil']['region'] ?? '') === 'Auvergne-Rhone-Alpes' ? 'selected' : ''; ?>>Centre-Val de Loire</option>
                    <option value="Corse" <?php echo ($_SESSION['input_profil']['region'] ?? '') === 'Corse' ? 'selected' : ''; ?>>Corse</option>
                    <option value="Grand Est" <?php echo ($_SESSION['input_profil']['region'] ?? '') === 'Grand Est' ? 'selected' : ''; ?>>Grand Est</option>
                    <option value="Hauts-de-France" <?php echo ($_SESSION['input_profil']['region'] ?? '') === 'Hauts-de-France' ? 'selected' : ''; ?>>Hauts-de-France</option>
                    <option value="Ile-de-France" <?php echo ($_SESSION['input_profil']['region'] ?? '') === 'Ile-de-France' ? 'selected' : ''; ?>>Ile-de-France</option>
                    <option value="Normandie" <?php echo ($_SESSION['input_profil']['region'] ?? '') === 'others' ? 'selected' : ''; ?>>Normandie</option>
                    <option value="Nouvelle-Aquitaine" <?php echo ($_SESSION['input_profil']['region'] ?? '') === 'Nouvelle-Aquitaine' ? 'selected' : ''; ?>>Nouvelle-Aquitaine</option>                 
                    <option value="Occitanie" <?php echo ($_SESSION['input_profil']['region'] ?? '') === 'Occitanie' ? 'selected' : ''; ?>>Occitanie</option>
                    <option value="Pays de la Loire" <?php echo ($_SESSION['input_profil']['region'] ?? '') === 'Pays de la Loire' ? 'selected' : ''; ?>>Pays de la Loire</option>
                    <option value="Provence Alpes Côte d`Azur" <?php echo ($_SESSION['input_profil']['region'] ?? '') === 'Provence Alpes Côte d`Azur' ? 'selected' : ''; ?>>Provence Alpes Côte d`Azur</option>  
                </select>
                <i class='bx bxs-user-circle'></i>
            </div>

            <div class="inputBox">
                <input type="number" placeholder="Size"  min="120" max="240" name="size" value="<?php echo $_SESSION['input_profil']['size'] ?? ''; ?>" required>
                <i class='bx bxs-user-circle'></i>
            </div>

            <div class="inputBox2">
                <textarea maxlength="144" cols="20" rows="5" placeholder="Write your description..."   name="desc" value="<?php echo $_SESSION['input_profil']['desc'] ?? ''; ?>" required></textarea>
            </div>
            
            <div class="pics">
                <label for="imageUpload1">
                    <input type="file" id="imageUpload1" name="addPicture1" accept=".png, .jpg, .jpeg, .gif" style="display:none">
                    <img src="../../Pictures/carréVide.png" class="square-image square-image1" alt="cantFoundPic" id="addPicture1">
                </label>
                <label for="imageUpload2">
                    <input type="file" id="imageUpload2" name="addPicture2" accept=".png, .jpg, .jpeg, .gif" style="display:none">
                    <img src="../../Pictures/carréVide.png" class="square-image square-image2" alt="cantFoundPic" id="addPicture2">
                </label>
                <label for="imageUpload3">
                    <input type="file" id="imageUpload3" name="addPicture3" accept=".png, .jpg, .jpeg, .gif" style="display:none">
                    <img src="../../Pictures/carréVide.png" class="square-image square-image3" alt="cantFoundPic" id="addPicture3">
                </label>
                <label for="imageUpload4">
                    <input type="file" id="imageUpload4" name="addPicture4" accept=".png, .jpg, .jpeg, .gif" style="display:none">
                    <img src="../../Pictures/carréVide.png" class="square-image square-image4" alt="cantFoundPic" id="addPicture4">
                </label>
                <label for="imageUpload5">
                    <input type="file" id="imageUpload5" name="addPicture5" accept=".png, .jpg, .jpeg, .gif" style="display:none">
                    <img src="../../Pictures/carréVide.png" class="square-image square-image5" alt="cantFoundPic" id="addPicture5">
                </label>
                <label for="imageUpload6">
                    <input type="file" id="imageUpload6" name="addPicture6" accept=".png, .jpg, .jpeg, .gif" style="display:none">
                    <img src="../../Pictures/carréVide.png" class="square-image square-image6" alt="cantFoundPic" id="addPicture6">
                </label>
            </div>
            
            <button type="submit" class="button">Complete My Profil !</button>
        </form>
        <div class="vertical-bar"></div> 
    </div>
    <script src="../../login/picture.js"></script>
</body>

</html>
