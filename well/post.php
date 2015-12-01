<?php
ini_set('display_errors', 1);
$session_id = $_COOKIE['session_id'];

$title = htmlspecialchars($_POST['title']);
$text = htmlspecialchars($_POST['text_body']);

//Create mysqli connection.
$mysqli = new mysqli("localhost", "client", "passphrase", "user_data");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 

//Get current username from db.
$stmt = $mysqli->prepare("SELECT username FROM user_login WHERE session_id=?"); // prepate a query
$stmt->bind_param('s', $session_id); 
$stmt->execute();
$stmt->bind_result($result);
while($stmt->fetch()) {
        $username = $result;
}
$stmt->close();

//Insert data into mysql table.
$thread = "INSERT INTO threads (post_creator, creation, title, body)
VALUES ('$username', now(), '$title', '$text')";

if ($mysqli->query($thread) === TRUE) {
    echo "New thread created successfully";
} else {
    echo "Error: " . $thread . "<br>" . $mysqli->error;
}

//Close statement and mysqli connection
$mysqli->close();

echo 'session id = ' . $session_id . ' title = ' . $title . ' text = ' . $text . ' username = ' . $username;

?>


