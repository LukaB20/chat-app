<?php

session_start();

$current_userId = $_SESSION['user_id'];
$friend_id = $_POST['f_id'];

@require('./config.php');

$getUserDataQuery = "SELECT * FROM user WHERE user_id = '$friend_id'";

$result = mysqli_query($connection, $getUserDataQuery);

if(mysqli_error($connection)){
    echo "Failed to load user.";
    exit();
}

$userData = mysqli_fetch_assoc($result);

echo json_encode($userData);

mysqli_close($connection);

?>