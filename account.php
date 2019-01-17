<!DOCTYPE html>
<!--
Account Pagina
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="css/account.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Netnix</title>
    </head>
    <body>
        <div id="Wrap">
            <div id="content">
                <?php include ("includes/header.php");?>
                <div id="MainContent">
                    <div id="account">
                        <?php
                        session_start();
                        if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
                            header("location: login.php");
                            exit;
                        }
                        $conn = mysqli_connect("127.0.0.1", "root", "");
                        if ($conn)
                        {
                            $dbname = "nhlstendentwitter";
                            $DBConnect = mysqli_select_db($conn, $dbname);
                            if($DBConnect)
                            {
                                
                            }
                        }
                        echo "<p>Name: </p>";
                        ?>
                        <h1> Your account </h1>
                        <p>Name:</p>
                        <p>Class: </p>
                        
                        <hr>
                        
                        <h1> Your videos </h1>
                    </div>   
                </div>
            </div>
        </div>
    </body>
</html>

