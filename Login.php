<!DOCTYPE html>
<!--
Login page
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Netnix-Login</title>
        <link rel="stylesheet" type="text/css" href="css/index.css">  
        <link rel="stylesheet" type="text/css" href="css/login.css"> 
    </head>
    <body>
            <?php include ("includes/header.php");?>
        <div id="loginContainer">
            <div class="form">
                <h2>Login</h2>
                    <form method="POST" action="login.php">                  
                        <p><input type="text" name="email" value="email" class="txtbox"><br><br></p>
                        <p><input type="text" name="password" value="password" class="txtbox"><br><br></p>
                        <input type="submit" value="Login">
                    </form> 
            </div>                        

                    
            <div class="form">
                <h3>Register</h3>
                    <form method="POST" action="login.php">                  
                        <p><input type="text" name="email" value="email" class="txtbox"><br><br></p>
                        <p><input type="text" name="password" value="password" class="txtbox"><br><br></p>
                        <p><input type="text" name="passwordcheck" value="password check" class="txtbox"><br><br></p>
                        <p><input type="text" name="firstname" value="first name" class="txtbox"><br><br></p>
                        <p><input type="text" name="lastname" value="last name" class="txtbox"><br><br></p>
                        <input type="submit" value="Register">
                    </form> 
            </div>      
        </div>
    </body>
</html>
