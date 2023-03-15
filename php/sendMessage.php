<?php

session_start();

require('./config.php');

$current_user = $_SESSION['user_id'];
$receiver_id = $_POST['receiverId'];
$text = $_POST['txt'];
$sent = time();

$sendMessageSenderQuery = "INSERT INTO messages (sender_id, receiver_id, sent, text) VALUES ('$current_user', '$receiver_id', '$sent', '$text')";

$result = mysqli_query($connection, $sendMessageSenderQuery);

if($result == null){
    echo "Failed to sent message.";
    exit();
}

echo "Success";

mysqli_close($connection);


?>