<?php
session_start();

$user_id = $_SESSION['user_id'];

$setOfflineQuery = "UPDATE user SET status='Offline' WHERE user_id='$user_id'";

@include_once('../php/config.php');

if(mysqli_query($connection, $setOfflineQuery)){
    echo mysqli_error($connection);
}

mysqli_close($connection);

session_unset();
session_destroy();

header("Location: ../index.php");

?>
