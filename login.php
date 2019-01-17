<?php // Begin maken aan de sessie
        session_start();

// Kijk als de user al is ingelogd, zo ja dan gaat die naar het berichten pagina
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            header("location: index.php");
            exit;
        }
?>
<!DOCTYPE html>
<!--
Netnix login page
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Netnix Login</title>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
    <body>
        <?php include ("includes/header.php"); ?>
        <?php

        $DBConnect = mysqli_connect("localhost", "root", "");
        if ($DBConnect === FALSE)
        {
            echo "<p>Unable to connect to the database server.</p>"
            . "<p>Error code " . mysqli_errno() . ": "
            . mysqli_error() . "</p>";
        }
        $DBName = "netnix";
            mysqli_select_db($DBConnect, $DBName);
            if(isset($_POST['submit'])){
                
                if(empty($_POST['username']) OR empty($_POST['password'])){
                    echo "Vul alle velden in om in te loggen";
                }else{
                    
                    $username = htmlentities ($_POST['username']);
                    $password = htmlentities ($_POST['password']);
                    
                    
                    $string = "SELECT UserID, UserName, Password FROM user WHERE UserName = ?";
                    $stmt = mysqli_prepare($DBConnect, $string);
                        mysqli_stmt_bind_param($stmt, 's', $username);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $userid, $usernamecheck, $userPass);
                        while(mysqli_stmt_fetch($stmt)){
                            if ($usernamecheck = $username){ 
                                if (!password_verify($password, $userPass)){
                                    die('invalid password');
                                }
                                // Als alles goed is, start de session
                                session_start();

                                // Vult de data bij variables in
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $userid;    
                                $_SESSION["username"] = $username;  
 
                                
                                // Gaat naar de berichten pagina
                                header("location: index.php");
                            }else{
                                echo "Er is geen goed wachtwoord/gebruikersnaam ingevoerd";
                            }
                        }
                        mysqli_stmt_close($stmt);
                    }
                }mysqli_close($DBConnect);   
        ?>
        
        <div class='form'>
            <h2>Login</h2>
            <p>Vul u login gegevens aub in.</p>

            <form action="login.php" METHOD="POST">

                <p><label>Username</label>
                    <input type="text" name="username" ></p>

                <p><label>Password</label>
                    <input type="password" name="password"></p>


                <input type="submit" name="submit"  value="Login">
                <p>Geen account? <a href="signup.php"><div class="underline">Sign up now.</div></a></p>
            </form>
        </div>
        
        
        
         <?php
        $DBConnect = mysqli_connect("localhost", "root", "");
        if ($DBConnect === FALSE) {

            echo "Failed to connected";
        } else {
            $DBName = "netnix";
            if (!mysqli_select_db($DBConnect, $DBName)) {

                $SQLstring = "CREATE DATABASE `" . $DBName . "`";
                if ($stmt = mysqli_prepare($DBConnect, $SQLstring)) {
                    $QueryResult = mysqli_stmt_execute($stmt);
                    if ($QueryResult === FALSE) {
                        echo "<p>Well thats a error!</p>";
                    } else {
                        echo "<p>You are the first visitor!</p>";
                    }
                    mysqli_stmt_close($stmt);
                }
            }

            if (isset($_POST['submit'])) {

                $username = htmlentities($_POST['username']);
                $password = password_hash(($_POST['password']), PASSWORD_DEFAULT);

                if (empty(trim($_POST["username"]))) {
                    echo "Vul u gebruikersnaam in.";
                } else {
                    // Prepare a select statement
                    $sql = "SELECT UserID FROM user WHERE UserName = ?";

                    if ($stmt = mysqli_prepare($DBConnect, $sql)) {
                        mysqli_stmt_bind_param($stmt, "s", $param_username);

                        $param_username = trim($_POST["username"]);

                        if (mysqli_stmt_execute($stmt)) {
                            mysqli_stmt_store_result($stmt);
                            
                            $studentid = htmlentities($_POST['studentid']);
                            $firstname = htmlentities($_POST['firstname']);
                            $lastname = htmlentities($_POST['lastname']);
                            $email = htmlentities($_POST['email']);

                            if (mysqli_stmt_num_rows($stmt) == 1) {
                                echo "Deze naam is al ingebruik";
                            }if (mysqli_stmt_num_rows($stmt) == 0) { 
                                    mysqli_select_db($DBConnect, $DBName);
                                    $SQLstring2 = "INSERT INTO user (StudentID, UserName, FirstName, LastName, Email, Password) VALUES (?, ?, ?, ?, ?, ?)";

                                    if ($stmt = mysqli_prepare($DBConnect, $SQLstring2)) {
                                        mysqli_stmt_bind_param($stmt, 'ssssss', $studentid, $username, $firstname, $lastname, $email, $password);
                                        $QueryResult2 = mysqli_stmt_execute($stmt);
                                        if ($QueryResult2 === FALSE) {
                                            echo "<p>Unable to execute the query.</p>"
                                            . "<p>Error code "
                                            . mysqli_errno($DBConnect)
                                            . ": "
                                            . mysqli_error($DBConnect)
                                            . "</p>";
                                        } else {
                                            echo"Uw account is aangemaakt";
                                        }
                                        mysqli_stmt_close($stmt);
                                    }
                                
                                mysqli_close($DBConnect);
                            }
                        }
                    }
                    else {
                        echo "Er is iets fout gegaan";
                    }
                }
            }
        }
        ?>
        
        <div class='form'>
            <h2>Sign Up</h2>
            <p>Maak hier je account aan</p>

            <form method="POST" action="login.php" enctype="multipart/form-data">

                <p><label>Username</label>
                    <input type="text" name="username"></p>
                
                <p><label>Password</label>
                    <input type="password" name="password"></p>
                
                <p><label>StudentID</label>
                    <input type="text" name="studentid"></p>
                
                <p><label>firstname</label>
                    <input type="text" name="firstname"></p>
                
                <p><label>lastname</label>
                    <input type="text" name="lastname"></p>
                
                <p><label>email</label>
                    <input type="text" name="email"></p>

                <input type="submit" name="submit" value="Submit">
                <input type="reset"  value="Reset">
            </form>
        </div>
    </body>
</html>