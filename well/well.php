<?php
ini_set('display_errors', 1);
$session_id = $_COOKIE['session_id'];

//create connection.
$mysqli = new mysqli("localhost", "client", "passphrase", "user_data");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 
//Get 1. post_id, 2.post_creator, 3. title, 4. creation, 5. body 6. status.
$stmt = $mysqli->prepare("SELECT * FROM threads WHERE status = 'NO'");
$stmt->execute();
$stmt->bind_result($post_id, $post_creator, $title, $creation, $body, $status);

//$page hold the list of all threads
$page = array();
//each $well is a single thread.
$i = 0;
while($stmt->fetch()) {
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

    <title>Well</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src='../js/server.js'> </script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="well.css" rel="stylesheet">
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
            <li><a href="../dashboard/dashboard.php">Home</a></li>
            <li class="active"><a href="#">Thought Well</a></li>
            <li><a href="../login/logout.php">Logout</a></li>
          </ul>

          <!-- Top right navbar Elements. Bitcoin Balance. -->
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../wallet/wallet.html">Balance: <span class="glyphicon glyphicon-bitcoin"></span> 0.000442</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <!-- Forum Activity -->
      <h4> Thought Well <button class='btn btn-md btn-primary' id='post_btn' onclick="location.href = 'post.html'"> Post a question </button> </h4>

        <?php 
          for($x = count($page) - 1; $x >= 0 ; $x--) {
            echo '<div class="well well-sm">';
            echo '<h4>' . $page[$x]->title . '</h4>';
            echo '<p>' . $page[$x]->text . '</p>';
            echo '</div>';
          }
        ?>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
