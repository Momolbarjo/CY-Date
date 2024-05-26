<?php
/*Programme PHP qui permet la connexion de quelqu'un du site. */

session_start();
$_SESSION = array();
session_destroy();
header('Location: ../index.php');
?>
