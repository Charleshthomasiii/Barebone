<?php

  include('config.php');

  $u = $_POST['username'];
  $p = $_POST['password'];

  // need to check to see if they filled in the form
  if (strlen($u) === 0 || strlen($p) === 0) {
    header("Location: login.php?error=yes");
  }

  // if we have everything make sure we have a user with
  // the username they supplied
  else {

      if (file_exists($users_path.'/'.$u.'.txt')) {
        // all good state!
        $data = file_get_contents($users_path.'/'.$u.'.txt');

        // cut up the data based on the \n character
        $splitdata = explode("\n", $data);

        // if (password_verify($p, $splitdata[1])) {
        if (md5($p . 'secretkey') === $splitdata[1]) {
          // log them in

          session_start();
          $_SESSION['loggedin'] = "yes";
          $_SESSION['username'] = $u;
          $_SESSION['firstname'] = $splitdata[2];
          $_SESSION['lastname'] = $splitdata[3];
          // send them back to the main page
          header("Location: index.php");
        }
        else {
          // invalid password
          header("Location: login.php?error=yes");
        }

      }
      else {
        header("Location: login.php?error=yes");
      }


  }



?>
