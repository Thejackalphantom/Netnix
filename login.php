<?php // Begin maken aan de sessie
        session_start();
if(!isset($_SESSION['lang']))
{
    $_GET['lang']="nl";
    $_SESSION['lang']="nl";
}
// Kijk als de user al is ingelogd, zo ja dan gaat die naar het berichten pagina
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            header("location: index.php?lang=$lang");
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
        <?php
        include ("includes/header.php");
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
                    echo $login[0];
                }else{
                    
                    $username = htmlentities ($_POST['username']);
                    $password = htmlentities ($_POST['password']);
                    
                    
                    $string = "SELECT userID, userName, userPass FROM users WHERE userName = ?";
                    $stmt = mysqli_prepare($DBConnect, $string);
                        mysqli_stmt_bind_param($stmt, 's', $username);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $userid, $usernamecheck, $userPass);
                        while(mysqli_stmt_fetch($stmt)){
                            if ($usernamecheck = $username){ 
                                if (!password_verify($password, $userPass)){
                                    die($login[1]);
                                }

                                // Vult de data bij variables in
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $userid;    
                                $_SESSION["username"] = $username;  
 
                                
                                // Gaat naar de berichten pagina
                                header("location: admin.php?lang=$lang");
                            }else{
                                echo $login[2];
                            }
                        }
                        mysqli_stmt_close($stmt);
                    }
                }mysqli_close($DBConnect);   
        ?>
        
        <div class='form'>
            <h2>Login</h2>
            <br>

            <form action="login.php?lang=<?php echo $lang?>" METHOD="POST">
                <p><input type="text" name="username" class="txtbox" placeholder="<?php echo$login[4]?>" ></p><br>
                <p><input type="password" name="password" class="txtbox" placeholder="<?php echo$login[5]?>"></p><br>

                <input type="submit" name="submit" class="button" value="Login">
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
                        echo "<p>$error</p>";
                    } else {
                        echo "<p>$login[6]</p>";
                    }
                    mysqli_stmt_close($stmt);
                }
            }

            if (isset($_POST['signin'])) {

                $username = htmlentities($_POST['username']);
                $password = password_hash(($_POST['password']), PASSWORD_DEFAULT);

                if (empty(trim($_POST["username"]))) {
                    echo "Vul u gebruikersnaam in.";
                } else {
                    // Prepare a select statement
                    $sql = "SELECT userID FROM users WHERE userName = ?";

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
                                echo $login[8];
                            }if (mysqli_stmt_num_rows($stmt) == 0) { 
                                    mysqli_select_db($DBConnect, $DBName);
                                    $SQLstring2 = "INSERT INTO users (StudentNumber, userName, firstName, lastName, email, userPass) VALUES (?, ?, ?, ?, ?, ?)";

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
                                            echo $login[9];
                                        }
                                        mysqli_stmt_close($stmt);
                                    }
                                
                                mysqli_close($DBConnect);
                            }
                        }
                    }
                    else {
                        echo $error;
                    }
                }
            }
        }
        ?>
        
        <div class='form'>
            <h2>Sign Up</h2>
            <br>
            <form method="POST" action="login.php?lang=<?php echo $lang?>" enctype="multipart/form-data">
                <p><input type="text" name="username" class="txtbox" placeholder="<?php echo $login[4]?>"></p><br>
                <p><input type="password" name="password" class="txtbox" placeholder="<?php echo $login[5]?>"></p><br>
                <p><input type="text" name="studentid" class="txtbox" placeholder="<?php echo $login[10]?>" ></p><br>
                <p><input type="text" name="firstname" class="txtbox" placeholder="<?php echo $login[11]?>" ></p><br>
                <p><input type="text" name="lastname" class="txtbox" placeholder="<?php echo $login[12]?>"></p><br>
                <p><input type="text" name="email" class="txtbox" placeholder="email"></p><br>
                <input type="submit" name="signin" class="button" value="Register">
                <input type="reset" class="button" value="Reset">
            </form>
        </div>
    </body>
</html>