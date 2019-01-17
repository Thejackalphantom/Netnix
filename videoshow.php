<!DOCTYPE html>
<!--
week 4 door Thijs Rijkers
-->
<?php
$VideoID = '';
$Title = '';
$Discription = '';

if (isset($_GET["videoid"])) {
    if (intval($_GET["videoid"]) !== 0) {
        $DBConnect = mysqli_connect("localhost", "root", "");
        if ($DBConnect === FALSE) {
            echo "No connection with database";
        } else {
            $DB = "netnix";
            if (!mysqli_select_db($DBConnect, $DB)) {
                
            } else {
                $VideoID = $_GET["videoid"];

                $string = "SELECT VideoID, Title, Discription FROM video WHERE VideoID =?";
                $stmt = mysqli_prepare($DBConnect, $string);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 's', $VideoID);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $VideoID, $Title, $Discription);
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 0) {
                        echo"No bug reports found.";
                        die();
                    } else {
                        while (mysqli_stmt_fetch($stmt)) {
                            $videoid = $VideoID;
                            $title = $Title;
                            $discription = $Discription;
                        }
                    }
                } else {
                    echo "<p>Not enough information</p>";
                }
                mysqli_stmt_close($stmt);
            }
        }
    }
    mysqli_close($DBConnect);
} else {
    echo 'There is no video found';
    header("location: index.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Video</title>
    </head>
    <body>
        
    </body>
</html>