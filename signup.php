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
    <title>Barebone</title>
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

        <div id="content_signup">
          Signing up is easy!  Simply fill out the form below to set up your account.
          <form id="form_signup" method="post" action="signup-complete.php">
            <p>First Name:</p>
            <input type="text" class="name" name="firstname" id="firstname"> <span id="firstnameok"></span>
            <p>Last Name:</p>
            <input type="text" class="name" name="lastname" id="lastname"> <span id="lastnameok"></span>
            <p>Username:</p>
            <input type="text" name="username" id="username"> <span id="usernameavailable"></span>
            <p>Password:</p>
            <input type="text" name="password" id="password"> <span id="passwordok"></span>
            <br><br>
            <input type="submit" id="submit" name="submit" id="button_signup" style="display: none;">
          </form>
        </div>

      </div>

    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">

      $(document).ready(function() {


        // validate password (> 8 characters)
        $("#password").on("focus input focusout", function(event) {
          if (event.currentTarget.value.length < 8) {
            event.currentTarget.nextElementSibling.innerHTML = "Invalid Password";
          }
          else {
            event.currentTarget.nextElementSibling.innerHTML = "OK";
          }

          checkButton();

        });

        // validate firstname & lastname
        $(".name").on("focus input focusout", function(event) {
          if (event.currentTarget.value.length === 0) {
            event.currentTarget.nextElementSibling.innerHTML = "Invalid Name";
          }
          else {
            event.currentTarget.nextElementSibling.innerHTML = "OK";
          }

          checkButton();

        });


        // validate username
        $("#username").on("focus input focusout", function(event) {

          // ask the server if we know about this username
          $.post(
                 'signup-process.php',
                 {
                   username: event.currentTarget.value
                 },
                 function(data, status) {
                   event.currentTarget.nextElementSibling.innerHTML = data;
                   checkButton();
                 });
        });


        // check button status
        function checkButton() {
          var u = document.getElementById('usernameavailable');
          var l = document.getElementById('lastnameok');
          var f = document.getElementById('firstnameok');
          var p = document.getElementById('passwordok');

          if (u.innerHTML === 'OK' && l.innerHTML === 'OK' &&
              f.innerHTML === 'OK' && p.innerHTML === 'OK') {
            document.getElementById('submit').style.display = 'block';
          }
          else {
            document.getElementById('submit').style.display = 'none';
          }
        }




      });


    </script>

  </body>

</html>
