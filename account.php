<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true)
{
    header("Location: login.php?lang=$lang");
    exit;
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
            <?php include ("includes/header.php");?>
            <div id="content">
                <div id="MainContent">
                    
                        <?php
                        $userid = $_SESSION['id'];
                        $conn = mysqli_connect("localhost", "root", "");
                        if ($conn)
                        {
                            $dbname = "netnix";
                            $DBConnect = mysqli_select_db($conn, $dbname);
                            if($DBConnect)
                            {
                                
                                $QueryResultadmin = "SELECT userID, admin FROM users WHERE userID = ? AND admin=1";
                                if($stmt = mysqli_prepare($conn, $QueryResultadmin))
                                {
                                    if(mysqli_stmt_bind_param($stmt, 's', $userid))
                                    {
                                        if (mysqli_stmt_execute($stmt))
                                        {
                                        }
                                        else {
                                            echo "Er is iets misgegaan. Probeer het later opnieuw";
                                        }
                                    }
                                    else {
                                        echo "Er is iets misgegaan. Probeer het later opnieuw";
                                    }
                                    mysqli_stmt_bind_result($stmt, $userID, $adminID);
                                    mysqli_stmt_store_result($stmt);
                                if(mysqli_stmt_num_rows($stmt) === 1){
                                    header("location: admin.php");
                                    }
                                }
                                $QueryResult = "SELECT studentNumber, userName, firstName, lastName, email FROM users WHERE userID = ?";
                                if($stmt = mysqli_prepare($conn, $QueryResult))
                                {
                                    if(mysqli_stmt_bind_param($stmt, 's', $userid))
                                    {
                                        if (mysqli_stmt_execute($stmt))
                                        {
                                        }
                                        else {
                                            echo $error;
                                        }
                                    }
                                    else {
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
                                    echo "<div id='account'>";
                                    echo "<h1>$account[0]</h1>";
                                    echo "<p>$account[1]: " . $FirstName . " " . $LastName . "</p>";
                                    echo "<p>$account[2]: " . $StudentId . "</p>";
                                    echo "<p>E-mail: " . $Email . "</p>";
                                    echo "<hr>";
                                }
                                mysqli_stmt_close($stmt);
                                echo "</div>";
                                $QueryResult2 = "SELECT videoID, videoTitle, videoUploadPath FROM videos WHERE userID = ? AND aprove = 1";
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
                                    echo "<a href=videoshow.php?videoid=" . $videoid ."><div class='videoBoxUser'>
                                        <h2>". $videotitle ."</h2>
                                        <video width='300' height='300'>
                                        <source src='".$videoPath."' type=video/mp4>
                                        <source src='".$videoPath."' type=video/wav>
                                        </video>
                                </div></a>";
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