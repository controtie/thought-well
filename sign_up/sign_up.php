<?php
ini_set('display_errors', 1);
$servername = "localhost";
$username = "client";
$password = "passphrase";
$dbname = "user_data";

$user_name = $_POST['user_name'];
$input_email = $_POST['input_email'];
$input_password = $_POST['confirm_password'];

//Create the salted password.
$options = [
    'cost' => 11,
];
$hash = password_hash($input_password, PASSWORD_BCRYPT, $options);

//Open DB connection.
$mysqli = new mysqli("localhost", "client", "passphrase", "user_data");

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
//Insert new row containing user data.
$new_user = "INSERT INTO user_login (username, email, password)
VALUES ('$user_name', '$input_email', '$hash')";

if ($mysqli->query($new_user) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $new_user . "<br>" . $mysqli->error;
}

$mysqli->close();

$headers = header('Location: ../login/login.html');

?>



