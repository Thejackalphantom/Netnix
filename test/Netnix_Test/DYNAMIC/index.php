<?php // Begin maken aan de sessie
        session_start();

        if(!isset($_SESSION['loggedin']))
        {
            // not logged in
            header('Location: login.php');
            exit();
        }
?>

<!DOCTYPE html>
<!--
INF1C Informatica NHL STENDEN
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Netnix</title>
    </head>
    <body>
        <div id="Wrap">
            <div id="content">
                <?php include ("includes/header.php");?>
                <div id="MainContent">
                    <div class="video">
                        <h2 class="title"><?php echo $index[0]?></h2>   
                        <hr>
                        <div class="videoBox">
                            
                        </div>
                        <div class="videoBox">
                            
                        </div>
                        <div class="videoBox">
                            
                        </div>
                    </div>
                    <div class="video">
                        <h2 class="title">VIDEOS</h2>   
                        <hr>
                        <?php
                        $conn = mysqli_connect("localhost", "root", "");
                        if ($conn)
                        {
                            $dbname = "netnix";
                            $DBConnect = mysqli_select_db($conn, $dbname);
                            if($DBConnect)
                            {
                                $QueryResult2 = "SELECT videoID, videoTitle, videoUploadPath FROM videos";
                                $stmt = mysqli_prepare($conn, $QueryResult2);
                                if($stmt = mysqli_prepare($conn, $QueryResult2))
                                {
                                    mysqli_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $videoid, $videotitle, $videopath);
                                    mysqli_stmt_store_result($stmt);
                                    if(mysqli_stmt_num_rows==0)
                                    {
                                        echo$index[1];
                                    }
                                    while(mysqli_stmt_fetch($stmt))
                                    {
                                        echo "<a href=videoshow.php?videoid=" . $videoid ."><div class='videoBoxUser'>
                                            <h2>". $videotitle ."</h2>
                                            <video width='300' height='300'>
                                            <source src='".$videopath."' type=video/mp4>
                                            <source src='".$videopath."' type=video/wav>
                                            </video>
                                            </div></a>";
                                    }
                                }
                                
                            }
                        }
                        ?>
                    </div>   
                </div>
            </div>
        </div>
    </body>
</html>
