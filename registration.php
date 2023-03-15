<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container">
        <div class="title">Chat App</div>
        <div class="success-txt"></div>
        <div class="error-txt">This is an error message.</div>
        <form action="php/login.php" id="register-form" enctype="multipart/form-data">
            <div class="name-details">
                <div class="field">
                    <label for="firstname">Firstname</label>
                    <input type="text" name="firstname" id="firstname" placeholder="Enter your firstname">
                </div>
                <div class="field">
                    <label for="lastname">Lastname</label>
                    <input type="text" name="lastname" id="lastname" placeholder="Enter your lastname">
                </div>
            </div>
            <div class="field">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="Enter your email">
            </div>
            <div class="field">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter new password">
            </div>
            <div class="field">
                    <label for="image">Profile image</label>
                    <input type="file" name="image" id="image">
            </div>
            <div class="field">
                    <input type="submit" name="submit" id="register" value="Sign up">
            </div>
        </form>
        <div class="link">Already signed up? <a href="index.php">Login now</a></div>
    </div>
    
    <script src="ajax/register_ajax.js"></script>
</body>
</html>