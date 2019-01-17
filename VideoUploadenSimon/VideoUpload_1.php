<!DOCTYPE HTML>

<html>
    <head>
        <meta charset="UTF-8">
        <title>SignUp</title>
    </head>
    <body>
        <?php
        session_start();
        $_SESSION['message'] = '';
        $mysqli = new mysqli('127.0.0.1', 'root', '', 'netnix');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $video_path = $mysqli->real_escape_string('videos/' . $_FILES['video']['name']);

            if (copy($_FILES['video']['tmp_name'], $video_path)) {

                $_SESSION['video'] = $video_path;

                $sql = "INSERT INTO videos (videoUploadPath)"
                        . "VALUES ('$video_path')";

                if ($mysqli->query($sql) === TRUE) {
                    $_SESSION['message'] = 'Upload succeful!';
                } else {
                    $_SESSION['message'] = "Upload failed!";
                }
            } else {
                $_SESSION['message'] = "Uploading file failed!";
            }
        } else {
            $_SESSION['message'] = "You can only upload video files!";
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
            <table cellspacing="10px" border="0px">
                <tr>
                    <td>Select video</td>
                    <td><input type="file" name="video"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="submit"></td>
                </tr>
            </table>
        </form>
    </body>
</html>