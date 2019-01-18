<!DOCTYPE html>
<?php
session_start();
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
                        if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
                            header("location: login.php");
                            exit;
                        }
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
                                        else {
                                            echo "Er is iets misgegaan. Probeer het later opnieuw";
                                        }
                                    }
                                    else {
                                        echo "Er is iets misgegaan. Probeer het later opnieuw";
                                    }
                                    mysqli_stmt_bind_result($stmt, $StudentId, $UserName, $FirstName, $LastName, $Email);
                                    mysqli_stmt_store_result($stmt);
                                    
                                }
                                else {
                                    echo "Er is iets misgegeaan. Probeer het later opnieuw";
                                    die();
                                }
                                while(mysqli_stmt_fetch($stmt))
                                {
                                    echo "<h1> Your account </h1>";
                                    echo "<p>Name: " . $FirstName . " " . $LastName . "</p>";
                                    echo "<p>StudentId: " . $StudentId . "</p>";
                                    echo "<p>Email: " . $Email . "</p>";
                                    echo "<hr>";
                                }
                                mysqli_stmt_close($stmt);
                                echo "<hr><h1>Uw videos</h1></p>";
                                $QueryResult2 = "SELECT videoID, videoTitle, videoUploadPath FROM videos WHERE userID = ?";
                                if($stmt = mysqli_prepare($conn, $QueryResult2))
                                {
                                    if(mysqli_stmt_bind_param($stmt, 's', $userid))
                                    {
                                        if(mysqli_execute($stmt))
                                        {
                                            
                                        }
                                        else {
                                            echo "Er is iets misgegaan. Probeer het later opnieuw";
                                        }
                                    }
                                    else {
                                        echo "Er is iets misgegaan. Probeer het later opnieuw";
                                    }
                                }
                                else {
                                    echo "Er is iets misgegaan. Probeer het later opnieuw";
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
                                        <img src='". $videoPath ."'></img><a href='videoshow.php?videoid=" . $videoid ."'>Beschrijving</a>
                                    </div>";
                                }
                                mysqli_stmt_close($stmt);
                            }
                            else {
                                echo "U heeft nog geen videos geupload.";
                            }
                        }
                        else{
                            echo "Er is iets misgegeaan. Probeer het later opnieuw";
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

