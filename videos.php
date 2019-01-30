<?php // Begin maken aan de sessie
        session_start();

        if(!isset($_SESSION['loggedin']))
        {
            // not logged in
            header("Location: login.php?lang=$lang");
            exit();
        }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Netnix-categorie</title>
        <link rel="stylesheet" type="text/css" href="css/index.css">  
        <link rel="stylesheet" type="text/css" href="css/categorie.css"> 
    </head>
    <body>
        <div id="Wrap">
            <?php include ("includes/header.php"); ?>
            <div id="content">
                <div id="MainContent">
                    <div id="vids">
                        <?php
                            if($conn = mysqli_connect("127.0.0.1", "root", ""))
                            {
                                if($DBConnect = mysqli_select_db($conn, "netnix"))
                                {
                                    $id = $_GET['id'];
                                    $QueryResult = "SELECT videoId, videoTitle, videoDescription, videoUploadPath FROM videos WHERE categorie = ? AND aprove = 1";
                                    if($stmt = mysqli_prepare($conn, $QueryResult))
                                    {
                                        if(mysqli_stmt_bind_param($stmt, "s", $id))
                                        {
                                            if(mysqli_stmt_execute($stmt))
                                            {

                                            }
                                        }
                                        else {
                                            echo "error: " . mysqli_error($conn);
                                        }
                                    }
                                    else {
                                        echo "error: " . mysqli_error($conn);
                                    }
                                    mysqli_stmt_bind_result($stmt, $videoId, $videoTitle, $videoDescription, $videoPath);
                                    mysqli_store_result($conn);
                                    while(mysqli_stmt_fetch($stmt)){
                                    //print_r($data);
                                    echo ""
                                        . "<a href=videoshow.php?videoid=$videoId&lang=$lang>
                                              <div class='videoBoxRandom'>
                                                    <video class='videoinline' width='500' height='300'>
                                                    <source src='".$videoPath."' type=video/mp4>
                                                    <source src='".$videoPath."' type=video/wav>
                                                    </video>
                                                    <div class='loadbar'></div>
                                                    <div class='videoTitle'><h2>". $videoTitle ."</h2></div>
                                              </div>
                                          </a>";
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include ("includes/footer.php");?>
    </body>
</html>