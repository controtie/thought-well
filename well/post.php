<?php ?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Dashboard">
    <meta name="author" content="">

    <title>Post a Question</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="post.css" rel="stylesheet">
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
            <?php include '../login/navbar_login.php'; ?>
          </ul>

          <!-- Top right navbar Elements. Bitcoin Balance. -->
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../wallet/wallet.php">Balance: <span class="glyphicon glyphicon-bitcoin"></span> 0.000442</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Body -->
    <div class="container" id="post_body">

      <!-- Form submission text -->
      <form method="post" action="new_post.php">
        <div class="well well-sm">
          <h4> Title </h4>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="well well-sm">
          <h4> Text </h4>
            <textarea name="text_body" cols='50' rows='5' required> </textarea> 
          <button class="btn btn-primary" type="submit" value="Submit">Submit</button>
        </div>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

