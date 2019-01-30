<?php
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header("Location: login.php?lang=$lang");
    exit;
}
?>
<!DOCTYPE html>
<!--
admin page
-->


<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="css/favoritelist.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Netnix</title>
    </head>
    <body>
        <div id="Wrap">
            <?php include ("includes/header.php");?>
            <div id="content">
                <div id="MainContent">
                    <?php
                    $userid = $_SESSION['id'];
                        $conn = mysqli_connect("localhost", "root", "");
                        if ($conn)
                        {
                            $dbname = "netnix";
                            $DBConnect = mysqli_select_db($conn, $dbname);
                            if($DBConnect)
                            {
                                $QueryResult = "SELECT userID, admin FROM users WHERE userID = ? AND admin=1";
                                if($stmt = mysqli_prepare($conn, $QueryResult))
                                {
                                    if(mysqli_stmt_bind_param($stmt, 's', $userid))
                                    {
                                        if (mysqli_stmt_execute($stmt))
                                        {
                                        }
                                        else {
                                            echo $error;
                                        }
                                    }
                                    else {
                                        echo $error;
                                    }
                                    mysqli_stmt_bind_result($stmt, $userID, $adminID);
                                    mysqli_stmt_store_result($stmt);
                                if(mysqli_stmt_num_rows($stmt) != 0){
                                    echo $admin[0];
                                    echo "<hr>";
                                    }else{
                                        header("location: index.php?lang=$lang");
                                    }
                                }
                                
                                mysqli_stmt_close($stmt);
                                $QueryResult2 = "SELECT videoID, videoTitle, videoUploadPath FROM videos WHERE aprove=0";
                                if($stmt = mysqli_prepare($conn, $QueryResult2))
                                {
                                        if(mysqli_execute($stmt))
                                        {
                                            
                                        }
                                        else {
                                            echo $error;
                                        }
                                }
                                else {
                                    echo $error;
                                }
                                mysqli_stmt_bind_result($stmt, $videoid, $videotitle, $videoPath);
                                mysqli_stmt_store_result($stmt);
                            }
                            
                            if(mysqli_stmt_num_rows($stmt) != 0)
                            {
                                
                                        while(mysqli_stmt_fetch($stmt))
                                {
                                    echo "<a href=videoadminshow.php?videoid=$videoid&lang=$lang>
                                        <div class='videoBoxUser'>
                                        <video width='500' height='300'>
                                        <source src='".$videoPath."' type=video/mp4>
                                        <source src='".$videoPath."' type=video/wav>
                                        </video>
                                        <div class='loadbar'></div>
                                        <div class='videoTitle'><h2>". $videotitle ."</h2></div>
                                </div>
                            </a>";
                                }
                                mysqli_stmt_close($stmt);
                            }
                            else {
                                echo $admin[1];
                            }
                        }
                        else{
                            echo $error;
                        }
                        mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>