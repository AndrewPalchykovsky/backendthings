<?php
require "db.php";
session_start();
$_SESSION['message'] = '';
// connecting user's data to database

$data = $_POST;
if ( isset($data['do_signup']) ){
    if( $data['psw'] == $data['psw2'] ){
        $username = $conn->real_escape_string($_POST['usrname']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = md5($_POST['psw']);
        $sql_e = "SELECT * FROM users WHERE email='$email'";
        $res_e = mysqli_query($conn, $sql_e);
        
        if(mysqli_num_rows($res_e) > 0){
            $_SESSION['message'] = 'This email is already taken'; 	
        }
        else {
            
            $sql = "INSERT INTO users (username, email, password)
            VALUES ('$username', '$email', '$password')";
            $_SESSION['username'] = $username;
            header('Location: login.php');
            
        }
        
        
        
        if ($conn->query($sql) === true){
            $_SESSION['message'] = "Registration succesful! Added $username to the database!";
            
        }
    }
    else {
        $_SESSION['message'] = "Passwords are not equal";
        
    }
}

else {
    $_SESSION['message'] = 'User could not be added to the database!';
}




$conn->close();
?>


