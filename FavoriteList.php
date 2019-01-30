<?php
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header("Location: login.php?lang=$lang");
    exit;
}
?>
<!DOCTYPE html>
<!--
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Netnix</title>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="css/favoritelist.css">
    </head>
    <body>
        <div id="Wrap">
            <div id="content">
                <?php include ("includes/header.php");?>
            <div id="MainContent">
                <?php  
                    $DBConnect = mysqli_connect("localhost", "root", "");
                            if ($DBConnect === FALSE) {
                                echo "No connection with database";
                            } else {
                                $DBName = "netnix";
                            }
                    if (!mysqli_select_db($DBConnect, $DBName)) {
                        echo "<p>$error</p>";
                        
                    } else {
                        $idOfUser = $_SESSION["id"];
                        $SQLfav = " SELECT v.videoID, v.videoTitle, v.videoUploadPath
                                    FROM videos AS v
                                    WHERE v.videoID IN (SELECT f.videoID
                                    FROM favorite AS f
                                    WHERE userID=?);";
                        
                        if ($stmt = mysqli_prepare($DBConnect, $SQLfav)) {   
                        mysqli_stmt_bind_param($stmt, 's', $idOfUser);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $videoID, $videotitle, $path);
                        mysqli_stmt_store_result($stmt);
                        if (mysqli_stmt_num_rows($stmt) == 0) {
                            echo "<p>$favoriteList[0]</p>";
                        }else{
                            while(mysqli_stmt_fetch($stmt)){
                            echo "<a href=videoshow.php?videoid=$videoID&lang=$lang>
                                        <div class='videoBoxUser'>
                                        <video width='500' height='300'>
                                        <source src='".$path."' type=video/mp4>
                                        <source src='".$path."' type=video/wav>
                                        </video>
                                        <div class='loadbar'></div>
                                        <div class='videoTitle'><h2>". $videotitle ."</h2></div>
                                </div>
                            </a>";
                            }
                        }
                        mysqli_stmt_close($stmt);
                    }    
                }
                
                ?>
                </div>
            </div>
            <?php include ("includes/footer.php");?>
        </div>
    </body>
</html>
