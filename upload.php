<?php

  session_start();
  include("config.php");

  // make sure they are actually logged in!
  if ($_SESSION['loggedin'] === 'yes') {

    // grab a reference to our incoming form data
    $c = $_POST['caption'];
    $f = $_FILES['image'];

    // make sure they uploaded a file
    if (!$c || !$f) {
      header("Location: index.php?error=bad1");
    }

    // form was filled out successfully!
    else {
      // make sure the file is actually an image and not something else

      // assume the file type is unknown
      $filetype = 'unknown';
      if ($f['type'] === 'image/jpeg') {
        $filetype = 'jpg';
      }
      else if ($f['type'] === 'image/png') {
        $filetype = 'png';
      }
      else if ($f['type'] === 'image/gif') {
        $filetype = 'gif';
      }

      // bad file type
      if ($filetype === 'unknown') {
        header("Location: index.php?error=filetype");
      }

      //good file type
      else {
        // create a filename
        $t = time();
        $filename = $t . '.' . $filetype;
        $captionfilename = $t . '.txt';

        // store the file for the user in their own folder
        move_uploaded_file($f['tmp_name'],
                $uploads_path.'/'.$_SESSION['username'].'/'.$filename);

        // also store a text file with the caption in it
        file_put_contents($uploads_path.'/'.$_SESSION['username'].'/'.$captionfilename, $c);

        header("Location: index.php");
      }




    }


  }

  else {
    header("Location: index.php?error=bad4");
  }




?>
