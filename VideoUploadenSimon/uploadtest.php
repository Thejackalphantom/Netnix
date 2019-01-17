<?php
session_start();
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            header("location: index.php");
            exit;
        }
$Host = "127.0.0.1";
$User = "root";
$Password = "";
$DBName = "netnix";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Netnix</title>
        <link rel="stylesheet" type="text/css" href="css/index.css"
    </head>
    <body>
        <?php
        
        $Conn = mysqli_connect($Host, $User, $Password, $DBName);
        if ($Conn === FALSE) {

            echo "Failed to connected";
        } else {
            if (!mysqli_select_db($Conn, $DBName)) {

                $SQLstring = "CREATE DATABASE netnix";
                if ($stmt = mysqli_prepare($Conn, $SQLstring)) {
                    $QueryResult = mysqli_stmt_execute($stmt);
                    if ($QueryResult === FALSE) {
                        echo "<p>Well thats a error!</p>";
                    } else {
                        echo "<p>You are the first visitor!</p>";
                    }
                    mysqli_stmt_close($stmt);
                }
            }

            if (isset($_POST['submit'])) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;

                $mimetype = array("video/mp4");
                if (in_array($_FILES['fileToUpload']['type'], $mimetype)) {
                    echo"This is not the correct file type please upload in mp4";
                } else {

                    $uploadOk = 0;
                    if ($uploadOk == 0) { // if everything is ok, try to upload file
                        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
                    }
                }

                    $name = htmlentities($_FILES['fileToUpload']['name']);
                    $pathtotal = "uploads/" . $name . "";
                    mysqli_select_db($Conn, $DBName);
                    $SQLstring2 = "INSERT INTO videos (videoUploadPath) VALUES (?)";
                    if ($stmt = mysqli_prepare($Conn, $SQLstring2)) {
                        mysqli_stmt_bind_param($stmt, 's', $pathtotal);
                        $QueryResult2 = mysqli_stmt_execute($stmt);
                        if ($QueryResult2 === FALSE) {
                            echo "<p>Unable to execute the query.</p>"
                            . "<p>Error code "
                            . mysqli_errno($Conn)
                            . ": "
                            . mysqli_error($Conn)
                            . "</p>";
                        } else {
                            echo "Upload succesful!";
                            //header("Location: login.php");
                        }
                        mysqli_stmt_close($stmt);
                    }
                    mysqli_close($Conn);
                }
            }
        ?>
        <div id="wrap">
            <div id="mainContainer">
                <div id="header">

                </div>
                <div id="menu">
                    <div class="button"><a href="index.php">Home</a></div>
                </div>
                <div id="content">
                    <div id="register">
                        <form id="formSignUp" action="uploadtest.php" method="POST" enctype="multipart/form-data" >
                            <p>Please upload your video</p>
                            <p><input type="file" name="fileToUpload" id="fileToUpload" required></p>
                            <p><input type="submit" name="submit" value="add Video"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>