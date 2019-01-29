<?php
include("taal.php");
if(!isset($_GET['lang']))
{
    $_GET['lang']="nl";
}
?>
<head>
        <link rel="stylesheet" type="text/css" href="css/login.css">     
</head>
<div id="header"> 
    <div id="headerInside"> 
        <div id="logo">          
            <a href="index.php"><img src="img/logo.png" id="logoResize"></a>
        </div>
        <div id="menu">          
            <ul>
                <?php
                    $lang = $_GET['lang'];
                    if($_SERVER['PHP_SELF']=="/netnix/includes/HotelSchool.php"OR $_SERVER['PHP_SELF']=="/netnix/includes/PABO.php" OR$_SERVER['PHP_SELF']=="/netnix/includes/Informatica.php")
                    {
                        echo"<li><a href='../Categorie.php?lang=$lang'>$header[0]</a></li>
                            <li><a href='../account.php?lang=$lang'>$header[1]</a></li>
                            <li><a href='../upload.php?lang=$lang'>$header[2]</a></li>
                            <li><a href='../FavoriteList.php?lang=$lang'>$header[3]</a></li>";
                    }
                    else
                    {
                        echo"<li><a href='Categorie.php?lang=$lang'>$header[0]</a></li>
                            <li><a href='account.php?lang=$lang'>$header[1]</a></li>
                            <li><a href='upload.php?lang=$lang'>$header[2]</a></li>
                            <li><a href='FavoriteList.php?lang=$lang'>$header[3]</a></li>";
                    }
                    
                    ?>
            </ul>
            
            <form action="search.php" method="POST">
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
                ?>
                <?php
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                    echo "<a href='logout.php'>$header[4]</a>";
                    $user = $_SESSION["username"];
                }
                ?>

            </div>
    </div>
    <hr>
</div>