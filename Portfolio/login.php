<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio";
$recaptcha_secret = '6Ld5BfMpAAAAAHBM7cYPD5hGtCuY1il57w5PeDvh'; // Replace with your actual secret key

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'];
    $password = $_POST['Passwd'];

    // Prepare SQL statement
    $sql = "SELECT id, email, username, passwd FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, verify password
        $user = $result->fetch_assoc();
        $hashed_password = $user['passwd'];

        if (password_verify($password, $hashed_password)) {
            // Password is correct, start session and redirect to profile page
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['username'] = $user['username'];
            header("Location: profile.php");
            exit();
        } else {
            // Password is incorrect
            echo "Invalid email or password";
        }
    } else {
        // User not found
        echo "Invalid email or password";
    }
}

$conn->close();
?>
