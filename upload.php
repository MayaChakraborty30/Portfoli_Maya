<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    exit("Unauthorized access");
}

$user_id = $_SESSION['user_id'];

$upload_dir = 'C:/xampp/htdocs/Portfolio/uploads/';
$upload_file = $upload_dir . basename($_FILES['profile_image']['name']);

if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_file)) {
    echo "File uploaded successfully.";
} else {
    echo "Error uploading file.";
}
?>
