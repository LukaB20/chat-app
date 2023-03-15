<?php
session_start();

@include_once('./config.php');

$user_id = $_SESSION['user_id'];

$searchString = $_POST['inputString'];

if(!empty($searchString)){

        if(strpos($searchString, " ") !== false){
            $userName = explode(" ", $searchString);
            $fname = $userName[0];
            $lname = $userName[1];
            $searchQuery = "SELECT *
                            FROM user
                            WHERE user_id <> '$user_id'
                            AND firstname in (
                                SELECT firstname
                                FROM user
                                WHERE firstname like '%$fname%'
                            )
                            AND lastname in (
                                SELECT lastname
                                FROM user
                                WHERE lastname like '%$lname%'
                            )
                            AND user_id not in (
                                SELECT friend_id
                                FROM friendship
                                WHERE user_id = '$user_id'
                            )
            ";
        }else{
            $searchQuery = "SELECT *
                            FROM user
                            WHERE user_id <> '$user_id'
                            AND firstname in (
                                SELECT firstname
                                FROM user
                                WHERE firstname like '%$searchString%'
                            )
                            AND user_id not in (
                                SELECT friend_id
                                FROM friendship
                                WHERE user_id = '$user_id'
                            )
            ";
        }

        $queryResult = mysqli_query($connection, $searchQuery);

        if($queryResult != null){

        $data = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
        echo json_encode($data);
        }
}else{

    $data = array();
    echo json_encode($data);

}

?>