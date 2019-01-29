<?php
// Begin maken aan de sessie
session_start();
$Host = "127.0.0.1";
$User = "root";
$Password = "";
$DBName = "netnix";

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
        <title>Search</title>
    </head>
    <body>
        <?php
        $Conn = mysqli_connect($Host, $User, $Password, $DBName)
                OR DIE("Connection to the database has failed");
        ?>
        <?php include ("includes/header.php"); ?>
        
        <div class="video">
            <h1>Results</h1>
            <hr>
            <?php
            if (isset($_POST['submit-search'])) {
                $search = mysqli_real_escape_string($Conn, $_POST['search']);
                $sql = "SELECT * FROM videos WHERE videoTitle LIKE '%$search%' AND aprove = 1";
                $result = mysqli_query($Conn, $sql);
                $QueryResult = mysqli_num_rows($result);
                

                if ($QueryResult > 0) {
                    while ($data = mysqli_fetch_assoc($result)) {
                       echo ""
                                    . "<a href=videoshow.php?videoid={$data['videoID']}>
                                          <div class='videoBoxUser'>
                                                  <video width='500'>
                                                  <source src='{$data['videoUploadPath']}' type=video/mp4>
                                                  <source src='{$data['videoUploadPath']}' type=video/wav>
                                                  </video>
                                                  <div class='loadbar'></div>
                                                  <div class='videoTitle'><h2>{$data['videoTitle']}</h2></div>
                                          </div>
                                      </a>";
                    }
                } else {
                    echo "There are no results matching your search!";
                }
            }
            ?>
        </div>

    </body>
</html>