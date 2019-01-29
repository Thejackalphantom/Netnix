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
        <h1>Search page</h1>

        <div class="video">
            <?php
            if (isset($_POST['submit-search'])) {
                $search = mysqli_real_escape_string($Conn, $_POST['search']);
                $sql = "SELECT * FROM videos WHERE videoTitle LIKE '%$search%'";
                $result = mysqli_query($Conn, $sql);
                $QueryResult = mysqli_num_rows($result);
                
                echo "There are ".$QueryResult." results!";

                if ($QueryResult > 0) {
                    while ($data = mysqli_fetch_assoc($result)) {
                        echo "<a href=videoshow.php?videoid={$data['videoID']}><div class='videoBoxUser'>
                                    <h2>{$data['videoTitle']}</h2>
                                        <video width='300' height='300'>
                                        <source src='{$data['videoUploadPath']}' type=video/mp4>
                                        <source src='{$data['videoUploadPath']}' type=video/wav>
                                        </video>
                                </div></a>";
                    }
                } else {
                    echo "There are no results matching your search!";
                }
            }
            ?>
        </div>

    </body>
</html>