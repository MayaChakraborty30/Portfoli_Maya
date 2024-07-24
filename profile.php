<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirect to login page if not logged in
    exit();
}

$servername = "localhost"; // Change if necessary
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "portfolio"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT id, email, username FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No user found";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome for icons -->
    <script src="https://use.fontawesome.com/fe459689b4.js"></script>
    <title>Profile Card with Image Upload</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #2e323a;
            color: white;
            padding: 20px 0;
            z-index: 100;
            display: flex;
            justify-content: left;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            margin-left: 30px;
        }

        .left-div {
            position: fixed;
            top: 0;
            left: 0;
            width: 30%;
            height: 100%;
            background-color: #91a09ed2;
            display: flex;
            align-items: center;
        }

        .profile-picture {
            opacity: 0.75;
            height: 250px;
            width: 250px;
            border-radius: 500px;
            position: relative;
            overflow: hidden;
            background-size: cover;
            box-shadow: 0 8px 6px -6px black;
            margin: 70px;
        }

        .upload-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .file-uploader {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .right-div {
            position: fixed;
            top: 0;
            right: 0;
            width: 70%;
            height: 100%;
            background-color:#91a09ed2;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
        }

        .fetched-inputs {
            background-color: lightgray;
            border-radius: 20px;
            padding: 20px;
            padding-right: 200px;
            margin-top: 49px;
            margin-right: 610px;
            margin-bottom: 20px;
        }

        .form-input {
            display: flex;
            flex-direction: column;
        }

        .form-input label {
            font-weight: bold;
        }

        .form-input input {
            width: 200px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: bold;
            color: black;
            background-color: lightgray;
        }

        .btn {
            margin-right: 610px;
            padding: 12px;
            border-radius: 12px;
            background-color: #2e323a;
            color: white;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #91a09ed2;
            border-color: #91a09ed2;
        }
    </style>
</head>
<nav class="navbar">
    <h1 class="logo">Profile</h1>
</nav>
<body>
    <div class="left-div">
        <div class="profile-picture" id="profile-picture" style="background-image: url('iconn.jpg');">
            <input class="file-uploader" type="file" id="image-upload" onchange="displayImage(this)" accept="image/*">
            <h1 class="upload-icon">
                <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
            </h1>
        </div>
    </div>
    <div class="right-div">
        <div class="fetched-inputs">
            <div class="form-input">
                <label for="fetched-user-id">ID:</label>
                <input type="text" id="fetched-user-id" name="fetched-user-id" value="<?php echo $user['id']; ?>" readonly>
            </div>
            <div class="form-input">
                <label for="fetched-email">Email:</label>
                <input type="email" id="fetched-email" name="fetched-email" value="<?php echo $user['email']; ?>" readonly>
            </div>
            <div class="form-input">
                <label for="fetched-username">Username:</label>
                <input type="text" id="fetched-username" name="fetched-username" value="<?php echo $user['username']; ?>" readonly>
            </div>
        </div>
        <button class="btn" onclick="saveProfile()">Save</button>
    </div>

    <script>
        function displayImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-picture').style.backgroundImage = 'url(' + e.target.result + ')';
                    document.querySelector('.upload-icon').style.display = 'none'; // Hide upload icon
                    document.getElementById('profile-picture').style.opacity = '1'; // Full opacity
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function saveProfile() {
            var fileInput = document.getElementById('image-upload');
            if (fileInput.files.length > 0) {
                var formData = new FormData();
                formData.append('profile_image', fileInput.files[0]);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'upload.php');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        alert('Profile image uploaded successfully.');
                    } else {
                        alert('Error uploading profile image. Please try again.');
                    }
                };
                xhr.send(formData);
            } else {
                alert('Please select an image to upload.');
            }
        }
    </script>
</body>
</html>
