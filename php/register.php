<?php

    $data = [];
    $allowed_extensions = array("jpg", "jpeg", "gif", "png", "png", "jpg");
    $allowed_size = 10000000;

    if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_FILES['image']['name'])){
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $data += array("emailerror" => "Invalid email adress.");
        }else{

            $filename = $_FILES['image']['name'];
            $extension = explode(".", $filename)[1];
            $target_directory = "../assets/";
            mkdir($target_directory . $_POST['firstname'] . $_POST['lastname'] . time());
            $target_file = $target_directory . $_POST['firstname'] . $_POST['lastname'] . time() . "/" . $filename;
            if(!in_array($extension, $allowed_extensions)){
                $data += array("imageexterror" => "Not valid extension.");
            }else if($_FILES['image']['size'] > $allowed_size){
                $data += array("imagesizeerror" => "Not valid image size.");
            }else{

                @include_once("config.php");

                /* define("DB_HOST", "localhost");
                define("DB_USER", "root");
                define("DB_PASSWORD", "");
                define("DB_NAME", "chat-app");

                $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

                if(mysqli_connect_error()){
                    $data += array("dberror", "Something went wrong.");
                    exit();
                } */

                $fn = $_POST['firstname'];
                $ln = $_POST['lastname'];
                $email = $_POST['email'];
                $pwd = $_POST['password'];
                $st = "Offline";
                $img = $target_file;

                $sql = "INSERT INTO user (firstname, lastname, email, password, status, image)
                VALUES ('$fn', '$ln', '$email', '$pwd', '$st', '$img')";

                if(mysqli_query($connection, $sql)){
                    if(!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
                        $data += array("failedupload" => "Failed to upload file.");
                    }else{
                        $data += array("success" => "Successfully signed up."); 
                    }                   
                }else{
                    $data += array("failed" => "Something went wrong.");
                }

                mysqli_close($connection);

             }

        }

    }else{
        $data += array("error" => "All fields are required!");
    }

    echo json_encode($data);
    
?>