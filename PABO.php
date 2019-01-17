<?php
        session_start();

        if(!isset($_SESSION['loggedin']))
        {
            // not logged in
            header('Location: login.php');
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
        <?php include ("includes/header.php");?>
        <div class="imageRow">
            <div class="pLinks">
                <a href="videos.php?ID=NL">
                    <img src="img/nederlands_logo.png" id="Inf-Logo">
                    <p>Nederlands</p>
                </a>
            </div>
            <div class="pLinks">
                <a href="videos.php?ID=EC">
                    <img src="img/economie_logo.png" id="Java-Logo">
                    <p>Economie</p>
                </a>
            </div>
            <div class="pLinks">
                <a href="videos.php?ID=WS">
                    <img src="img/wiskunde_logo.png" id="PHP-logo">
                    <p>Wiskunde</p>
                </a>
            </div>
        </div>
    </body>
</html>