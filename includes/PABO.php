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
        <link rel="stylesheet" type="text/css" href="../css/header.css"> 
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
                                    echo "<li><a href='".$_SERVER['PHP_SELF']."?lang=nl'><img src='includes/img/nl.jpg'></a></li>";
                                    $_SESSION['lang'] = "nl";
                                    break;
                                case "nl":
                                    echo "<li><a href='".$_SERVER['PHP_SELF']."?lang=en'><img src='includes/img/eng.jpg'></a></li>";
                                    $_SESSION['lang'] = "en";
                                    break;
                                default :
                                    echo "<li><a href='".$_SERVER['PHP_SELF']."?lang=en'><img src='includes/img/eng.jpg'></a></li>";
                                    $_SESSION['lang'] = "en";
                            }
                        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                            echo "<a href='../logout.php'>$header[4]</a>";
                            $user = $_SESSION["username"];
                        }
                        ?>

                    </div>
            </div>
            <hr>
        </div>
        <div class="imageRow">
            <div class="pLinks">
                <a href="../videos.php?id=nederlands&lang=<?php echo $lang?>">
                    <img src="img/nederlands_logo.png" alt="nederlands-Logo">
                    <p><?php echo$pabo[0] ?></p>
                </a>
            </div>
            <div class="pLinks">
                <a href="../videos.php?id=economie&lang=<?php echo $lang?>">
                    <img src="img/economie_logo.png" alt="economie-Logo">
                    <p><?php echo$pabo[1] ?></p>
                </a>
            </div>
            <div class="pLinks">
                <a href="../videos.php?id=wiskunde&lang=<?php echo $lang?>">
                    <img src="img/wiskunde_logo.png" alt="wiskunde-logo">
                    <p><?php echo$pabo[2] ?></p>
                </a>
            </div>
        </div>
        <?php include ("footer.php");?>
    </body>
</html>