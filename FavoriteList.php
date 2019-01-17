<?php
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="css/favoritelist.css">
    </head>
    <body>
        <?php include ("includes/header.php"); ?>
        <?php include ("includes/video.php"); ?>
        <?php include ("includes/video.php"); ?>
        <?php include ("includes/video.php"); ?>
    </body>
</html>
