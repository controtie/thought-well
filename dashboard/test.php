<?php
ini_set('display_errors', 1);
$session_id = $_COOKIE['session_id'];

//create connection.
$mysqli = new mysqli("localhost", "client", "passphrase", "user_data");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 
//Get everything you need: username, and about me.
//We can/should change this later to be done by putting more info in if session_id happens to match.
$stmt = $mysqli->prepare("SELECT about_me, username FROM user_login WHERE session_id=?");
$stmt->bind_param('s', $session_id);
$stmt->execute();
$stmt->bind_result($about_me, $username);

while($stmt->fetch()) {
        $about_info = $about_me;
        $user_info = $username;
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
          <a class="navbar-brand" href="#">Thoughtwell.io</a>
        </div>


        <!-- Top left navbar Elements. Home, Market, Logout. -->
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="../well/well.html">Thought Well</a></li>
            <li><a href="#exit">Logout</a></li>
          </ul>

          <!-- Top right navbar Elements. Bitcoin Balance. -->
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../wallet/wallet.html">Balance: <span class="glyphicon glyphicon-bitcoin"></span> 0.000442</a></li>
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
        <div class="well well-sm">
          <h4> Should I go to college? </h4>
          <p> I'm not really sure if it's worth the money, and people say its not that important these days...</p>
        </div>
        <div class="well well-sm">
          <h4> Will Shadowfiend ever not be 'in the meta' for Dota 2? </h4>
          <p> Shadowfiend excels in almost any meta because his early farming rate is so high and effective.</p>
        </div>
        <div class="well well-sm">
          <h4> How do I assign a PHP variable to a MYSQL query? </h4>
          <p> Look at this documentation for help...</p>
        </div>
        <div class="well well-sm">
          <h4> What's the point of buying bonds at negative interest rates? </h4>
          <p> Now even the 2 yr German bonds are trading at less than 0% interest... </p>
        </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  </body>
</html>

