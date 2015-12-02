<?php
ini_set('display_errors', 1);
$token = 'null';
setcookie("session_id", $token, time() + (86400 * 30), "/");  //name, value, expiry, directories where valid.
$headers = header('Location: ../well/well.php');
$mysqli->close();
?>


