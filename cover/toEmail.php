<?php
$user_email = $_POST['email'];
$file = 'emails.txt';

$current = file_get_contents($file);
$current .= "$user_email\n";

file_put_contents($file, $current);
echo 'good';
?>
