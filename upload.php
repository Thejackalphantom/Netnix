<?php
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<!--
Upload page
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Netnix-Upload</title>
        <link rel="stylesheet" type="text/css" href="css/index.css">  
        <link rel="stylesheet" type="text/css" href="css/upload.css"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div id="Wrap">
            <?php include ("includes/header.php"); ?>
            <div id="space">
            </div>
            <div id="upload">
                <div id="uploadTitle">
                    <h2><?php echo $upload[0]; ?></h2>
                </div>
                <div id="uploadFunction">
                    <div id="function">
                        <form id="formSignUp" action="upload.php" method="POST" enctype="multipart/form-data" >
                            <p><?php echo $upload[1]; ?></p>
                            <p><?php echo $upload[2]; ?></p>
                            <p><input type="text" name="title"></p>
                            <p><?php echo $upload[3]; ?></p>
                            <textarea rows="10" cols="50" maxlength="480" name="message"></textarea>
                            <p><input type="file" name="fileToUpload" id="fileToUpload"></p>
                            <select name="categorie">
                                <option value="wiskunde"><?php echo $upload[4]; ?></option>
                                <option value="php"><?php echo $upload[5]; ?></option>
                                <option value="informatiemanagement"><?php echo $upload[6]; ?></option>
                                <option value="html"><?php echo $upload[7]; ?></option>
                                <option value="c#"><?php echo $upload[8]; ?></option>
                                <option value="java"><?php echo $upload[9]; ?></option>
                                <option value="database"><?php echo $upload[10]; ?></option>
                                <option value="economie"><?php echo $upload[11]; ?></option>
                                <option value="nederlands"><?php echo $upload[12]; ?></option>
                            </select>
                            <p><input type="submit" name="submit" value="add Video"><input type="reset" name="reset" value="Reset form"></p>
                        </form>  

                        <?php
                        $Conn = mysqli_connect("localhost", "root", "");
                        if ($Conn === FALSE) {

                            echo "Failed to connected";
                        } else {
                            $DBName = "netnix";
                            if (!mysqli_select_db($Conn, $DBName)) {

                                $SQLstring = "CREATE DATABASE netnix";
                                if ($stmt = mysqli_prepare($Conn, $SQLstring)) {
                                    $QueryResult = mysqli_stmt_execute($stmt);
                                    if ($QueryResult === FALSE) {
                                        echo "$error";
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

                                $mimetype = array("video/mp4", "video/MP4", "video/mov", "video/wmv", "video/flv");
                                if (!in_array($_FILES['fileToUpload']['type'], $mimetype)) {
                                    echo"<br><h3>$upload[13]</h3>";
                                } else {

                                    $uploadOk = 0;
                                    if ($uploadOk == 0) { // if everything is ok, try to upload file
                                        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
                                    }

                                    $name = htmlentities($_FILES['fileToUpload']['name']);
                                    $categorie = htmlentities($_POST['categorie']);
                                    $title = htmlentities($_POST['title']);
                                    $message = htmlentities($_POST['message']);
                                    $pathtotal = "uploads/" . $name . "";
                                    $userid = $_SESSION['id'];

                                    mysqli_select_db($Conn, $DBName);
                                    $SQLstring2 = "INSERT INTO videos VALUES(NULL, ?, ?, ?, ?, ?, 0)";
                                    if ($stmt = mysqli_prepare($Conn, $SQLstring2)) {
                                        mysqli_stmt_bind_param($stmt, 'sssss', $userid, $title, $message, $pathtotal, $categorie);
                                        $QueryResult2 = mysqli_stmt_execute($stmt);
                                        if ($QueryResult2 === FALSE) {
                                            echo "<p>Unable to execute the query.</p>"
                                            . "<p>Error code "
                                            . mysqli_errno($Conn)
                                            . ": "
                                            . mysqli_error($Conn)
                                            . "</p>";
                                        } else {
                                            echo "<br><h3>$upload[14]</h3>";
                                            //header("Location: login.php");
                                        }
                                        mysqli_stmt_close($stmt);
                                    }
                                    mysqli_close($Conn);
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>