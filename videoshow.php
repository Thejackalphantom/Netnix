<?php
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<!--
week 4 door Thijs Rijkers
-->


<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="css/account.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Netnix</title>
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
                        $DB = "netnix";
                        if (!mysqli_select_db($DBConnect, $DB)) {

                        } else {
                            $VideoID = $_GET["videoid"];

                            $string = "SELECT videoID, videoTitle, videoDescription, videoUploadPath FROM videos WHERE videoID =?";
                            $stmt = mysqli_prepare($DBConnect, $string);                         

                            if ($stmt) {

                                mysqli_stmt_bind_param($stmt, 's', $VideoID);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $VideoID, $Title, $Discription, $Path);
                                mysqli_stmt_store_result($stmt);
                                if (mysqli_stmt_num_rows($stmt) == 0) {
                                    echo 'There is no video found';
                                    header("location: index.php");
                                } else {
                                    while (mysqli_stmt_fetch($stmt)) {
                                      echo" <div id='iframeBox'>
                                            <div class='display'><iframe src='".$Path."'></iframe></div>
                                            <div class='display'><h3> Titel</h3>
                                            <p>".$Title."</p></div>
                                            <div class='display'></div>
                                            <div class='display'><h4> Beschrijving</h4>
                                            <p>".$Discription."</p></div>
                                            </div>";
                                    }
                                }
                                mysqli_stmt_close($stmt);
                            } 
                        }
                    }
                    mysqli_close($DBConnect);

            ?>
                    </div>
            </div>
        </div>
    </body>
</html>