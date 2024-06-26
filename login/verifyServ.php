<?php
/* Programme PHP qui va vérifier les informations mis par un utilisateur lors de la création d'un compte pour voir si elles respectent les normes du site (nombre de caractères, etc...). */

session_start();
function verify_user_data()
{
    $surname = $_POST["surname"];
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];
    $password = $_POST["password"];

    if (!preg_match('/^[a-zA-Z]{1,12}$/', $surname)) {
        $_SESSION['error'] = '⚠️Surname should be with  letters only and between 1 to 12 characters⚠️';
        return false;
    }

    if (!preg_match('/^[a-zA-Z]{1,12}$/', $name)) {
        $_SESSION['error'] = '⚠️Name should be with  letters only and between 1 to 12 characters⚠️';
        return false;
    }

    if (strlen($email) > 30) {
        $_SESSION['error'] = '⚠️Your email should not exceed 15 characters⚠️';
        return false;
    }


    if (!preg_match("~@gmail\.com$~", $email)) {
        $_SESSION['error'] = '⚠️You should use an @gmail account⚠️';
        return false;
    }


    if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[^a-zA-Z,])(?!.*\s).{8,16}$/', $password)) {
        $_SESSION['error'] = '⚠️Your password need to be at least 8 (up to 16) characters with at least : uppercase letter,lowercase letter, a number and a special character (, excluded)⚠️ ';
        return false;
    }

    if (!preg_match('/^[^,\s]{1,10}$/', $username)) {
        $_SESSION['error'] = '⚠️Your username should not contain a comma and be at the most 10 characters long⚠️';
        return false;
    }



    $birthday = new DateTime($birthday);
    $now = new DateTime();
    $interval = $now->diff($birthday);
    $age = $interval->y;

    if ($age < 18) {
        $_SESSION['error'] = '⚠️You need to be at least 18⚠️';
        return false;
    }



    $users = file("../../data/users.csv", FILE_IGNORE_NEW_LINES);

    foreach ($users as $user) {
        list($existingSurname, $existingName, $existingUsername, $existingEmail, $existingBirthday, $existingPassword, $existingProfilePic) = explode(",", $user);

        if ($existingUsername == $username) {
            $_SESSION['error'] = '⚠️Username already exist⚠️';
            return false;
        }

        if ($existingEmail == $email) {
            $_SESSION['error'] = '⚠️An account with this email already exist⚠️';
            return false;
        }
    }

    return true;
}

function verify_login($username, $password)
{
    $users = file("../data/users.csv", FILE_IGNORE_NEW_LINES);
    $banned = file("../data/banned.csv", FILE_IGNORE_NEW_LINES);

    foreach ($users as $user) {
        list($existingSurname, $existingName, $existingUsername, $existingEmail, $existingBirthday, $existingPassword, $existingGender, $existingDate, $existingSub, $existingProfilPath, $existingReports, $existingRole) = explode(",", $user);

        if ($existingUsername == $username && $existingPassword == $password) {
            if ($existingRole == 'banned') {
                foreach ($banned as $ban) {
                    list($bannedEmail, $banReason) = explode(",", $ban);
                    if ($bannedEmail == $existingEmail) {
                        $reason = $banReason;
                        break;
                    }
                }
                $_SESSION['role'] = 'banned';
                $unbanButton = "<a href='../web/request/unban_request.php'>Yes</a>";
                $_SESSION['error'] = "⚠️You have been banned because of $reason ⚠️<br>Do you want to ask to be unbanned?<br> " . $unbanButton . " <a href=login/new/registerHub.php>No</a>";
                return false;
                exit();
            } else {
                $_SESSION['role'] = $existingRole;
                $_SESSION['status'] = $existingSub;
                return $existingProfilPath;
            }
        }
    }
    $_SESSION['error'] = '⚠️Username or password incorrect⚠️';
    return false;
}

function totitle($string)
{
    return ucfirst(strtolower($string));
}
?>
