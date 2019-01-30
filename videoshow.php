<?php
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header("Location: login.php?lang=$lang");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="css/account.css">
        <link rel="stylesheet" type="text/css" href="css/video.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Netnix</title>
    </head>
    <body>
        <div id="Wrap">
            <?php include ("includes/header.php"); ?>
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
                            if ($stmt = mysqli_prepare($DBConnect, $query)) {
                                if (mysqli_stmt_bind_param($stmt, 'i', $VideoID)) {
                                    if (mysqli_stmt_execute($stmt)) {
                                        
                                    } else {
                                        echo $error;
                                    }
                                } else {
                                    echo $error;
                                }
                            } else {
                                echo "er is iets misgegaan. Probeer het later opnieuw" . mysqli_error($DBConnect);
                            }
                            mysqli_stmt_bind_result($stmt, $likedusers);
                            mysqli_stmt_store_result($stmt);
                            $likes = mysqli_stmt_num_rows($stmt);
                            //Aantal dislikes worden geteld..
                            $query = "SELECT userID FROM likedvideos WHERE videoID = ? AND disliked = 'y'";
                            if ($stmt = mysqli_prepare($DBConnect, $query)) {
                                if (mysqli_stmt_bind_param($stmt, 'i', $VideoID)) {
                                    if (mysqli_stmt_execute($stmt)) {
                                        
                                    } else {
                                        echo $error;
                                    }
                                } else {
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
                            if ($stmt = mysqli_prepare($DBConnect, $query)) {
                                if (mysqli_stmt_bind_param($stmt, 'ii', $VideoID, $userID)) {
                                    if (mysqli_stmt_execute($stmt)) {
                                        
                                    } else {
                                        echo $error;
                                    }
                                } else {
                                    echo $error;
                                }
                            } else {
                                echo $error;
                            }
                            mysqli_stmt_bind_result($stmt, $liked1, $disliked1);
                            mysqli_stmt_store_result($stmt);
                            $rows = mysqli_stmt_num_rows($stmt);
                            $liked = NULL;
                            $disliked = NULL;
                            while (mysqli_stmt_fetch($stmt)) {
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
                                            ";
                                        //RATING SYSTEM
                                        $query4 = "SELECT AVG(rating)AS ratingAVG, userID, COUNT(userID) FROM rating WHERE videoID = ?";
                                        if ($stmt = mysqli_prepare($DBConnect, $query4)) {
                                            if (mysqli_stmt_bind_param($stmt, 's', $VideoID)) {
                                                if (mysqli_stmt_execute($stmt)) {
                                                    
                                                } else {
                                                    echo "Er is iets misgegaan. Probeer het later opnieuw.";
                                                }
                                            } else {
                                                echo "Er is iets misgegaan. Probeer het later opnieuw.";
                                            }
                                        } else {
                                            echo "Er is iets misgegaan. Probeer het later opnieuw.";
                                        }

                                        mysqli_stmt_bind_result($stmt, $AVG1, $users, $count);
                                        mysqli_stmt_store_result($stmt);
                                        $AVG;
                                        $rated = FALSE;
                                        while (mysqli_stmt_fetch($stmt)) {
                                            $AVG = $AVG1;
                                            if ($users == $userID) {
                                                $rated = TRUE;
                                            }
                                        }
                                        round($AVG);
                                        if ($AVG == 0.5 OR $AVG == 1.5 OR $AVG == 2.5 OR $AVG == 3.5 OR $AVG == 4.5) {
                                            $AVG = $AVG - 0.5;
                                        }


                                        echo "<h3>Aantal beoordelingen: $count</h3>";
                                        if ($AVG == 0) {
                                            for ($i = 0; $i < 5; $i++) {
                                                $j = $i + 1;
                                                echo "<a href='videoshow.php?videoid=$VideoID&vote=$j'><img class='star' src='img/starempty.png'></a>";
                                            }
                                        } else {
                                            for ($i = 0; $i < $AVG; $i++) {
                                                $j = $i + 1;
                                                echo "<a href='videoshow.php?videoid=$VideoID&vote=$j'><img class='star' src='img/starfilled.png'></a>";
                                            }
                                            for ($i = $AVG; $i <=4; $i++) {
                                                $j = $i + 1;
                                                echo "<a href='videoshow.php?videoid=$VideoID&vote=$j'><img class='star' src='img/starempty.png'></a>";
                                            }
                                        }

                                        if (isset($_GET['vote'])) {
                                            $querysearch = "SELECT videoID, userID, rating FROM rating WHERE userID=? AND videoID=?";
                                            if ($stmt = mysqli_prepare($DBConnect, $querysearch)) {
                                                if (mysqli_stmt_bind_param($stmt, 'ss', $userID, $VideoID)) {
                                                    mysqli_stmt_execute($stmt);
                                                    mysqli_stmt_store_result($stmt);
                                                    if (mysqli_stmt_num_rows($stmt) == 0) {
                                                        $vote = $_GET['vote'];

                                                        $query4 = "INSERT INTO rating (videoID, userID, rating) VALUES (?,?,?)";
                                                        if ($stmt = mysqli_prepare($DBConnect, $query4)) {
                                                            if (mysqli_stmt_bind_param($stmt, 'sss', $VideoID, $userID, $vote)) {
                                                                if (mysqli_stmt_execute($stmt)) {
                                                                    header("refresh: 0");
                                                                } else {
                                                                    echo "Er is iets misgegaan. Probeer het later opnieuw." . mysqli_error($DBConnect);
                                                                }
                                                            } else {
                                                                echo "Er is iets misgegaan. Probeer het later opnieuw." . mysqli_error($DBConnect);
                                                            }
                                                        } else {
                                                            echo "Er is iets misgegaan. Probeer het later opnieuw." . mysqli_error($DBConnect);
                                                        }
                                                    } else {
                                                        $vote = $_GET['vote'];
                                                        $query4 = "UPDATE rating SET rating = $vote WHERE userID = ?";
                                                        if ($stmt = mysqli_prepare($DBConnect, $query4)) {
                                                            if (mysqli_stmt_bind_param($stmt, 's', $userID)) {
                                                                if (mysqli_stmt_execute($stmt) === TRUE) {
                                                                    echo"Vote is updated";
                                                                } else {
                                                                    echo "Er is iets misgegaan. Probeer het later opnieuw." . mysqli_error($DBConnect);
                                                                }
                                                            } else {
                                                                echo "Er is iets misgegaan. Probeer het later opnieuw." . mysqli_error($DBConnect);
                                                            }

                                                            exit;
                                                        } else {
                                                            echo "Er is iets misgegaan. Probeer het later opnieuw." . mysqli_error($DBConnect);
                                                        }
                                                    }
                                                }
                                                echo "<div class='display'></div>
                                            </div>";
                                                if ($liked === "y") {
                                                    echo "
                                                <a href='videoshow.php?videoid=$VideoID&liked=true&lang=$lang'><img src='img/tup_selected.png' width='20px' height='20px'>$likes  Vind ik leuk</a>
                                                <a href='videoshow.php?videoid=$VideoID&liked=false&lang=$lang'><img src='img/tdown.png' width='20px' height='20px'>$dislikes Vind ik niet leuk</a>
                                            ";
                                                } elseif ($disliked === "y") {
                                                    echo "
                                                <a href='videoshow.php?videoid=$VideoID&liked=true&lang=$lang'><img src='img/tup.png' width='20px' height='20px'>$likes  Vind ik leuk</a>
                                                <a href='videoshow.php?videoid=$VideoID&liked=false&lang=$lang'><img src='img/tdown_selected.png' width='20px' height='20px'>$dislikes Vind ik niet leuk</a>
                                            ";
                                                } else {
                                                    echo "
                                                <a href='videoshow.php?videoid=$VideoID&liked=true&lang=$lang'><img src='img/tup.png' width='20px' height='20px'>$likes  Vind ik leuk</a>
                                                <a href='videoshow.php?videoid=$VideoID&liked=false&lang=$lang'><img src='img/tdown.png' width='20px' height='20px'>$dislikes Vind ik niet leuk</a>
                                            ";
                                                }
                                            }
                                        }
                                    }
                                }
                                mysqli_stmt_close($stmt);
                            }
                            //Start comment function
                            $SQLstring = "SELECT comment, userName FROM comments"
                                    . "JOIN users on comments.userID=users.userID"
                                    . "WHERE videoID=?";
                            $stmt = mysqli_prepare($DBConnect, $SQLstring);
                            if ($stmt) {
                                $VideoID = $_GET['videoid'];
                                mysqli_stmt_bind_param($stmt, 's', $VideoID);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $comment, $username);
                                mysqli_stmt_store_result($stmt);
                                if (mysqli_stmt_num_rows($stmt) == 0) {
                                    echo $videoshow[3];
                                } else {
                                    echo"<div class='commentBox'>";
                                    while (mysqli_stmt_fetch($stmt)) {
                                        echo "<div class=comment>$username<br>$comment</div>";
                                    }
                                    echo"</div>";
                                }
                                mysqli_stmt_close($stmt);
                            }
                            if (isset($_POST['addcomment'])) {
                                $SQLstring = "INSERT INTO comments(userID, videoID, comment) VALUES(?, ?, ?)";
                                $stmt = mysqli_prepare($DBConnect, $SQLstring);
                                if ($stmt) {
                                    $userID = $_SESSION['id'];
                                    $videoID = $_GET['videoid'];
                                    $comment = $_POST['comment'];
                                    mysqli_stmt_bind_param($stmt, 'sss', $userID, $VideoID, $comment);
                                    if (mysqli_stmt_execute($stmt) === TRUE) {
                                        header("refresh:0");
                                    } else {
                                        echo $error;
                                    }
                                }
                            }
                            //end comment function.
                            if (isset($_POST['favorite'])) {
                                $string2 = "INSERT INTO favorite VALUES (?, ?);";
                                $stmt = mysqli_prepare($DBConnect, $string2);
                                $idset = $_SESSION['id'];
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
                        if (isset($_GET['liked'])) {
                            $userID = $_SESSION['id'];
                            $VideoID = $_GET["videoid"];
                            $like = htmlentities($_GET['liked']);
                            if ($like == 'true') {
                                $like = 'y';
                                if ($rows === 0) {
                                    $query3 = "INSERT INTO likedvideos (videoID, userID, liked, disliked) VALUES (?,?,?,'n')";
                                    if ($stmt = mysqli_prepare($DBConnect, $query3)) {
                                        if (mysqli_stmt_bind_param($stmt, 'iis', $VideoID, $userID, $like)) {
                                            if (mysqli_stmt_execute($stmt)) {
                                                
                                            } else {
                                                echo "er is iets misgegaan. Probeer het later opnieuw";
                                            }
                                        } else {
                                            echo "er is iets misgegaan. Probeer het later opnieuw";
                                        }
                                    } else {
                                        echo "er is iets misgegaan. Probeer het later opnieuw";
                                    }
                                    header("refresh: 0");
                                    exit;
                                } else {
                                    echo mysqli_error($DBConnect);
                                    if ($liked === 'n' && $disliked === 'y') {
                                        $query3 = "UPDATE likedvideos SET liked = 'y', disliked = 'n' WHERE videoID = ? AND userID = ?";
                                        if ($stmt = mysqli_prepare($DBConnect, $query3)) {
                                            if (mysqli_stmt_bind_param($stmt, 'ii', $VideoID, $userID)) {
                                                if (mysqli_stmt_execute($stmt)) {
                                                    
                                                } else {
                                                    echo "er is iets misgegaan. Probeer het later opnieuw";
                                                }
                                            } else {
                                                echo "er is iets misgegaan. Probeer het later opnieuw";
                                            }
                                        } else {
                                            echo "er is iets misgegaan. Probeer het later opnieuw";
                                        }
                                        header("refresh: 0");
                                        exit;
                                    }
                                }
                            } else {
                                if ($like == 'false') {
                                    $like = 'y';
                                    if ($rows === 0) {
                                        $query3 = "INSERT INTO likedvideos (videoID, userID, liked, disliked) VALUES (?,?,'n',?)";
                                        if ($stmt = mysqli_prepare($DBConnect, $query3)) {
                                            if (mysqli_stmt_bind_param($stmt, 'iis', $VideoID, $userID, $like)) {
                                                if (mysqli_stmt_execute($stmt)) {
                                                    
                                                } else {
                                                    echo "er is iets misgegaan. Probeer het later opnieuw";
                                                }
                                            } else {
                                                echo "er is iets misgegaan. Probeer het later opnieuw";
                                            }
                                        } else {
                                            echo "er is iets misgegaan. Probeer het later opnieuw";
                                        }
                                        header("refresh: 0");
                                        exit;
                                    } else {
                                        if ($liked === 'y' && $disliked === 'n') {
                                            $query3 = "UPDATE likedvideos SET liked = 'n', disliked = 'y' WHERE videoID = ? AND userID = ?";
                                            if ($stmt = mysqli_prepare($DBConnect, $query3)) {
                                                if (mysqli_stmt_bind_param($stmt, 'ii', $VideoID, $userID)) {
                                                    if (mysqli_stmt_execute($stmt)) {
                                                        
                                                    } else {
                                                        echo "er is iets misgegaan. Probeer het later opnieuw";
                                                    }
                                                } else {
                                                    echo "er is iets misgegaan. Probeer het later opnieuw";
                                                }
                                            } else {
                                                echo "er is iets misgegaan. Probeer het later opnieuw";
                                            }
                                        }
                                    }
                                } else {
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