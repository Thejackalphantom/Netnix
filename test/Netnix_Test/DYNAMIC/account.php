<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['lang']))
{
    $_SESSION['lang'] = "nl";
}

?>
<!--
Account Pagina
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
            <div id="content">
                <?php include ("includes/header.php");?>
                <div id="MainContent">
                    <div id="account">
                        <?php
                        $userid = $_SESSION['id'];
                        $conn = mysqli_connect("localhost", "root", "");
                        if ($conn)
                        {
                            $dbname = "netnix";
                            $DBConnect = mysqli_select_db($conn, $dbname);
                            if($DBConnect)
                            {
                                $QueryResult = "SELECT studentNumber, userName, firstName, lastName, email FROM users WHERE userID = ?";
                                if($stmt = mysqli_prepare($conn, $QueryResult))
                                {
                                    if(mysqli_stmt_bind_param($stmt, 's', $userid))
                                    {
                                        if (mysqli_stmt_execute($stmt))
                                        {
                                        }
                                        else
                                        {
                                            echo $error;
                                        }
                                    }
                                    else
                                    {
                                        echo $error;
                                    }
                                    mysqli_stmt_bind_result($stmt, $StudentId, $UserName, $FirstName, $LastName, $Email);
                                    mysqli_stmt_store_result($stmt);
                                    
                                }
                                else {
                                    echo $error;
                                    die();
                                }
                                while(mysqli_stmt_fetch($stmt))
                                {
                                    echo "<h1>$account[0]</h1>";
                                    echo "<p>$account[1]: " . $FirstName . " " . $LastName . "</p>";
                                    echo "<p>$account[2]: " . $StudentId . "</p>";
                                    echo "<p>E-mail: " . $Email . "</p>";
                                    echo "<hr>";
                                }
                                mysqli_stmt_close($stmt);
                                echo "<hr><h1>$account[3]</h1></p>";
                                $QueryResult2 = "SELECT videoID, videoTitle, videoUploadPath FROM videos WHERE userID = ?";
                                if($stmt = mysqli_prepare($conn, $QueryResult2))
                                {
                                    if(mysqli_stmt_bind_param($stmt, 's', $userid))
                                    {
                                        if(mysqli_execute($stmt))
                                        {
                                            
                                        }
                                        else {
                                            echo $error;
                                        }
                                    }
                                    else {
                                        echo $error;
                                    }
                                }
                                else {
                                    echo $error;
                                }
                                mysqli_stmt_bind_result($stmt, $videoid, $videotitle, $videoPath);
                                mysqli_stmt_store_result($stmt);
                            }
                            
                            if(mysqli_stmt_num_rows($stmt) != 0)
                            {
                                
                                        while(mysqli_stmt_fetch($stmt))
                                {
                                    echo "<div class='videoBoxUser'>
                                        <h2>$videotitle</h2>
                                        <iframe src='". $videoPath ."'></iframe><a href='videoshow.php?videoid=" . $videoid ."'>$account[4]</a>
                                    </div>";
                                }
                                mysqli_stmt_close($stmt);
                            }
                            else {
                                echo $account[5];
                            }
                        }
                        else{
                            echo $error;
                            die();
                        }
                        mysqli_close($conn);

                        ?>
                    </div>   
                </div>
            </div>
        </div>
    </body>
</html>

