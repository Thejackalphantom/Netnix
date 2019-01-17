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
                <a href="videos.php?ID=IM">
                    <img src="img/informatiemanagement.png" id="Inf-Logo">
                    <p>Informatiemanagement</p>
                </a>
            </div>
            <div class="pLinks">
                <a href="videos.php?ID=HTML">
                    <img src="img/HTML5_Logo.png" id="Java-Logo">
                    <p>HTML/CSS</p>
                </a>
            </div>
            <div class="pLinks">
                <a href="videos.php?ID=PHP">
                    <img src="img/PHP-logo.png" id="PHP-logo">
                    <p>PHP</p>
                </a>
            </div>

            <div class="pLinks">
                <a href="videos.php?ID=C#">
                    <img src="img/c-logo.png" id="C#-logo">
                    <p>C#</p>
                </a>
            </div>
            <div class="pLinks">
                <a href="videos.php?ID=DB">
                    <img src="img/database-icon.png" id="database-logo">
                    <p>Database</p>
                </a>
            </div>
            <div class="pLinks">
                <a href="videos.php?ID=JS">
                    <img src="img/javascript-logo.png" id="javascript-logo">
                    <p>Javascript</p>
                </a>
            </div>
        </div>
    </body>
</html>