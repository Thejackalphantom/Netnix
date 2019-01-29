<?php
        session_start();

        if(!isset($_SESSION['loggedin']))
        {
            // not logged in
            header("Location: login.php?lang=$lang");
            exit();
        }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Netnix-categorie</title>
        <link rel="stylesheet" type="text/css" href="../css/index.css">  
        <link rel="stylesheet" type="text/css" href="../css/categorie.css"> 
        <link rel="stylesheet" type="text/css" href="../css/login.css"> 
    </head>
    <body>
        <?php
        include("taal.php");
        if(!isset($_GET['lang']))
        {
            $_GET['lang']="nl";
            $lang=$_GET['lang'];
        }
        ?>
        <div id="header"> 
            <div id="headerInside"> 
                <div id="logo">          
                    <img src="img/logo.png" id="logoResize">
                </div>
                <div id="menu">          
                    <ul>
                        <?php
                            $lang = $_GET['lang'];
                            if($_SERVER['PHP_SELF']=="/netnix/includes/HotelSchool.php"OR $_SERVER['PHP_SELF']=="/netnix/includes/PABO.php" OR$_SERVER['PHP_SELF']=="/netnix/includes/Informatica.php")
                            {
                                echo"<li><a href='../index.php?lang=$lang'> HOME</a></li>
                                    <li><a href='../Categorie.php?lang=$lang'> $header[0]</a></li>
                                    <li><a href='../account.php?lang=$lang'> $header[1]</a></li>
                                    <li><a href='../upload.php?lang=$lang'> $header[2]</a></li>
                                    <li><a href='../FavoriteList.php?lang=$lang'> $header[3]</a></li>";
                            }
                            else
                            {
                                echo"<li><a href='../index.php?lang=$lang'> HOME</a></li>
                                    <li><a href='../Categorie.php?lang=$lang'>$header[0]</a></li>
                                    <li><a href='../account.php?lang=$lang'>$header[1]</a></li>
                                    <li><a href='../upload.php?lang=$lang'>$header[2]</a></li>
                                    <li><a href='../FavoriteList.php?lang=$lang'>$header[3]</a></li>";
                            }

                            ?>
                    </ul>

                    <form action="../search.php" method="POST">
                        <input type="text" name="search" class="button" placeholder="Search">
                        <button type="submit" class="button" name="submit-search">Search</button>
                    </form>

                </div>

                <div id='logout'>
                        <?php
                        switch($lang)
                            {
                                case "en":
                                    echo "<li><a href='".$_SERVER['PHP_SELF']."?lang=nl'><img src='img/nl.jpg'></a></li>";
                                    $_SESSION['lang'] = "nl";
                                    break;
                                case "nl":
                                    echo "<li><a href='".$_SERVER['PHP_SELF']."?lang=en'><img src='img/eng.jpg'></a></li>";
                                    $_SESSION['lang'] = "en";
                                    break;
                                default :
                                    echo "<li><a href='".$_SERVER['PHP_SELF']."?lang=en'><img src='img/eng.jpg'></a></li>";
                                    $_SESSION['lang'] = "en";
                            }
                        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                            echo "<a href='logout.php'>$header[4]</a>";
                            $user = $_SESSION["username"];
                        }
                        ?>

                    </div>
            </div>
            <hr>
        </div>
        <div class="imageRow">
            <div class="pLinks">
                <a href="../videos.php?id=informatiemanagement&lang=<?php echo $lang?>">
                    <img src="img/informatiemanagement.png" alt="Inf-Logo">
                    <p><?php echo$informatica[0] ?></p>
                </a>
            </div>
            <div class="pLinks">
                <a href="../videos.php?id=html&lang=<?php echo $lang?>">
                    <img src="img/HTML5_Logo.png" alt="Java-Logo">
                    <p>HTML/CSS</p>
                </a>
            </div>
            <div class="pLinks">
                <a href="../videos.php?id=php&lang=<?php echo $lang?>">
                    <img src="img/PHP-logo.png" alt="PHP-logo">
                    <p>PHP</p>
                </a>
            </div>

            <div class="pLinks">
                <a href="../videos.php?id=c&lang=<?php echo $lang?>">
                    <img src="img/c-logo.png" alt="C#-logo">
                    <p>C#</p>
                </a>
            </div>
            <div class="pLinks">
                <a href="../videos.php?id=database&lang=<?php echo $lang?>">
                    <img src="img/database-icon.png" alt="database-logo">
                    <p>Databases</p>
                </a>
            </div>
            <div class="pLinks">
                <a href="../videos.php?id=javascript&lang=<?php echo $lang?>">
                    <img src="img/javascript-logo.png" alt="javascript-logo">
                    <p>Javascript</p>
                </a>
            </div>
        </div>
        <?php include ("footer.php");?>
    </body>
</html>