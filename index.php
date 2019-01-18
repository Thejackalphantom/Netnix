<?php
// Begin maken aan de sessie
session_start();

if (!isset($_SESSION['loggedin'])) {
    // not logged in
    header('Location: login.php');
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
        $mysqli = new mysqli('127.0.0.1', 'root', '', 'netnix') or die($mysqli->connect_error);
        $table = 'videos';

        $result = $mysqli->query("SELECT videoID, videoDescription, videoUploadPath FROM $table") or die($mysqli->error);
        ?>
        <div id="Wrap">
            <div id="content">
                <?php include ("includes/header.php"); ?>
                <div id="MainContent">
                    <div class="video">
                        <h2 class="title"> AANBEVOLEN </h2>
                        <hr>
                        <div class="videoBox">

                        </div>
                        <div class="videoBox">

                        </div>
                        <div class="videoBox">

                        </div>
                        <div class="videoBox">

                        </div>
                    </div>
                    <div class="video">
                        <h2 class="title"> VIDEOS </h2>   
                        <div class="videoBox">
                            <?php
                            while ($data = $result->fetch_assoc()) {
                                //print_r($data);
                                echo "<h2>{$data['videoDescription']}</h2>";
                                echo "<iframe width='395 height='400' src='{$data['videoUploadPath']}'></iframe>";
                            }
                            ?>
                        </div>   
                    </div>
                </div>
            </div>
    </body>
</html>
