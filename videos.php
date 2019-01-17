<?php // Begin maken aan de sessie
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
        <?php
        ?>
    </body>
</html>