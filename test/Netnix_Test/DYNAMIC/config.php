<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$server = "127.0.0.1";
$username = "admin";
$password = "Admin";
$DBname = "netnix";
 
    /* Attempt to connect to MySQL database */
    $link = mysqli_connect($server, $username, $password, $DBname);

    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    
    //echo "connection established";
