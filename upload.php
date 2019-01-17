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
                        <form action="" method='post' enctype="multipart/form-data">
                            Description of Video: <input type="text" name="description_entered"/><br><br>
                            <input type="file" name="file"/><br><br>
                            <input type="submit" name="submit" value="Upload"/>
                        </form>  

                        <?php
                        $descript = 0;
                        $description = $_POST['description_entered'];
                        if (empty($description)) {

                            $descript = 1;
                        }
                        $name = $_FILES['file']['name'];
                        $success = -1;
                        if (isset($name)) {

                            $path = 'Uploads/videos/';
                            $tmp_name = $_FILES['file']['tmp_name'];
                            $submitbutton = $_POST['submit'];
                            $position = strpos($name, ".");
                            $fileextension = substr($name, $position + 1);
                            $fileextension = strtolower($fileextension);

                            if (!empty($name)) {
                                if (($fileextension !== "mp4") && ($fileextension !== "ogg") && ($fileextension !== "webm")) {
                                    $success = 0;
                                    echo "The file extension must be .mp4, .ogg, or .webm in order to be uploaded";
                                } else if (($fileextension == "mp4") || ($fileextension == "ogg") || ($fileextension == "webm")) {
                                    $success = 1;
                                    if (move_uploaded_file($tmp_name, $path . $name)) {
                                        echo 'Uploaded!';
                                    }
                                }
                            }
                        }
                        ?>

                        <?php
                        $user = "root";
                        $host = "localhost";
                        $dbase = "upload";
                        $table = "video";

                        $connection = mysqli_connect($host, $user, "");
                        if (!$connection) {
                            die('Could not connect:' . mysql_error());
                        } mysqli_select_db($connection, $dbase);

                        $SQLstring2 = "INSERT INTO " . $table . " VALUES(?, ?, ?)";

                        if ($stmt = mysqli_prepare($connection, $SQLstring2)) {

                            mysqli_stmt_bind_param($stmt, 'sss', $description, $name, $fileextension);
                            $QueryResult2 = mysqli_stmt_execute($stmt);
                            if ($QueryResult2 === FALSE) {
                                echo "<p>Unable to execute the query.</p>";
                            } else {
                                
                            }
                            //Clean up the $stmt after use
                            mysqli_stmt_close($stmt);
                        } else {
                            echo mysqli_error($connection);
                        }
                        mysqli_close($connection);
                        ?> 
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>