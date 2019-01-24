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
        <link rel="stylesheet" type="text/css" href="css/index.css">  
        <link rel="stylesheet" type="text/css" href="css/categorie.css"> 
    </head>
    <body>
        <div id="header"> 
			<div id="headerInside"> 
				<div id="logo">          
					<a href="index.php"><img src="img/logo.png" id="logoResize"></a>
				</div>
				<div id="menu">          
					<ul>
						<li><a href="Categorie.php">CATEGORIE</a></li>
						<li><a href="account.php">ACCOUNT</a></li>
						<li><a href="upload.php">UPLOAD</a></li>
						<li><a href="FavoriteList.php">FAVORIET</a></li>
					</ul>
				</div>
				
				<div id='logout'>
						<?php
						
//						if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
//							echo "<a href='logout.php'>Logout</a>";
//							$user = $_SESSION["username"];
//							echo "<p>U bent ingelogd als: <br>$user</p>";
//						}
						?>

					</div>
			</div>
			<hr>
		</div>
        <div id="Wrap">
            <div id="content">
                <div id="MainContent">
                    <div id="vids">
        <?php
            if($conn = mysqli_connect("127.0.0.1", "root", ""))
            {
                if($DBConnect = mysqli_select_db($conn, "netnix"))
                {
                    $id = $_GET['id'];
                    $QueryResult = "SELECT videoId, videoTitle, videoDescription, videoUploadPath FROM videos WHERE categorie = ?";
                    if($stmt = mysqli_prepare($conn, $QueryResult))
                    {
                        if(mysqli_stmt_bind_param($stmt, "s", $id))
                        {
                            if(mysqli_stmt_execute($stmt))
                            {
                                
                            }
                        }
                        else {
                            echo "error: " . mysqli_error($conn);
                        }
                    }
                    else {
                        echo "error: " . mysqli_error($conn);
                    }
                    mysqli_stmt_bind_result($stmt, $videoId, $videoTitle, $videoDescription, $videoPath);
                    mysqli_store_result($conn);
                    while(mysqli_stmt_fetch($stmt))
                    {
                        echo "<a href=videoshow.php?videoid=" . $videoId ."><div class='videoBoxUser'>
                                    <h2>". $videoTitle ."</h2>
                                        <video>
                                        <source src='".$videoPath."' type=video/mp4>
                                        <source src='".$videoPath."' type=video/wav>
                                        </video>
                                </div></a>";
                    }
                }
            }
        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>