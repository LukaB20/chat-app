<?php

@require('./config.php');

$uid = $_POST['uid'];

$getStatusQuery = "SELECT *
                FROM user
                WHERE user_id = '$uid';
";

$result = mysqli_query($connection, $getStatusQuery);

if($result == null){
    echo "Failed to get status.";
    exit();
}

$data = mysqli_fetch_row($result);
$status = $data[5];

echo $status;

mysqli_close($connection);