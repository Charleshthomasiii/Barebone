<?php
  session_start();
  include('config.php');

  // grab the username!
  $u = $_POST['username'];

  // usernames must be 5 characters long
  if (strlen($u) < 5) {
    print "Username too short";
  }

  // usernames must be all alphabetic and numeric
  else if (!ctype_alnum($u)) {
    print "Username cannot contain non-alpha numeric characters!";
  }

  // usernames must be unique and unused by anyone else
  else if ($u !=$_SESSION['username'] && file_exists($users_path.'/'.$u.'.txt')) {
    print "Username taken!"; //if not current usernam and if it exists
  }

  else {
    print "OK";
  }

?>
