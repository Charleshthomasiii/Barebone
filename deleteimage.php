<?php

  session_start();
  include('config.php');

  if ($_SESSION['loggedin'] !== 'yes') {
    header("Location: index.php?error=notloggedin");
  }

  else {

    // they are logged in!

    // grab the filename they want to delete
    $filename = $_GET['image'];

    // see if this image exists
    if (file_exists($uploads_path . '/' .
        $_SESSION['username'] . '/' . $filename)) {

          // delete!
          unlink($uploads_path . '/' .
              $_SESSION['username'] . '/' . $filename);

          // get rid of the text file
          $s = explode(".", $filename);
          $textfilename = $s[0] . '.txt';

          unlink($uploads_path . '/' .
              $_SESSION['username'] . '/' . $textfilename);

          header("Location: index.php?confirmation=deleted");
        }

    else {
      header("Location: index.php?error=filenotfound");
    }


  }


?>
