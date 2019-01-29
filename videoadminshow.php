<?php
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<!--
admin aprove page
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
            <?php include ("includes/header.php"); ?>
            <div id="content">
                <div id="MainContent">
                    <?php
                    $userid = $_SESSION['id'];
                    $conn = mysqli_connect("localhost", "root", "");
                    if ($conn) {
                        $dbname = "netnix";
                        $DBConnect = mysqli_select_db($conn, $dbname);
                        if ($DBConnect) {
                            $QueryResult = "SELECT userID, admin FROM users WHERE userID = ? AND admin=1";
                            if ($stmt = mysqli_prepare($conn, $QueryResult)) {
                                if (mysqli_stmt_bind_param($stmt, 's', $userid)) {
                                    if (mysqli_stmt_execute($stmt)) {
                                        
                                    } else {
                                        echo $error;
                                    }
                                } else {
                                    echo $error;
                                }
                                mysqli_stmt_bind_result($stmt, $userID, $adminID);
                                mysqli_stmt_store_result($stmt);
                                if (mysqli_stmt_num_rows($stmt) != 0) {
                                    echo"$videoAdminShow[0]";
                                    echo "<hr>";
                                } else {
                                    header("location: index.php");
                                }
                            }
                            mysqli_stmt_close($stmt);

                            $VideoID = $_GET["videoid"];

                            $string = "SELECT videoID, videoTitle, videoDescription, videoUploadPath FROM videos WHERE videoID =?";
                            $stmt = mysqli_prepare($conn, $string);

                            if ($stmt) {

                                mysqli_stmt_bind_param($stmt, 's', $VideoID);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $VideoID, $Title, $Discription, $Path);
                                mysqli_stmt_store_result($stmt);
                                if (mysqli_stmt_num_rows($stmt) == 0) {
                                    echo $videoAdminShow[1];
                                    header("location: index.php");
                                } else {
                                    while (mysqli_stmt_fetch($stmt)) {
                                        echo" <div id='iframeBox'>
                                            <div class='display'><video controls>
                                        <source src='" . $Path . "' type=video/mp4>
                                        <source src='" . $Path . "' type=video/wav>
                                        </video></div>
                                            <div class='display'><h3> Titel</h3>
                                            <p>" . $Title . "</p></div>
                                            <div class='display'>
                                            <h3>Aprove?</h3>
                                            <form action='videoadminshow.php' method='POST'>
                                                <input type='checkbox' name='yes' value='$VideoID'> Yes
                                                <input type='submit' name='aprove' value='aprove'>
                                            </form></div>
                                            <div class='display'><h4>$videoAdminShow[2]</h4>
                                            <p>" . $Discription . "</p></div>
                                            </div>";
                                    }
                                }
                                mysqli_stmt_close($stmt);
                            }
                            if (isset($_POST['aprove'])) {
                                $string2 = "UPDATE videos SET aprove = 1 WHERE videoID =?";
                                $stmt = mysqli_prepare($conn, $string2);

                                if ($stmt) {
                                    $userId = $_SESSION['id'];
                                    mysqli_stmt_bind_param($stmt, 's', $_POST['yes']);
                                    mysqli_stmt_execute($stmt);
                                    header("location: admin.php");
                                } else {
<<<<<<< HEAD
                                    echo $error;
                                }
                                mysqli_stmt_close($stmt);
=======
                                    echo "$error";
                                }
                                mysqli_stmt_close($stmt);
                                
                                $string3 = "INSERT INTO likes (videoID) VALUES (?)";
                                $stmt = mysqli_prepare($conn, $string3);

                                if ($stmt) {
                                    $userId = $_SESSION['id'];
                                    mysqli_stmt_bind_param($stmt, 's', $_POST['yes']);
                                    mysqli_stmt_execute($stmt);
                                    header("location: admin.php");
                                } else {
                                    echo "$error";
>>>>>>> 5499b05f910f5d63c03d41355fd784edd53abfdf
                                }
                            }
                        }
                    ?>
                </div>
            </div>
    </body>
</html>