<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['Email'];
    $phoneNo = $_POST['Phone_no'];
    $username = $_POST['Username'];
    $password = $_POST['Passwd'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (email, phoneNo, username, passwd) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $phoneNo, $username, $hashed_password);

    if ($stmt->execute()) {
        // Set success message as URL parameter
        header("Location: login.html?success=Registration%20successful.%20You%20can%20now%20login.");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
