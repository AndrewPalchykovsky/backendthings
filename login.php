<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php
require "db.php";
session_start();
$_SESSION['message'] = '';
// connecting user's data to database

$data = $_POST;
if ( isset($data['do_login']) ){
  $sql = "SELECT username, password FROM users WHERE username = ?";
        
}



$conn->close();
?>





<div class="container">
<div class="alert alert-error"><?= $_SESSION['message'] ?></div>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?php echo @$data['email']; ?>" required>
   
    <label for="psw">Password</label>
    <input type="password" id="psw" name="psw" value="<?php echo @$data['psw']; ?>"  required>
  
    
    
    <input type="submit" value="Login" name="do_login">
  </form>
</div>
</body>
</html>

