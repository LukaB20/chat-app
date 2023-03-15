<?php
    session_start();

    if(!isset($_SESSION['user_id'])){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="wrapper-profile">
        <div class="profile">

            <header>
                <div>
                    <?php

                        @include_once('./php/config.php');

                        $user_id = $_SESSION['user_id'];

                        $strQueryImage = "SELECT * from user WHERE user_id = '$user_id'";
                        $res = mysqli_query($connection, $strQueryImage);

                        if($res !== null){
                            $userData = mysqli_fetch_assoc($res);
                        }

                        $userFirstName = $userData['firstname'];
                        $userLastName = $userData['lastname'];
                        $userImageUrl = substr($userData['image'], 1);

                        echo "<div class='profile-image' style='background-image: url(" . $userImageUrl . ");'></div>";
                        echo "<p class='user-name'>$userFirstName $userLastName</p>";
                    ?>
                </div>
                <form action="./php/logOut.php" method="post">
                    <input type="submit" value="Log out">
                </form>
            </header>
            
            <div class="friends">

            </div>

            <div class="toggleAddFriend">
                <p>Add new friend</p>
            </div>

        </div>

        <div class="chat">

            <!--Friend chat div-->

            

            <!--Add friend div-->

            <div id="addFriendDiv">
                <input type="text" name="newFriendName" id="newFriendName" placeholder="Enter friend name...">
                <div class="suggestions">
                        
                </div>
            </div>

        </div>
        
    </div>
    <script src="./ajax/profile_ajax.js"></script>
</body>
</html>