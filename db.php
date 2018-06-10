<?php
$dbservername = "localhost";
$dbusername = "automata";
$dbpassword = "1234";
$dbname = "automata";


// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>

