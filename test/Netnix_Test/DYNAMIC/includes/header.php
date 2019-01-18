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
                <li><a href="Categorie.php"><?php echo $header[0];?></a></li>
                <li><a href="account.php"><?php echo $header[1];?></a></li>
                <li><a href="upload.php"><?php echo $header[2];?></a></li>
                <li><a href="FavoriteList.php"><?php echo $header[3];?></a></li>
                <li>
                    <?php
                    if (!isset($_SESSION['lang']))
                    {
                        $_SESSION['lang'] = "nl";
                    }
                    $lang = $_SESSION['lang'];
                    switch($lang)
                    {
                        case "en":
                            echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'><input type='submit' name='lang' value='Switch Language'></form>";
                            if(isset($_POST['lang']))
                            {
                                $_SESSION['lang'] = "nl";
                            }
                            break;
                        case "nl":
                            echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'><input type='submit' name='lang' value='Verander taal'></form>";
                            if(isset($_POST['lang']))
                            {
                                $_SESSION['lang'] = "en";
                            }
                            break;
                    }
                    ?>
                </li>
            </ul>
        </div>
        
        <div id='logout'>
                <?php
                
//                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
//                    echo "<a href='logout.php'>$header[4]</a>";
//                    $user = $_SESSION["username"];
//                    echo "<p>$header[5]<br>$user</p>";
//                }
                ?>

            </div>
    </div>
    <hr>
</div>
