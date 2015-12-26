<?php
ini_set('display_errors', 1);
$email = $_POST['email'];
$password = $_POST['password'];

//Create mysql connection.
$mysqli = new mysqli("localhost", "client", "passphrase", "user_data");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 

//Get hashed password.
$query = $mysqli->prepare("SELECT password FROM user_login WHERE email=?"); // prepate a query
$query->bind_param('s', $email); 
$query->execute();
$query->bind_result($db_pass);

//Check hashed pass vs. input pass.
while ($query->fetch()) {
	if (password_verify($password, $db_pass)) {
		
		//If good, generate session token.
		$token = base64_encode( openssl_random_pseudo_bytes(32, $cstrong));
		
		//Set cookie and send them off to the dashboard.
		setcookie("session_id", $token, time() + (86400 * 30), "/");  //name, value, expiry, directories where valid.
		$headers = header('Location: ../dashboard/dashboard.php');
	
	} else {
		$headers = header('Location: ../dashboard/dashboard.php');
	}
}

//Update database record of session cookie.
if(isset($token)){
$update_id = $mysqli->prepare("UPDATE user_login SET session_id='$token' WHERE email=?"); // prepate a query
$update_id->bind_param('s', $email); 
$update_id->execute(); // perform the query
}
$mysqli->close();
?>

