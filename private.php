<?php
  session_start();

  include ('config.php');

  // get the form data
  $setting = $_POST['view'];
  if ($setting ==="private") {
  	//assume file exists
  	file_put_contents($uploads_path.'/'.$_SESSION['username'].'/private.txt', "bloop");
  }
  else if ($setting==="public") {
  	unlink($uploads_path.'/'.$_SESSION['username'].'/private.txt');
  }

    header("Location: index.php?confirmation=privatetopublic");



?>
