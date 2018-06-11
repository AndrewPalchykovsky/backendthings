<?php 
    function redirect(){
        header('Location: index.php');
        exit();
    }


    if ( !isset($_GET['email']) || !isset($_GET['token']) ){
        redirect();
    }
    else{

        include "db.php";

        $email = $conn->real_escape_string( $_GET['email'] );
        $token = $conn->real_escape_string ( $_GET['token'] );

        $sql = $con->query("SELECT id FROM users WHERE email='$email' AND token='$token' AND emailIsConfirmed='0' ");

        if ($sql -> num_rows > 0){
            redirect();
        }


    }
?>