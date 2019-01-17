<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Video Upload</title>
    </head>
    <body>
        <?php
        $_SESSION['message'] = '';
        
        $DBName = "netnix";
        $Conn = mysqli_connect('127.0.0.1', 'root', '');
        if ($Conn === FALSE) {
            echo "<p>Failed to connect to database!</p>";
        }else {
            if (!mysqli_select_db($Conn, $DBName)) {

                $SQLstring = "CREATE DATABASE netnix";
                if ($stmt = mysqli_prepare($Conn, $SQLstring)) {
                    $QueryResult = mysqli_stmt_execute($stmt);
                    if ($QueryResult === FALSE) {
                        echo "<p>Well thats an error!</p>";
                    } else {
                        echo "<p>You are the first visitor!</p>";
                    }
                    mysqli_stmt_close($stmt);
                }
            }
        }
        
        if (isset($_FILES["video"])) {
            //pre_r($_FILES);

            $phpVideoUploadErrors = array(
                0 => "There is no error, the file uplouded with success",
                1 => "The uploaded file exceeds the uploud_max_filesize directive in php.ini",
                2 => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
                3 => "The uploaded file was only partially uplouded",
                4 => "No file was uploaded",
                6 => "Missing a temporary folder",
                7 => "Failed to write file to disk",
                8 => "A PHP extension stopped the file upload"
            );

            $ext_error = FALSE;
            //extensions die geupload mogen worden
            $extensions = array('mp4', 'mov', 'wmv', 'png');
            $file_ext = explode('.', $_FILES['video']['name']);
            $file_ext = end($file_ext);
            //pre_r($file_ext);

            if (!in_array($file_ext, $extensions)) {
                $ext_error = TRUE;
            }

            //als de error niet 0 is
            if ($_FILES['video']['error']) {
                echo $phpVideoUploadErrors[$_FILES['video']['error']];
            } elseif ($ext_error) {
                echo "invalid file extension!";
            } else {
                echo "Succes!";
                        move_uploaded_file($_FILES["video"]['tmp_name'], 'uploads/' .
                        $_FILES["video"]['name']);
            }
                $name = htmlentities($_FILES['video']['name']);
                $pathtotal = "uploads/" . $name . "";
                
                    mysqli_select_db($Conn, $DBName);
                    $SQLstring2 = "INSERT INTO videos videoUploadPath VALUES (NULL, ?)";
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
                            header("Location: /../index.php");
                        }
                        mysqli_stmt_close($stmt);
                    }
                    mysqli_close($Conn);
                }
        
        function pre_r($array) {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table cellspacing="10px" border="0px">
                <tr>
                    <td>Select the video</td>
                    <td><input type="file" name="video"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="submit"></td>
                </tr>
            </table>
        </form>
    </body>
</html>