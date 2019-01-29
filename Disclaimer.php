<?php
// Begin maken aan de sessie
session_start();
$Host = "127.0.0.1";
$User = "root";
$Password = "";
$DBName = "netnix";  

if (!isset($_SESSION['loggedin'])) {
    // not logged in
    header("Location: login.php?lang=$lang");
    exit();
}
?>
<!DOCTYPE html>
<!--
INF1C Informatica NHL STENDEN
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Netnix</title>
    </head>
    <body>
        <?php
        $Conn = mysqli_connect($Host, $User, $Password, $DBName)
        OR DIE ("Connection to the database has failed");

        $result = $Conn->query("SELECT videoID, videoTitle, videoDescription, videoUploadPath FROM videos WHERE aprove = 1") or die($Conn->error);
        $random = $Conn->query("SELECT videoID, videoTitle, videoDescription, videoUploadPath FROM videos WHERE aprove = 1 ORDER BY RAND() LIMIT 3") or die($Conn->error);
        ?>
        <div id="Wrap">
            <div id="content">
                <?php include ("includes/header.php"); ?>
                <p></p>
                <p></p>
                <?php include ("includes/footer.php"); ?>
            </div>
        </div>
    </body>
</html>