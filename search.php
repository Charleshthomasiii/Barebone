<?php
  // make available our file paths
  include("config.php");

  // start the user's session
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Assignment #7</title>
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <div id="container">

      <div id="header">
        <a href="index.php"><h1>InstaFace!</h1></a>
        <div id="right">
          <form method="get" action="search.php">
            <?php

              // they are logged in
              if ($_SESSION['loggedin'] === 'yes') {
                print "Welcome, " . $_SESSION['firstname'];
                print ' - <a href="logout.php">logout</a> - ';
              }

              // no one is logged in
              else {
                print '<a id="signup" href="signup.php">sign up</a> -
                       <a id="login" href="login.php">login</a> -';
              }

            ?>

            <input type="text" name="search" id="search" value="search">
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
        </div>
        <br style="clear: both;">
      </div>

      <div id="content">

        <?php

            // see if this person exists
            $user = $_GET['search'];
            if (file_exists($users_path . '/' . $user . '.txt')) {
              if (!file_exists($uploads_path.'/'.$user.'/private.txt')) {
                
              
                // scan through this user's home directory and find all image files
                // create an image tag for each image file that we come across
                $allfiles = scandir($uploads_path.'/'.$user);

                for ($i = 0; $i < sizeof($allfiles); $i++) {
                  if ($allfiles[$i] !== '.' && $allfiles[$i] !== '..') {
                    $info = explode(".", $allfiles[$i]);
                    if (sizeof($info) === 2 && $info[1] !== 'txt') {
                      print '<div class="piccontainer">';
                      print '<img class="pic" src="uploads/' . $user . '/' . $allfiles[$i] . '">';
                      print '<p>' . file_get_contents($uploads_path.'/'.$user.'/'.$info[0].'.txt') . '</p>';
                      print '</div>';
                    }
                  }
                }
              }
              else{
                print 'This user has set their account to private. Access denied.';
              }

              print '<br style="clear: both;">';
            }
            else {
              print '<p>User not found</p>';
            }

        ?>
      </div>
    </div>
  </body>
</html>
