<?php
//ini_set('display_errors', 1);
$session_id = $_COOKIE['session_id'];
$profile = $_GET["name"];

//create connection.
$mysqli = new mysqli("localhost", "client", "passphrase", "user_data");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 
//Get everything you need: username, and about me.
//We can/should change this later to be done by putting more info in if session_id happens to match.
if(isset($profile)) {
  $stmt = $mysqli->prepare("SELECT about_me, username FROM user_login WHERE username=?");
  $stmt->bind_param('s', $profile);
}
else if (isset($session_id)) {
  $stmt = $mysqli->prepare("SELECT about_me, username FROM user_login WHERE session_id=?");
  $stmt->bind_param('s', $session_id);
} 
$stmt->execute();
$stmt->bind_result($about_me, $username);

while($stmt->fetch()) {
        $about_info = $about_me;
        $user_info = $username;
}
$stmt->close();

$threads = $mysqli->prepare("SELECT * FROM threads WHERE post_creator=?");
$threads->bind_param('s', $user_info);
$threads->execute();
$threads->bind_result($post_id, $post_creator, $title, $creation, $body, $status);

//$page hold the list of all threads
$page = array();
//each $well is a single thread.
$i = 0;
while($threads->fetch()) {
        $well = new stdClass();
        $well->id = $post_id;
        $well->user = $post_creator;
        $well->title = $title;
        $well->date = $creation;
        $well->text = $body;
        $well->status = $status;
        $page[$i] = $well;
        $i++;
} 

?> 

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Dashboard">
    <meta name="author" content="">

    <title>Dashboard</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <!-- Javascript server actions -->
    <script src='../js/server.js'> </script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">Thoughtwell.io</a>
        </div>


        <!-- Top left navbar Elements. Home, Market, Logout. -->
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">

            <!-- Handles Nav_bar buttons Button in navbar -->
            <?php include '../login/navbar_login.php'; ?>
          </ul>

          <!-- Top right navbar Elements. Bitcoin Balance. -->
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../wallet/wallet.php">Balance: <span class="glyphicon glyphicon-bitcoin"></span> 0.000442</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <!-- User Profile Information -->
      <div class="container">
        <h2> <img id='profile' src="morty.png"> </img> <?php echo $username ?></h2> 
        <p id='about_me'> <?php echo $about_me ?> </p>
        <a id="myLink" href="#" onclick="edit_about_me();return false;">Edit</a>
      </div> 

      <!-- User Activity Information-->
      <h4> User Activity </h4>
<?php 
  for($x = count($page) - 1; $x >= 0 ; $x--) {
    echo '<div class="container" id="thread_body">';
    echo   '<div class="well">';
    echo      '<div id="meta_left">';
    echo      '<p> Post: <a href = "../well/threads/threads.php?id=' . $page[$x]->id . '">' . $page[$x]->id . '</a> <br> by <a href="dashboard.php?name=' . $page[$x]->user .'">' . $page[$x]->user . '</a> </p>';  
    echo      '</div>';
    
    echo      '<div id="meta_right">';
    echo      '2 hours old <br> <a> OPEN </a> for 0.0014 BTC </p>';
    echo      '</div>';
    
    echo      '<div class="well well-sm">';
    echo      '<h4>' . $page[$x]->title . '</h4>';
    echo      '<p>' . $page[$x]->text . '</p>';
    echo      '</div>';
    echo   '</div>';
    echo '</div> <!-- /container -->';
  }
?>


    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
  </body>
</html>

