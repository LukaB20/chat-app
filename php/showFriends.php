<?php

session_start();

$currentUser = $_SESSION['user_id'];

@include_once('./config.php');

$showFriendsQuery = "SELECT *
                    FROM user
                    WHERE user_id in (
                        SELECT friend_id
                        FROM friendship
                        WHERE user_id = '$currentUser'
                    )
";

$result = mysqli_query($connection, $showFriendsQuery);

if(!$result){
    echo mysqli_error($connection);
    exit();
}

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($data);

mysqli_close($connection);

?>