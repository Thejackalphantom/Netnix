<?php
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header("location: login.php");
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
                    <h2> V  Upload your video here  V </h2>
                </div>
                <div id="uploadFunction">
                    <div id="function">
                        <form id="formSignUp" action="upload.php" method="POST" enctype="multipart/form-data" >
                            <p>Please upload your video</p>
                            <p>Title</p>
                            <p><input type="text" name="title"</p>
                            <p>Description</p>
                            <textarea rows="10" cols="50" maxlength="480" minlenght="0" name="message"></textarea>
                            <p><input type="file" name="fileToUpload" id="fileToUpload"></p>
                            <select name="categorie">
                                <option value="wiskunde"> wiskunde</option>
                                <option value="php"> php</option>
                                <option value="informatiemanagement"> informatiemanagement</option>
                                <option value="html"> html</option>
                                <option value="c#"> c</option>
                                <option value="java"> java</option>
                                <option value="database"> database</option>
                                <option value="economie"> economie</option>
                                <option value="nederlands"> nederlands</option>  
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

                $mimetype = array("image/mp4","image/wav");
                if(in_array($_FILES['fileToUpload']['type'],$mimetype)){
                    echo"This is not the correct file type please upload in .WAV/.MP4";
                }else{
                    
                    $uploadOk = 0;
                    if ($uploadOk == 0)
                        { // if everything is ok, try to upload file
                            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
                        }

                $name = htmlentities($_FILES['fileToUpload']['name']);
                $categorie = htmlentities($_POST['categorie']);
                $title = htmlentities($_POST['title']);
                $message = htmlentities($_POST['message']);
                $pathtotal = "uploads/" . $name . "";
                $userid = $_SESSION['id'];
                
                        mysqli_select_db($Conn, $DBName);
                        $SQLstring2 = "INSERT INTO videos VALUES(NULL, ?, ?, ?, ?, ?)";
                        if ($stmt = mysqli_prepare($Conn, $SQLstring2)) {
                            mysqli_stmt_bind_param($stmt, 'sssss', $userid, $title, $message,$pathtotal, $categorie);
                            $QueryResult2 = mysqli_stmt_execute($stmt);
                            if ($QueryResult2 === FALSE) {
                                echo "<p>Unable to execute the query.</p>"
                                . "<p>Error code "
                                . mysqli_errno($Conn)
                                . ": "
                                . mysqli_error($Conn)
                                . "</p>";
                            } else {
                                echo "Bedankt voor het uploaden van een video.";
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