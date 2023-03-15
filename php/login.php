<?php 
session_start();

$data = [];

if(empty($_POST['email']) or empty($_POST['password'])){
    $data += array("error" => "Invalid email or password.");
}else{
    
    @include_once("config.php");

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = '$email' and password = '$password'";
    $res = mysqli_query($connection, $sql);

    if(mysqli_affected_rows($connection) > 0){
        $user = mysqli_fetch_assoc($res);
        $user_id = $user['user_id'];
        $data += array("success" => "Success");
        $data += array("user_id" => $user_id);
        $_SESSION['user_id'] = $user_id;

        $setActiveQuery = "UPDATE user SET status='Online' WHERE user_id = '$user_id'";

        if(!mysqli_query($connection, $setActiveQuery)){
            echo mysqli_error($connection);
        }

        mysqli_close($connection);

    }else{
        $data += array("error" => "Invalid email or password.");
        mysqli_close($connection);
    }

}

echo json_encode($data);

?>