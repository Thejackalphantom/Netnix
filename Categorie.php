<?php
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header("Location: login.php?lang=$lang");
    exit;
}
?>  

<!DOCTYPE html>
<!--
categorie page
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Netnix-categorie</title>
        <link rel="stylesheet" type="text/css" href="css/index.css">  
        <link rel="stylesheet" type="text/css" href="css/categorie.css"> 
    </head>
    <body>
       <?php include ("includes/header.php");?>
       <?php include ("includes/CategorieBlok.php");?>
       <?php include ("includes/footer.php");?>
    </body>
</html>