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
                    $DBConnect = mysqli_connect("localhost", "root", "");
                    if ($DBConnect === FALSE) {
                        echo "No connection with database";
                    } else {
                        $DB = "netnix";
                        if (!mysqli_select_db($DBConnect, $DB)) {

                        } else {
                            $VideoID = htmlentities($_GET["videoid"]);
                            // Aantal likes worden geteld..
                            $query = "SELECT userID FROM likedvideos WHERE videoID = ? AND liked = 'y'";
                            if($stmt = mysqli_prepare($DBConnect, $query))
                            {
                                if(mysqli_stmt_bind_param($stmt, 'i', $VideoID))
                                {
                                    if(mysqli_stmt_execute($stmt))
                                    {

                                    }else {
                                        echo "er is iets misgegaan. Probeer het later opnieuw";
                                    }
                                }else {
                                    echo "er is iets misgegaan. Probeer het later opnieuw";
                                }
                            }
                            else {
                                echo "er is iets misgegaan. Probeer het later opnieuw" . mysqli_error($DBConnect);
                            }
                            mysqli_stmt_bind_result($stmt, $likedusers);
                            mysqli_stmt_store_result($stmt);
                            $likes = mysqli_stmt_num_rows($stmt);
                            //Aantal dislikes worden geteld..
                            $query = "SELECT userID FROM likedvideos WHERE videoID = ? AND disliked = 'y'";
                            if($stmt = mysqli_prepare($DBConnect, $query))
                            {
                                if(mysqli_stmt_bind_param($stmt, 'i', $VideoID))
                                {
                                    if(mysqli_stmt_execute($stmt))
                                    {

                                    }else {
                                        echo "er is iets misgegaan. Probeer het later opnieuw";
                                    }
                                }else {
                                    echo "er is iets misgegaan. Probeer het later opnieuw";
                                }
                            }
                            mysqli_stmt_bind_result($stmt, $nt);
                            mysqli_stmt_store_result($stmt);
                            $dislikes = mysqli_stmt_num_rows($stmt);
                            //select videos
                            $string = "SELECT videoID, videoTitle, videoDescription, videoUploadPath FROM videos WHERE videoID =?";
                            $stmt = mysqli_prepare($DBConnect, $string);                         
                            if ($stmt) {

                                mysqli_stmt_bind_param($stmt, 's', $VideoID);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $VideoID, $Title, $Discription, $Path);
                                mysqli_stmt_store_result($stmt);
                                if (mysqli_stmt_num_rows($stmt) == 0) {
                                    echo 'There is no video found';
                                    header("location: index.php");
                                } else {
                                    while (mysqli_stmt_fetch($stmt)) {
                                      echo" <div id='iframeBox'>
                                            <div class='display'><video controls>
                                        <source src='".$Path."' type=video/mp4>
                                        <source src='".$Path."' type=video/wav>
                                        </video></div>
                                            <div class='display'><h3>$videoshow[0]</h3>
                                            <p>".$Title."</p></div>
                                            <div class='display'>
                                            <h3>$videoshow[1]</h3>
                                            <form action='videoshow.php' method='POST'>
                                                <input type='checkbox' name='yes' value='$VideoID'> Yes

                                                <input type='submit' name='favorite' value='Add favorite'>
                                            </form></div>
                                            <div class='display'><h4>$videoshow[2]</h4>
                                            <p>".$Discription."</p></div>
                                                <a href='videoshow.php?videoid=$VideoID&liked=true'><img src='img/tup.png' width='50px' height='50px'>$likes  Vind ik leuk</a>
                                                <a href='videoshow.php?videoid=$VideoID&liked=false'><img src='img/tdown.png' width='50px' height='50px'>$dislikes Vind ik niet leuk</a>
                                                
                                            </div>";
                                    }
                                }
                                mysqli_stmt_close($stmt);
                            } 
                        if (isset($_POST['favorite'])) {
                                $string2 = "INSERT INTO favorite VALUES (?, ?);";
                                $stmt = mysqli_prepare($DBConnect, $string2);
                                $idset= $_SESSION['id'];
                                $aprove = $_POST['yes'];
                                
                                if ($stmt) {
                                    mysqli_stmt_bind_param($stmt, 'ss', $idset, $aprove);
                                    mysqli_stmt_execute($stmt);
                                    echo $videoshow[3];
                                } else {
                                    echo "<p>$videoshow[4]</p>";
                                }
                                mysqli_stmt_close($stmt);
                            }
                        }
                        if (isset($_GET['liked']))
                        {
                            $userID = $_SESSION['id'];
                            $VideoID = $_GET["videoid"];
                            $like = htmlentities($_GET['liked']);
                            if($like == 'true')
                            {
                                $like = 'y';
                                $query = "SELECT liked, disliked FROM likedvideos WHERE videoID = ? AND userID = ?";
                                if($stmt = mysqli_prepare($DBConnect, $query))
                                {
                                    if(mysqli_stmt_bind_param($stmt, 'ii', $VideoID, $userID))
                                    {
                                        if(mysqli_stmt_execute($stmt))
                                        {
                                            
                                        }else {
                                            echo "er is iets misgegaan. Probeer het later opnieuw";
                                        }
                                    }else {
                                        echo "er is iets misgegaan. Probeer het later opnieuw";
                                    }
                                    
                                }
                                else {
                                    echo "er is iets misgegaan. Probeer het later opnieuw";
                                }
                                mysqli_stmt_bind_result($stmt, $liked, $disliked);
                                mysqli_stmt_store_result($stmt);
                                $rows = mysqli_stmt_num_rows($stmt);
                                if($rows === 0)
                                {
                                    $query3 = "INSERT INTO likedvideos (videoID, userID, liked, disliked) VALUES (?,?,?,'n')";
                                    if($stmt = mysqli_prepare($DBConnect, $query3))
                                    {
                                        if(mysqli_stmt_bind_param($stmt, 'iis', $VideoID, $userID, $like))
                                        {
                                            if(mysqli_stmt_execute($stmt))
                                            {

                                            }else {
                                                echo "er is iets misgegaan. Probeer het later opnieuw";
                                            }
                                        }else {
                                            echo "er is iets misgegaan. Probeer het later opnieuw";
                                        }

                                    }
                                    else {
                                        echo "er is iets misgegaan. Probeer het later opnieuw";
                                    }
                                }
                                else {
                                    while(mysqli_stmt_fetch($stmt))
                                    {
                                        if($liked === 'n' && $disliked === 'y')
                                        {
                                            $query3 = "UPDATE likedvideos SET liked = 'y', disliked = 'n' WHERE videoID = ? AND userID = ?";
                                            if($stmt = mysqli_prepare($DBConnect, $query3))
                                            {
                                                if(mysqli_stmt_bind_param($stmt, 'ii', $VideoID, $userID))
                                                {
                                                    if(mysqli_stmt_execute($stmt))
                                                    {

                                                    }else {
                                                        echo "er is iets misgegaan. Probeer het later opnieuw";
                                                    }
                                                }else {
                                                    echo "er is iets misgegaan. Probeer het later opnieuw";
                                                }

                                            }
                                            else {
                                                echo "er is iets misgegaan. Probeer het later opnieuw";
                                            }
                                        }
                                    }
                                }
                                
                                
                            }
                            else {
                                if($like == 'false')
                                {
                                    $like = 'y';
                                    $query = "SELECT liked, disliked FROM likedvideos WHERE videoID = ? AND userID = ?";
                                    if($stmt = mysqli_prepare($DBConnect, $query))
                                    {
                                        if(mysqli_stmt_bind_param($stmt, 'ii', $VideoID, $userID))
                                        {
                                            if(mysqli_stmt_execute($stmt))
                                            {

                                            }else {
                                                echo "er is iets misgegaan. Probeer het later opnieuw";
                                            }
                                        }else {
                                            echo "er is iets misgegaan. Probeer het later opnieuw";
                                        }

                                    }
                                    else {
                                        echo "er is iets misgegaan. Probeer het later opnieuw";
                                    }
                                    mysqli_stmt_bind_result($stmt, $liked, $disliked);
                                    mysqli_stmt_store_result($stmt);
                                    $rows = mysqli_stmt_num_rows($stmt);
                                    if($rows === 0)
                                    {
                                        $query3 = "INSERT INTO likedvideos (videoID, userID, liked, disliked) VALUES (?,?,'n',?)";
                                        if($stmt = mysqli_prepare($DBConnect, $query3))
                                        {
                                            if(mysqli_stmt_bind_param($stmt, 'iis', $VideoID, $userID, $like))
                                            {
                                                if(mysqli_stmt_execute($stmt))
                                                {

                                                }else {
                                                    echo "er is iets misgegaan. Probeer het later opnieuw";
                                                }
                                            }else {
                                                echo "er is iets misgegaan. Probeer het later opnieuw";
                                            }

                                        }
                                        else {
                                            echo "er is iets misgegaan. Probeer het later opnieuw";
                                        }
                                    }
                                    else {
                                        while(mysqli_stmt_fetch($stmt))
                                        {
                                            if($liked === 'y' && $disliked === 'n')
                                            {
                                                $query3 = "UPDATE likedvideos SET liked = 'n', disliked = 'y' WHERE videoID = ? AND userID = ?";
                                                if($stmt = mysqli_prepare($DBConnect, $query3))
                                                {
                                                    if(mysqli_stmt_bind_param($stmt, 'ii', $VideoID, $userID))
                                                    {
                                                        if(mysqli_stmt_execute($stmt))
                                                        {

                                                        }else {
                                                            echo "er is iets misgegaan. Probeer het later opnieuw";
                                                        }
                                                    }else {
                                                        echo "er is iets misgegaan. Probeer het later opnieuw";
                                                    }

                                                }
                                                else {
                                                    echo "er is iets misgegaan. Probeer het later opnieuw";
                                                }
                                            }
                                        }
                                    }
                                }
                                else {
                                    header("location: login.php");
                                    exit;
                                }
                            }
                        }
                    }
            ?>
                    </div>
            </div>
        </div>
    </body>
</html>