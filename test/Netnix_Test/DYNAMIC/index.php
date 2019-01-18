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
                        <div class="videoBox">
                            
                        </div>
                    </div>
                    <div class="video">
                        <h2 class="title">VIDEOS</h2>   
                        <hr>
                    </div>   
                </div>
            </div>
        </div>
    </body>
</html>
