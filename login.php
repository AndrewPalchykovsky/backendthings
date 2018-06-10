<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    session_start();
    $_SESSION['message'] = '';
    require "db.php";
    require "signup.php"
?>



<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $username = mysqli_real_escape_string($db,$_POST['usrname']);
      $password = mysqli_real_escape_string($db,$_POST['psw']); 
      
      $sql = "SELECT id FROM admin WHERE username = '$username' and password = '$password'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         session_register("username");
         $_SESSION['login_user'] = $username;
         
         header("location: main.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>

<div class="container">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <label for="usrname">Username</label>
    <input type="text" id="usrname" name="usrname" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?php echo @$data['email']; ?>" required>
   
    <label for="psw">Password</label>
    <input type="password" id="psw" name="psw" value="<?php echo @$data['psw']; ?>"  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>

    
    
    <input type="submit" value="Submit" name="do_signup">
  </form>
</div>



<script src="validate.js">
</script>
</body>
</html>

