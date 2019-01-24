<?php
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header("location: login.php");
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
                        echo "<p>Er is een probleempje aanwezig</p>";
                        
                    } else {
                        $idOfUser = $_SESSION["id"];
                        $SQL = "SELECT userID, videoID, videoTitle, videoUploadPath
                                FROM videos
                                JOIN favorite 
                                ON videos.userID = favorite.userID 
                                WHERE userID=?";
                        
                        if ($stmt = mysqli_prepare($DBConnect, $SQL)) {
                        mysqli_stmt_bind_param($stmt, 's',$idOfUser);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $userID, $videoID, $videotitle, $path);
                        mysqli_stmt_store_result($stmt);
                        if (mysqli_stmt_num_rows($stmt) == 0) {
                            echo "<p>Je hebt nog geen favoriten.</p>";
                        }else{
                            while(mysqli_stmt_fetch($stmt)){
                            echo "<h2>$videotitle</h2>
                                  <iframe src='". $path ."'></iframe><a href='videoshow.php?videoid=" . $videoid ."'>Beschrijving</a>";
                            }
                        }
                        mysqli_stmt_close($stmt);
                    }    
                }
                
                ?>
                </div>
            </div>
        </div>
    </body>
</html>
