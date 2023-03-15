<?php

session_start();

$current_user = $_SESSION['user_id'];
$friend_id = $_POST['uid'];

@require('./config.php');

$getLastMessageQuery = "SELECT *
                        FROM messages
                        WHERE sender_id = '$friend_id'
                        AND receiver_id = '$current_user'
                        ORDER BY message_id DESC LIMIT 1
";

$result = mysqli_query($connection, $getLastMessageQuery);

if($result == null){
    echo "Failed to get last message.";
    exit();
}

$data = mysqli_fetch_row($result);

if(mysqli_affected_rows($connection) < 1){
    echo "";
}else{
    echo $data[3];
}

mysqli_close($connection);

?>