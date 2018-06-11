<?php
require "db.php";
session_start();
$_SESSION['message'] = '';
// connecting user's data to database

use PHPMailer\PHPMailer\PHPMailer;

$data = $_POST;
if ( isset($data['do_signup']) ){

    // addinghere capcha
    function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6LfAS14UAAAAANRiXH50Wjb-ASnfFUbeEDDnzXKy',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response']);

    if (!$res['success']) {
        // What happens when the CAPTCHA wasn't checked
        $_SESSION['message'] = 'Please go back and make sure you check the security CAPTCHA box.';
      
    } else {
        // If CAPTCHA is successfully completed...
        if( $data['psw'] == $data['psw2'] ){
            $username = $conn->real_escape_string($_POST['usrname']);
            $email = $conn->real_escape_string($_POST['email']);
            $password = $conn->real_escape_string($_POST['psw']);
            $secret_word= $conn->real_escape_string($_POST['secret_word']);
            $sql_e = "SELECT * FROM users WHERE email='$email'";
            $res_e = mysqli_query($conn, $sql_e);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $hashedWord = password_hash($secret_word, PASSWORD_DEFAULT);


            if(mysqli_num_rows($res_e) > 0){
                $_SESSION['message'] = 'This email is already taken'; 	
            }
            else {
                $token = 'qwertyuiopasdfghjkl;()/*$zxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890';
                $token = str_shuffle($token);
                $token = substr($token, 0, 10);

                
                $sql = "INSERT INTO users (username, email, password, s_word, isEmailConfirmed, token)
                VALUES ('$username', '$email', '$hashedPassword', '$hashedWord', '0', '$token')";
                $_SESSION['username'] = $username;

                include_once "PHPMailer/PHPMailer.php";

                $mail = new PHPMailer();
                $mail -> setFrom('customer@email.com');
                $mail -> addAddress($email,$username);
                $mail -> Subject = ' Please verify email';
                $mail -> isHTML(true);
                $mail -> Body = "
                Please click on link below to finish registration: <br>
                <a href='localhost:8000/auto-test/confirm.php?email=$email&token=$token'> Click here<a>
                ";
                if ($mail -> send() )
                


               
                // header('Location: login.php');
                if (isset($_POST['do_signup']))
                    $_SESSION['message'] = 'You has been registered. Please verify your email';
                else
                    $_SESSION['message'] = 'Something wrong happened. Please try again'; 



                {   
                ?>
                        <script type="text/javascript">
                        window.location = "login.php";
                        </script>      
                <?php
                }
                
                
            }
            
            
            
            if ($conn->query($sql) === true){
                $_SESSION['message'] = "Registration succesful! Added $username to the database!";
                
            }
        }
        else {
            $_SESSION['message'] = "Passwords are not equal";
            
        }
    }


   
}

else {
    $_SESSION['message'] = 'User could not be added to the database!';
}




$conn->close();
?>


