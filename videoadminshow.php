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
                                    header("location: index.php?lang=$lang");
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
                                    header("location: index.php?lang=$lang");
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
<<<<<<< HEAD
                                            <form action='videoadminshow.php?lang=$lang' method='POST'>
                                                <input type='checkbox' name='yes' value='$VideoID'> Yes
                                                <input type='submit' name='aprove' value='aprove'>
=======
                                            <form action='videoadminshow.php' method='POST'>
                                                <input type='radio' name='aprovey' id='yes' value='$VideoID'> Yes<br>
                                                <input type='radio' name='aproven' id='no' value='$VideoID'> No<br>
                                                <input type='submit' name='aproveyn' value='Aprove?' >
>>>>>>> bd917f8d179ccb68faad126366bf9143b1688dc8
                                            </form></div>
                                            <div class='display'><h4>$videoAdminShow[2]</h4>
                                            <p>" . $Discription . "</p></div>
                                            </div>";
                                    }
                                }
                                mysqli_stmt_close($stmt);
                            }
                            if (isset($_POST['aproveyn'])) {
                                if (isset($_POST['aprovey'])) {   
                                $string2 = "UPDATE videos SET aprove = 1 WHERE videoID =?";
                                $stmt = mysqli_prepare($conn, $string2);

                                if ($stmt) {
                                    $userId = $_SESSION['id'];
                                    mysqli_stmt_bind_param($stmt, 's',$_POST["aprovey"]);
                                    mysqli_stmt_execute($stmt);
                                    header("location: admin.php");
                                } else {
                                    echo $error;
                                }                                
                                mysqli_stmt_close($stmt);
                                }else if (isset($_POST['aproven'])) {{
                                    $string2 = "DELETE FROM videos WHERE videoID =?";
                                    $stmt = mysqli_prepare($conn, $string2);

                                if ($stmt) {
                                    mysqli_stmt_bind_param($stmt, 's', $_POST["aproven"]);
                                    mysqli_stmt_execute($stmt);
                                    header("location: admin.php?lang=$lang");
                                } else {
                                    echo $error;
                                }
                                mysqli_stmt_close($stmt);
                                }
                                }
                            } 
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>