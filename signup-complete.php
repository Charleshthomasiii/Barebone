<?php

  include ('config.php');

  // get the form data
  $u = $_POST['username'];
  $p = $_POST['password'];
  $f = $_POST['firstname'];
  $l = $_POST['lastname'];

  // do one last data validation check on the data
  if (strlen($u) < 5 || !ctype_alnum($u) || file_exists($users_path.'/'.$u.'.txt')) {
    header('Location: signup.php?error=yes');
  }

  else {
    // the username is still valid and available!

    // create a file for the user under their username
    $filename = $u . '.txt';

    // build the contents for their client record
    // $pass = password_hash($p, PASSWORD_DEFAULT);
    $pass = md5($p . 'secretkey');
    $record = $u . "\n" . $pass . "\n". $f . "\n" . $l;

    // send them to the main screen so they can log into their account
    file_put_contents($users_path.'/'.$filename, $record);

    // make a directory for the user inside the 'uploads' folder
    mkdir($uploads_path . '/' . $u);

    header("Location: index.php?confirmation=signup");
  }



?>
