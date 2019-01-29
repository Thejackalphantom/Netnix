<?php
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header("Location: login.php?lang=$lang");
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
                                        echo $error;
                                    }
                                }else {
                                    echo $error;
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
                                        echo $error;
                                    }
                                }else {
                                    echo $error;
                                }
                            }
                            mysqli_stmt_bind_result($stmt, $nt);
                            mysqli_stmt_store_result($stmt);
                            $dislikes = mysqli_stmt_num_rows($stmt);
                            //Worden alle gegevens opgehaald uit de database van de likes
                            $userID = $_SESSION['id'];
                            $VideoID = $_GET["videoid"];
                            $query = "SELECT liked, disliked FROM likedvideos WHERE videoID = ? AND userID = ?";
                            if($stmt = mysqli_prepare($DBConnect, $query))
                            {
                                if(mysqli_stmt_bind_param($stmt, 'ii', $VideoID, $userID))
                                {
                                    if(mysqli_stmt_execute($stmt))
                                    {

                                    }else {
                                        echo $error;
                                    }
                                }else {
                                    echo $error;
                                }
                            }
                            else {
                                echo $error;
                            }
                            mysqli_stmt_bind_result($stmt, $liked1, $disliked1);
                            mysqli_stmt_store_result($stmt);
                            $rows = mysqli_stmt_num_rows($stmt);
                            $liked = NULL;
                            $disliked = NULL;
                            while(mysqli_stmt_fetch($stmt))
                            {
                                $liked = $liked1;
                                $disliked = $disliked1;
                            }
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
                                    header("location: index.php?lang=$lang");
                                } else {
                                    while (mysqli_stmt_fetch($stmt)) {
                                      echo" <div id='iframeBox'>
                                            <div class='displayvid'>
                                            <video width='500' height='400'controls>
                                            <source src='" . $Path . "' type=video/mp4>
                                            <source src='" . $Path . "' type=video/wav>
                                            </video></div>
                                            <div class='display'>
                                            <h2>" . $Title . "</h2>
                                            <p>" . $Discription . "</p>
                                            </div>
                                            <form method='POST' action='videoshow.php?lang=$lang&videoid=$VideoID'>
                                                <textarea name='comment' maxlength='200'></textarea>
                                                <input type='submit' name='addcomment' value='submit'>
                                            </form>
                                            <div class='display'>
                                            <h3>$videoshow[1]</h3>
                                            <form action='videoshow.php?lang=$lang&videoid=$VideoID' method='POST'>
                                                <input type='checkbox' name='yes' value='$VideoID'> Yes

                                                <input type='submit' name='favorite' value='Add favorite'>
                                            </form>
                                            </div>
                                            <div class='display'></div>
                                            </div>";
                                        if($liked === "y")
                                        {
                                            echo "
                                                <a href='videoshow.php?videoid=$VideoID&liked=true&lang=$lang'><img src='img/tup_selected.png' width='50px' height='50px'>$likes  Vind ik leuk</a>
                                                <a href='videoshow.php?videoid=$VideoID&liked=false&lang=$lang'><img src='img/tdown.png' width='50px' height='50px'>$dislikes Vind ik niet leuk</a>
                                            </div>";
                                        }
                                        elseif($disliked === "y")
                                        {
                                            echo "
                                                <a href='videoshow.php?videoid=$VideoID&liked=true&lang=$lang'><img src='img/tup.png' width='50px' height='50px'>$likes  Vind ik leuk</a>
                                                <a href='videoshow.php?videoid=$VideoID&liked=false&lang=$lang'><img src='img/tdown_selected.png' width='50px' height='50px'>$dislikes Vind ik niet leuk</a>
                                            </div>";
                                        }
                                        else {
                                            echo "
                                                <a href='videoshow.php?videoid=$VideoID&liked=true&lang=$lang'><img src='img/tup.png' width='50px' height='50px'>$likes  Vind ik leuk</a>
                                                <a href='videoshow.php?videoid=$VideoID&liked=false&lang=$lang'><img src='img/tdown.png' width='50px' height='50px'>$dislikes Vind ik niet leuk</a>
                                            </div>";
                                        }
                                    }
                                }
                                mysqli_stmt_close($stmt);
                            }
                            //Start comment function
                            $SQLstring="SELECT comment, userName FROM comments"
                                    . "JOIN users on comments.userID=users.userID"
                                    . "WHERE videoID=?";
                            $stmt= mysqli_prepare($DBConnect, $SQLstring);
                            if($stmt)
                            {
                                $video=$_GET['videoid'];
                                mysqli_stmt_bind_param($stmt, 's',$video);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $comment, $username);
                                mysqli_stmt_store_result($stmt);
                                if (mysqli_stmt_num_rows($stmt) == 0)
                                {
                                    echo $videoshow[3];
                                }
                                else
                                {
                                    echo"<div class='commentBox'>";
                                    while(mysqli_stmt_fetch($stmt))
                                    {
                                        echo "<div class=comment>$username<br>$comment</div>";
                                    }
                                    echo"</div>";
                                }
                                mysqli_stmt_close($stmt);
                            }
                            if(isset($_POST['addcomment']))
                            {
                                $SQLstring="INSERT INTO comments(userID, videoID, comment) VALUES(?, ?, ?)";
                                $stmt = mysqli_prepare($DBConnect, $SQLstring);
                                if($stmt)
                                {
                                    $userID=$_SESSION['id'];
                                    $videoID=$_GET['videoid'];
                                    $comment=$_POST['comment'];
                                    mysqli_stmt_bind_param($stmt,'sss',$userID,$VideoID,$comment);
                                    if(mysqli_stmt_execute($stmt)===TRUE)
                                    {
                                        header("refresh:0");
                                    }
                                    else
                                    {
                                        echo $error;
                                    }
                                }
                            }
                            //end comment function.
                        if (isset($_POST['favorite'])) {
                                $string2 = "INSERT INTO favorite VALUES (?, ?);";
                                $stmt = mysqli_prepare($DBConnect, $string2);
                                $idset= $_SESSION['id'];
                                $aprove = $_POST['yes'];
                                
                                if ($stmt) {
                                    mysqli_stmt_bind_param($stmt, 'ss', $idset, $aprove);
                                    mysqli_stmt_execute($stmt);
                                    echo $videoshow[4];
                                } else {
                                    echo "<p>$videoshow[5]</p>";
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
                                    header("refresh: 0");
                                    exit;
                                }
                                else {
                                    echo mysqli_error($DBConnect);
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
                                        header("refresh: 0");
                                        exit;
                                    }
                                }
                                
                                
                            }
                            else {
                                if($like == 'false')
                                {
                                    $like = 'y';
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
                                        header("refresh: 0");
                                        exit;
                                    }
                                    else {
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
                                            header("refresh: 0");
                                            exit;
                                        }
                                    }
                                }
                                else {
                                    header("location: login.php");
                                    exit;
                                }
                            }
                        }
                        //RATING SYSTEM
                        $query4 = "";
                        echo "
                            
                        ";
                    }
            ?>
                    </div>
            </div>
        </div>
    </body>
</html>