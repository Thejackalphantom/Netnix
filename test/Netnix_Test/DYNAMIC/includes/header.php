<?php
include("taal.php");
?>
<div id="header"> 
    <div id="headerInside"> 
        <div id="logo">          
            <a href="index.php"><img src="img/logo.png" id="logoResize"></a>
        </div>
        <div id="menu">          
            <ul>
<?php
//DYNAMIC uit het pad weghalen nadat de pagina's kloppen.
    if($_SERVER['PHP_SELF']=="/Netnix_Test/DYNAMIC/includes/HotelSchool.php"OR $_SERVER['PHP_SELF']=="/Netnix_Test/DYNAMIC/includes/PABO.php" OR$_SERVER['PHP_SELF']=="/Netnix_Test/DYNAMIC/includes/Informatica.php")
    {
        echo"<li><a href='../Categorie.php'>$header[0]</a></li>
            <li><a href='../account.php'>$header[1]</a></li>
            <li><a href='../upload.php'>$header[2]</a></li>
            <li><a href='../FavoriteList.php'>$header[3]</a></li>";
    }
    else
    {
        echo"<li><a href='Categorie.php'>$header[0]</a></li>
            <li><a href='account.php'>$header[1]</a></li>
            <li><a href='upload.php'>$header[2]</a></li>
            <li><a href='FavoriteList.php'>$header[3]</a></li>";
    }
?>
                <li>
                    <?php
                    $lang = $_SESSION['lang'];
                    switch($lang)
                    {
                        case "en":
                            echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'><input type='submit' name='lang' value='Switch Language'></form>";
                            if(isset($_POST['lang']))
                            {
                                $_SESSION['lang'] = "nl";
                                header("Refresh:0");
                            }
                            break;
                        case "nl":
                            echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'><input type='submit' name='lang' value='Verander taal'></form>";
                            if(isset($_POST['lang']))
                            {
                                $_SESSION['lang'] = "en";
                                header("Refresh:0");
                            }
                            break;
                        default :
                            echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'><input type='submit' name='lang' value='Verander taal'></form>";
                            if(isset($_POST['lang']))
                            {
                                $_SESSION['lang'] = "en";
                            }
                    }
                    ?>
                </li>
            </ul>
        </div>
        
        <div id='logout'>
                <?php
                
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                    echo "<a href='logout.php'>$header[4]</a>";
                    $user = $_SESSION["username"];
                    echo "<p>$header[5]<br>$user</p>";
                }
                ?>

            </div>
    </div>
    <hr>
</div>