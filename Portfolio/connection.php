<?php
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "portfolio";
$recaptcha_secret = '6Ld5BfMpAAAAAHBM7cYPD5hGtCuY1il57w5PeDvh'; // Replace with your actual secret key


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
