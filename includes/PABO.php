<?php
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
        <link rel="stylesheet" type="text/css" href="../css/index.css">  
        <link rel="stylesheet" type="text/css" href="../css/categorie.css"> 
    </head>
    <body>
        <?php include ("header.php");?>
        <div class="imageRow">
            <div class="pLinks">
                <a href="../videos.php?id=nederlands">
                    <img src="img/nederlands_logo.png" alt="nederlands-Logo">
                    <p><?php echo$pabo[0] ?></p>
                </a>
            </div>
            <div class="pLinks">
                <a href="../videos.php?id=economie">
                    <img src="img/economie_logo.png" alt="economie-Logo">
                    <p><?php echo$pabo[1] ?></p>
                </a>
            </div>
            <div class="pLinks">
                <a href="../videos.php?id=wiskunde">
                    <img src="img/wiskunde_logo.png" alt="wiskunde-logo">
                    <p><?php echo$pabo[2] ?></p>
                </a>
            </div>
        </div>
    </body>
</html>