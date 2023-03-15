<?php
session_start();

$user_id = $_SESSION['user_id'];
$newFriendId = $_POST['friendId'];

@include_once('./config.php');

$addFriendQuery = "INSERT INTO friendship (user_id, friend_id) VALUES ($user_id, $newFriendId)";
$addFriendQuery2 = "INSERT INTO friendship (user_id, friend_id) VALUES ($newFriendId, $user_id)";
mysqli_query($connection, $addFriendQuery);
mysqli_query($connection, $addFriendQuery2);

if(mysqli_error($connection)){
    echo "Failed to add new friend.";
    exit();
}

mysqli_close($connection);

echo "success";


?>