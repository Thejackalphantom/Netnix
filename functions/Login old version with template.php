<!DOCTYPE html>
<!--
Login page
-->


<?php
// Include config file
require_once "functions/config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM user WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Netnix-Login</title>
        <link rel="stylesheet" type="text/css" href="css/index.css">  
        <link rel="stylesheet" type="text/css" href="css/login.css"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
      
        <div id="Wrap">
            <div id="header"> 
            <div id="headerInside"> 
                <div id="logo">          
                    <a href="index.php"><img src="img/logo.png" id="logoResize"></a>
                </div>
                <div id="menu">          
                    
                </div>
            </div>
            <hr>
            </div>
            <div id="loginContainer">
                <div id="formContainer">
                    <div class="form">
                        <h2>Login</h2>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="login.php">                  
                                <p><input type="text" name="email" placeholder="&nbsp;email" class="txtbox"><br><br></p>
                                <p><input type="text" name="password" placeholder="&nbsp;password" class="txtbox"><br><br></p>
                                <input type="submit" value="Login">
                            </form> 
                    </div>                        


                    <div class="form">
                        <h3>Register</h3>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="login.php">
                                <p><input type="text" name="username" placeholder="&nbsp;Username" class="txtbox"><br><br></p>
                                <p><input type="text" name="firstname" placeholder="&nbsp;First name" class="txtbox"><br><br></p>
                                <p><input type="text" name="lastname" placeholder="&nbsp;Last name" class="txtbox"><br><br></p>
                                <p><input type="text" name="email" placeholder="&nbsp;E-mail" class="txtbox"><br><br></p>
                                <p><input type="text" name="password" placeholder="&nbsp;Password" class="txtbox"><br><br></p>
                                <p><input type="text" name="passwordcheck" placeholder="&nbsp;Password check" class="txtbox"><br><br></p>
                                <input type="submit" value="Register">
                            </form> 
                    </div>
                </div>
            </div>
        </div>
        
        
    </body>
</html>
