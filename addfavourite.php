<?php
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<!--
week 4 door Thijs Rijkers
-->
<?php
$VideoID = '';
$Title = '';
$Discription = '';
$Path = '';

if (isset($_GET["videoid"])) {
    if (intval($_GET["videoid"]) !== 0) {
        $DBConnect = mysqli_connect("localhost", "root", "");
        if ($DBConnect === FALSE) {
            echo "No connection with database";
        } else {
            $DB = "netnix";
            if (!mysqli_select_db($DBConnect, $DB)) {
                
            } else {
                //Favourite function starts here.
                if(isset($_POST['favourite']))
                {
                    $string = "INSERT INTO favourite(userId, videoID) VALUES(?, ?)";
                    $stmt = mysqli_prepare($DBConnect, $string);
                    
                    if ($stmt)
                    {
                        $userId = $_SESSION['id'];
                        $VideoID = $_GET['videoid'];
                        mysqli_stmt_bind_param($stmt, 'ss',$userId, $VideoID);
                        mysqli_stmt_execute($stmt);
                        echo"Added to favourites!";
                    }
                    else
                    {
                        echo "<p>Favourite failed to add</p>";
                    }
                }
                //End of favourite section.
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

