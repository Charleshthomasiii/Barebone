<?php

  // start up the session to see if they are already logged in
  session_start();

  if ($_SESSION['loggedin'] === 'yes') {
    // send them back to the main page
    header("Location: index.php");
    exit;
  }

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
        <a href="index.php"><h1>InstaFace</h1></a>
        <div id="right">
          <form method="get" action="search.php">
            <a id="signup" href="signup.php">sign up</a> -
            <a id="login" href="login.php">login</a> -
            <input type="text" name="search" id="search" value="search">
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
        </div>
        <br style="clear: both;">
      </div>

      <div id="content">

        <form method="post" action="login-process.php">
          <p>Username:</p>
          <input type="text" class="name" name="username" id="username">
          <p>Password:</p>
          <input type="text" class="name" name="password" id="password">
          <input type="submit" value="Login">
        </form>

      </div>
    </div>
  </body>
</html>
