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
                <a href="../videos.php?id=informatiemanagement">
                    <img src="img/informatiemanagement.png" alt="Inf-Logo">
                    <p><?php echo$informatica[0] ?></p>
                </a>
            </div>
            <div class="pLinks">
                <a href="../videos.php?id=html">
                    <img src="img/HTML5_Logo.png" alt="Java-Logo">
                    <p>HTML/CSS</p>
                </a>
            </div>
            <div class="pLinks">
                <a href="../videos.php?id=php">
                    <img src="img/PHP-logo.png" alt="PHP-logo">
                    <p>PHP</p>
                </a>
            </div>

            <div class="pLinks">
                <a href="../videos.php?id=c">
                    <img src="img/c-logo.png" alt="C#-logo">
                    <p>C#</p>
                </a>
            </div>
            <div class="pLinks">
                <a href="../videos.php?id=database">
                    <img src="img/database-icon.png" alt="database-logo">
                    <p>Databases</p>
                </a>
            </div>
            <div class="pLinks">
                <a href="../videos.php?id=javascript">
                    <img src="img/javascript-logo.png" alt="javascript-logo">
                    <p>Javascript</p>
                </a>
            </div>
        </div>
    </body>
</html>