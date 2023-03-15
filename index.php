<?php
    session_start();

    if(isset($_SESSION['user_id'])){
        header("Location: profile.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container">
        <div class="title">Chat App</div>
        <div class="error-txt"></div>
        <form action="php/login.php" id="login-form">
            <div class="field">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="Enter your email">
            </div>
            <div class="field">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password">
            </div>
            <div class="field">
                    <input type="submit" name="submit" id="login" value="Login">
            </div>
        </form>
        <div class="link">Not signed up? <a href="registration.php">Sign up now</a></div>
    </div>
    
    <script src="ajax/login_ajax.js"></script>
</body>
</html>