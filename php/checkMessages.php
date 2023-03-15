<?php

session_start();

@require('./config.php');

$current_user = $_SESSION['user_id'];
$friend_id = $_POST['friendId'];

$getMessagesQuery = "SELECT *
                    FROM messages
                    WHERE sender_id in ('$current_user', '$friend_id')
                    AND receiver_id in ('$current_user', '$friend_id')
";

$result = mysqli_query($connection, $getMessagesQuery);

if($result == null){
    echo "Failed to get messages.";
    exit();
}

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($data);

mysqli_close($connection);

?>