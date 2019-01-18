<?php
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header("location: login.php");
    exit;
}
?>  

<!DOCTYPE html>
<!--
categorie page
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>TEST</title>
        <link rel="stylesheet" type="text/css" href="css/index.css">  
        <link rel="stylesheet" type="text/css" href="css/categorie.css"> 
    </head>
    <body>
       <?php include ("includes/header.php");
       $DBConnect = mysqli_connect("localhost", "root", "");
        if ($DBConnect === FALSE)
        {
            echo "No connection with database";
        }
        else
        {
            $DB = "netnix";
            if (!mysqli_select_db($DBConnect, $DB))
            {
                
            }
            else 
            {
                $video = $_POST['video'];
                $SQLstring = "SELECT videoID from videos where videoTitle LIKE ?";
                $stmt = mysqli_prepare($DBConnect, $string);
                if($stmt)
                {
                    mysqli_stmt_bind_param($stmt,'s', $video);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $videoResult);
                    while(mysqli_stmt_fetch($stmt))
                    {
                        echo $videoResult;
                    }
                }
            }
        }
       ?>
        <form method="POST" name="searchbar" action="Searchbartest.php">
            <input type="text" name="video" placeholder="Search on tags!">
        </form>
    </body>
</html>
