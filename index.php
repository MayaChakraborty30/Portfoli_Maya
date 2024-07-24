<?php include('connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login and Signup Form</title>
  <link href="https://fonts.googleapis.com/css?family=Oswald|Roboto" rel="stylesheet">
  <style>
    body {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      font-family: 'Roboto', sans-serif;
      background-color: #2a3640;
      overflow: hidden;
    }

    .table {
      display: table;
      width: 100%;
      height: 100%;
    }

    .table-cell {
      display: table-cell;
      vertical-align: middle;
      transition: all 0.5s;
    }

    .container {
      position: relative;
      width: 600px;
      margin: 30px auto 0;
      height: 320px;
      background-color: #2a3640;
      top: 50%;
      margin-top: -160px;
      transition: all 0.5s;
    }

    .box {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
    }

    .container-forms {
      position: relative;
    }

    .btn {
      cursor: pointer;
      text-align: center;
      margin: 0 auto;
      width: 60px;
      color: #fff;
      background-color: #d89d79;
      opacity: 1;
      transition: all 0.5s;
      padding: 10px 15px;
      display: inline-block;
      border: none;
    }
    .btn:hover {
      opacity: 0.7;
    }

    input {
      margin: 0 auto 15px;
      display: block;
      width: calc(600px / 2 - 80px);
      transition: all 0.3s;
      padding: 10px 15px;
    }

    .container-forms .container-info {
      text-align: left;
      font-size: 0;
    }

    .container-forms .container-info .info-item {
      text-align: center;
      font-size: 16px;
      width: 300px;
      height: 320px;
      display: inline-block;
      vertical-align: top;
      color: #fff;
      opacity: 1;
      transition: all 0.3s;
    }

    .container-forms .container-info .info-item p {
      font-size: 20px;
      margin: 20px;
    }

    .container-forms .container-info .info-item .btn {
      background-color: transparent;
      border: 1px solid #fff;
    }

    .container-forms .container-info .info-item .table-cell {
      padding-right: 35px;
    }

    .container-forms .container-info .info-item:nth-child(2) .table-cell {
      padding-left: 35px;
      padding-right: 0;
    }

    .container-form {
      overflow: hidden;
      position: absolute;
      left: 30px;
      top: -30px;
      width: 305px;
      height: 380px;
      background-color: #fff;
      box-shadow: 0 0 15px 0 rgba(0, 0, 0, 0.2);
      transition: all 0.5s;
    }

    .container-form .btn {
      position: relative;
      margin-top: 30px;
      text-align: center;
      display: block;
      width: calc(100% - 60px);
    }

    .form-item {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      opacity: 1;
      transition: all 0.5s;
    }

    .form-item.sign-up {
      position: absolute;
      left: -100%;
      opacity: 0;
    }

    .container.log-in .box:before {
      position: absolute;
      left: 180px;
      top: 62px;
      height: 265px;
    }

    .container.log-in .box:after {
      top: 22px;
      left: 192px;
      width: 324px;
      height: 220px;
    }

    .container.log-in .container-form {
      left: 265px;
    }

    .container.log-in .container-form .form-item.sign-up {
      left: 0;
      opacity: 1;
    }

    .container.log-in .container-form .form-item.log-in {
      left: -100%;
      opacity: 0;
    }

    .rabbit {
      width: 50px;
      height: 50px;
      position: absolute;
      bottom: 20px;
      right: 20px;
      z-index: 3;
      fill: #fff;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="box">
      <div class="container-forms">
        <div class="container-info">
          <div class="info-item">
            <div class="table">
              <div class="table-cell">
                <p>Have an account?</p>
                <div class="btn" id="login-toggle">Log in</div>
              </div>
            </div>
          </div>
          <div class="info-item">
            <div class="table">
              <div class="table-cell">
                <p>Don't have an account?</p>
                <div class="btn" id="register-toggle">Register</div>
              </div>
            </div>
          </div>
        </div>
        <div class="container-form">
          <form class="form-item log-in" action="connection.php" method="POST">
            <div class="table">
              <div class="table-cell">
                <input type="email" name="Email" placeholder="Email" required pattern="^[a-zA-Z0-9]{1,15}@gmail\.com$" title="Email should be max 15 letters or numbers followed by @gmail.com">
                <input type="password" name="Password" placeholder="Password" required pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[-_.@])[A-Za-z\d-_.@]{8,}$" title="Password must be at least 8 characters and include at least one letter, one number, and one special character (-_.@)">
                <div class="g-recaptcha" data-sitekey="6LcNifApAAAAALmx9oXrE8RwUCYCWSYkSfpudP3v"></div>
                <button type="submit" class="btn">Log in</button>
              </div>
            </div>
          </form>
          <form class="form-item sign-up" action="connection.php" method="POST">
            <div class="table">
              <div class="table-cell">
                <input type="email" name="email" placeholder="Email" required pattern="^[A-Za-z]{1,15}@gmail\.com$" title="Email should be max 15 letters or numbers followed by @gmail.com">
                <input type="text" name="phoneNo" placeholder="Phone No" required pattern="^\d{10}$" title="Phone number must be 10 digits">
                <input type="text" name="username" placeholder="Username" required pattern="^[A-Za-z]{1,25}$" title="Username must be between 1 and 25 alphabetic characters">
                <input type="password" name="Password" placeholder="Password" required pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[-_.@])[A-Za-z\d-_.@]{8,}$" title="Password must be at least 8 characters and include at least one letter, one number, and one special character (-_.@)">
                <div class="g-recaptcha" data-sitekey="6LcNifApAAAAALmx9oXrE8RwUCYCWSYkSfpudP3v"></div>
                <button type="submit" class="btn">Register</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <a class="box-item" href="https://codepen.io/Anna_Batura/" target="_blank">
        <svg class="rabbit" viewBox="0 0 600 600" version="1.2">
          <path id="rabbit" d="m 335.94313,30.576451 ..."></path>
        </svg>
      </a>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#login-toggle").click(function() {
        $(".container").removeClass("log-in");
      });

      $("#register-toggle").click(function() {
        $(".container").addClass("log-in");
      });
    });
  </script>
</body>
</html>
