<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<?php
    session_start();
    $_SESSION['message'] = '';
    require "db.php";
    require "session.php";
    require "signup.php";
    
?>

<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<div class="container">
<div class="alert alert-error"><?= $_SESSION['message'] ?></div>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <label for="usrname">Username</label>
    <input type="text" id="usrname" name="usrname" value="<?php echo @$data['usrname']; ?>" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?php echo @$data['email']; ?>" required>
   
    <label for="psw">Password</label>
    <input type="password" id="psw" name="psw" value="<?php echo @$data['psw']; ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
    <input type="password" id="psw2" name="psw2" value="<?php echo @$data['psw2']; ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Passwords does not coinside" required>

    <label for="secretword">Secret word</label>
    <input type="password" id="secretword" name="secret_word" value="<?php echo @$data['secret_word']; ?>" required>

      <div class="g-recaptcha" data-sitekey="7LfAS14UAAAAAPegT5dcWtyKS4auWmWoF5d2USnk"></div>
    
    
    <input type="submit" value="Sign up" name="do_signup">
  </form>
</div>

<div id="message">
  <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<!-- Specify your onload callback function.  This function will get called when all the dependencies have loaded. -->
<script type="text/javascript">
  var onloadCallback = function() {
    alert("grecaptcha is ready!");
  };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
</script>
<script src="validate.js">

</script>
</body>
</html>

