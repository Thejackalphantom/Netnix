<?php
/* Database credentials. Assuming you are running MySQL*/
$Server = "127.0.0.1"; //database hosted connection
$Admin = "admin"; //name of the Database acount
$Pass = "Admin"; // database password
$DBname = "netnix"; // database name
 
    /* Attempt to connect to MySQL database */
    $Conn = mysqli_connect($Server, $Admin, $Pass, $DBname);

    // Check connection
    if($Conn === false){
        die("ERROR: Could not connect tothe database please try again later. " . mysqli_connect_error());
    }
