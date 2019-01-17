<!DOCTYPE html>
<?php
session_start();
?>
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
                        if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
                            header("location: login.php");
                            exit;
                        }
                        $userid = $_SESSION['id'];
                        $conn = mysqli_connect("127.0.0.1", "root", "");
                        if ($conn)
                        {
                            $dbname = "netnix";
                            $DBConnect = mysqli_select_db($conn, $dbname);
                            if($DBConnect)
                            {
                                $QueryResult = "SELECT StudentId, UserName, FirstName, LastName, Email FROM user WHERE UserId = ?";
                                if($stmt = mysqli_prepare($conn, $QueryResult))
                                {
                                    if(mysqli_stmt_bind_param($stmt, 's', $userid))
                                    {
                                        if (mysqli_stmt_execute($stmt))
                                        {
                                            
                                        }
                                        else {
                                            echo "Er is iets misgegaan. Probeer het later opnieuw";
                                            echo mysqli_error($conn);
                                        }
                                    }
                                    else {
                                        echo "Er is iets misgegaan. Probeer het later opnieuw";
                                        echo mysqli_error($conn);
                                    }
                                    mysqli_stmt_bind_result($stmt, $StudentId, $UserName, $FirstName, $LastName, $Email);
                                    mysqli_stmt_store_result($stmt);
                                }
                                else {
                                    echo "Er is iets misgegeaan. Probeer het later opnieuw";
                                    echo mysqli_error($conn);
                                }
                            }
                        }
                        while(mysqli_stmt_fetch($stmt))
                        {
                            echo "<h1> Your account </h1>";
                            echo "<p>Name: " . $FirstName . " " . $LastName . "</p>";
                            echo "<p>StudentId: " . $StudentId . "</p>";
                            echo "<p>Email: " . $Email . "</p>";
                            echo "<hr>";
                        }
                        ?>
                        <h1> Your videos </h1>
                    </div>   
                </div>
            </div>
        </div>
    </body>
</html>

