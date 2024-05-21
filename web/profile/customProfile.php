<?php
session_start();
include 'loadData.php';

$username = $_SESSION['input_log']['username'];
$userData = loadUserData($username);

if (isset($_SESSION['error'])){
    echo '<div class="error">' . htmlspecialchars($_SESSION['error']) . '</div>';
    unset($_SESSION['error']);
} elseif (isset($_SESSION['success'])){
    echo '<div class="success">' . htmlspecialchars($_SESSION['success']) . '</div>';
    unset($_SESSION['success']);
}

$lines = file("../../data/visit.csv", FILE_IGNORE_NEW_LINES);

?>


<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="customize.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>


    <div class="pic">
            <input type="file" id="imageUpload" name="profilPicture" accept=".png, .jpg, .jpeg, .gif"
                style="display:none">
            <label for="imageUpload">
            <img src="<?php  if(!$_SESSION['role']){header('Location: ../index.php');}echo $_SESSION['profile_pic']; ?>" class="round-image" alt="cantFoundPic" id="profilePic">
            </label>
            </div>
    <div class="box">  
        <form action="profileServ.php" method="POST" enctype="multipart/form-data">
            
            
            <div class="inputBox">
                <input type="textbox" value="<?php  echo $_SESSION['input_log']['username'] ?? '';?>" readonly />
            </div>
            <div class="inputBox">
                <select name="region" required >
                    <option value="">Region</option>
                    <?php
                    $regions = array("Auvergne-Rhône-Alpes", "Bourgogne-Franche-Comté", "Bretagne", "Centre-Val de Loire", "Corse", "Grand Est", "Hauts-de-France", "Ile-de-France", "Normandie", "Nouvelle-Aquitaine", "Occitanie", "Pays de la Loire", "Provence Alpes Côte d`Azur");
                    foreach ($regions as $region) {
                        $selected = ($userData['region'] ?? '') === $region ? 'selected' : '';
                        echo "<option value=\"$region\" $selected>$region</option>";
                    }
                    ?>
                </select>
                <i class='bx bxs-user-circle'></i>
            </div>


            <div class="inputBox">
                <input type="number" placeholder="Size"  min="125" max="240" name="size" value="<?php echo $userData['height'] ?? ''; ?>" required>
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
        <button class="button" id="visited">Some visitors ?</button>                
        <div class="visitsTableContainer">
            <table id="visitsTable">
                    <tr>
                        <th>Visitor Name</th>
                        <th>Visitor Picture</th>
                    </tr>
                    <?php 
                        foreach($lines as $line){
                            $data = str_getcsv($line);
                            if($data[1] == $username){
                                echo '<tr>';
                                echo "<td> {$data[0]} </td>";
                                echo "<td><img class='round-image' src='{$data[2]}' alt='Image'></td>";
                                echo '</tr>';
                            }
                        }

                    ?>    
            </table>
        </div>
        <div class="vertical-bar"></div> 

    </div>
            
    <script>
    var sub = "<?php echo $userData['statut'] ?>";
    </script>
    <script src="../../login/picture.js"></script>
    <script src="visits.js"></script>
</body>

</html>
