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
                print ' - <a href="logout.php">logout</a>';
                print ' - <a href="account.php">manage my account</a> - ';
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
          if ($_SESSION['loggedin'] === 'yes') {

            // upload file interface
            print '<p>Add a new image to your feed!</p>
            <form method="post" action="upload.php" enctype="multipart/form-data">
              <input type="file" name="image">
              <p>Caption</p>
              <input type="text" name="caption">
              <input type="submit">
            </form>';
            print '<p>Set profile to public or private</p>
            <form method="post" action="private.php">';

            if (file_exists($uploads_path.'/'.$_SESSION['username'].'/private.txt')) {
              print 'You account is currently private.';
              print '<input type="radio" class="name" name="view" value="public" id="public">Public <br>';
            }
            else{
              print 'You account is currently public.';
              print '<input type="radio" class="name" name="view" value="private" id="private">Private<br>';
            }
            print '<input type="submit">
                   </form>';


            // scan through this user's home directory and find all image files
            // create an image tag for each image file that we come across
            $allfiles = scandir($uploads_path.'/'.$_SESSION['username']);

            for ($i = 0; $i < sizeof($allfiles); $i++) {
              if ($allfiles[$i] !== '.' && $allfiles[$i] !== '..') {
                $info = explode(".", $allfiles[$i]);
                if (sizeof($info) === 2 && $info[1] !== 'txt') {
                  print '<div class="piccontainer">';
                  print '<img class="pic" src="uploads/' . $_SESSION['username'] . '/' . $allfiles[$i] . '">';
                  print '<p>' . file_get_contents($uploads_path.'/'.$_SESSION['username'].'/'.$info[0].'.txt') . '</p>';
                  print '<p><a href="deleteimage.php?image=' . $allfiles[$i] . '">Delete Image</a>';
                  print '</div>';
                }
              }
            }

            print '<br style="clear: both;">';

          }
          else {
            print 'Welcome to InstaFace!  Please sign up or log in using the links above!';
          }
        ?>
      </div>
    </div>
  </body>
</html>




<!--

<p>Add a new image to your feed!</p>
<form method="post" action="upload.php" enctype="multipart/form-data">
  <input type="file" name="image">
  <p>Caption</p>
  <input type="text" name="caption">
  <input type="submit">
</form>

-->