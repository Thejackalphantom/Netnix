<?php // Begin maken aan de sessie
        session_start();

        if(!isset($_SESSION['loggedin']))
        {
            // not logged in
            header('Location: login.php');
            exit();
        }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Netnix-categorie</title>
        <link rel="stylesheet" type="text/css" href="../css/index.css">  
        <link rel="stylesheet" type="text/css" href="../css/categorie.css"> 
    </head>
    <body>
        <div id="header"> 
			<div id="headerInside"> 
				<div id="logo">          
					<a href="../index.php"><img src="img/logo.png" id="logoResize"></a>
				</div>
				<div id="menu">          
					<ul>
						<li><a href="../Categorie.php">CATEGORIE</a></li>
						<li><a href="../account.php">ACCOUNT</a></li>
						<li><a href="../upload.php">UPLOAD</a></li>
						<li><a href="../FavoriteList.php">FAVORIET</a></li>
					</ul>
				</div>
				
				<div id='logout'>
						<?php
						
						if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
							echo "<a href='logout.php'>Logout</a>";
							$user = $_SESSION["username"];
							echo "<p>U bent ingelogd als: <br>$user</p>";
						}
						?>

					</div>
			</div>
			<hr>
		</div>
        <?php
        ?>
    </body>
</html>