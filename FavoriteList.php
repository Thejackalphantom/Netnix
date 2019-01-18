<?php
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="css/favoritelist.css">
    </head>
    <body>
        <?php include ("includes/header.php");?>
        <div id="MainContent">
            <?php  
            $DBConnect = mysqli_connect("localhost", "root", "");
                    if ($DBConnect === FALSE) {
                        echo "No connection with database";
                    } else {
                        $DBName = "netnix";
            if (!mysqli_select_db($DBConnect, $DBName)) {
                echo "<p>Er is een probleempje aanwezig</p>";
            } else {
                $userid = $_SESSION["id"];
                $SQL = "SELECT videoID, videoTitle, videoUploadPath
                    FROM favorite JOIN videos 
                    WHERE userid=? AND favorite.userid = videos.userid 
                    ORDER BY msgid DESC;";
                                     

                if ($stmt = mysqli_prepare($DBConnect, $SQL)) {
                    mysqli_stmt_bind_param($stmt, 's',$userId);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $videoID, $videotitle, $path);
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 0) {
                        echo "<p>Er zijn geen tweets</p>";
                    }else{
                        while(mysqli_stmt_fetch($stmt)){
                        echo "<h2>$videotitle</h2>
                              <iframe src='". $path ."'></iframe><a href='videoshow.php?videoid=" . $videoid ."'>Beschrijving</a>";
                        }
                    }
                    mysqli_stmt_close($stmt);
                }    
            } 
                    }
            ?>
            
        </div>
    </body>
</html>
