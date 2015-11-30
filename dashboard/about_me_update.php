<?php
ini_set('display_errors', 1);
$about_me = $_POST['about_me'];
$session_id = $_COOKIE['session_id'];

//Create mysqli connection.
$mysqli = new mysqli("localhost", "client", "passphrase", "user_data");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 

//Update about_me according to current session_id.
$stmt = $mysqli->prepare("UPDATE user_login SET about_me=? WHERE session_id=?"); // prepate a query
$stmt->bind_param('ss', $about_me, $session_id); 
$stmt->execute();

//Close statement and mysqli connection
$stmt->close();
$mysqli->close();

echo 'database updated with ' . $about_me;
echo 'cookie looks like ' . $session_id;
?>

